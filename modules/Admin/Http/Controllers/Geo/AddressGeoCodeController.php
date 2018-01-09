<?php

namespace Modules\Admin\Http\Controllers\Geo;

use App\Models\Geo\AddressGeoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Http\Controllers\AdminBaseController;
use Yajra\DataTables\Facades\DataTables;

class AddressGeoCodeController extends AdminBaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin::geo.address.index');
    }

    /**
     * Get Geo Coded Data for Datatables
     * @param Request $request
     * @return mixed
     */
    public function geoCodeData(Request $request)
    {
        if ($request->ajax()) {
            $addressGeoCode = AddressGeoCode::all();
            return Datatables::of($addressGeoCode)
                ->addColumn('action', function ($r) {
                    return view('admin::geo.address.partials._options', ['row' => $r]);
                })
                ->make(true);
        }
    }

    /**
     * Create Geo Code
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createGeoCode(Request $request)
    {
        if ($request->isMethod('POST')) {
            if (!empty(trim($request->address))) {
                $address = AddressGeoCode::where('address_not_formatted', $request->address)->count();
                if ($address > 0) {
                    return redirect()->back()->withErrors('Address already GeoCoded');
                }
                $geoCodedData = $this->getGeoCode($request->address);
                if ($geoCodedData['status'] == 'error') {
                    return redirect()->back()->withErrors($geoCodedData['message']);
                }
                $created = false;
                foreach ($geoCodedData['data'] as $geoCoded) {
                    $geoCoded['address_not_formatted'] = $request->address;
                    $created = AddressGeoCode::create($geoCoded);
                }
                if ($created) {
                    Session::flash('success', 'Address Geo Coded.');
                    return redirect()->route('admin.geo.address');
                }
            } else {
                return redirect()->back()->withErrors('Address field is required');
            }
        }
        return view('admin::geo.address.geo_code');
    }

    /**
     * @param AddressGeoCode $addressGeoCode
     * @return \Illuminate\Http\RedirectResponse
     */
    public function refreshGeoCode(AddressGeoCode $addressGeoCode)
    {
        $geoCodedData = $this->getGeoCode($addressGeoCode['address_not_formatted']);
        if ($geoCodedData['status'] == 'error') {
            Session::flash('error', $geoCodedData['message']);
            return redirect()->back();
        }
        $dataToUpdate['lat'] = $geoCodedData['data'][0]['lat'];
        $dataToUpdate['long'] = $geoCodedData['data'][0]['long'];
        $updated = $addressGeoCode->update($dataToUpdate);
        if ($updated) {
            Session::flash('success', 'Geo Code Updated.');
            return redirect()->route('admin.geo.address');
        }
    }

    /**
     * @param AddressGeoCode $addressGeoCode
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteGeoCode(AddressGeoCode $addressGeoCode)
    {
        $addressGeoCode->delete();
        Session::flash('success', 'Geo Code deleted.');
        return redirect()->route('admin.geo.address');
    }

    /**
     * @param $address
     * @return array|string
     */
    public function getGeoCode($address)
    {
        $address = str_replace(' ', '+', $address);
        try {
            $geoCodedData = collect(
                json_decode(
                    file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&key=' . env('GOOGLE_GEO_CODE_KEY')),
                    true)
            );
            if ($geoCodedData['status'] == config('constants.over_query_limit')) {
                $geoCodedData = collect(
                    json_decode(
                        file_get_contents('http://dev.virtualearth.net/REST/v1/Locations?q=' . $address . '&key=' . env('BING_GEO_CODE_KEY')),
                        true)
                );
                $result = $this->transformBingGeoCode($geoCodedData);

            } else {
                $result = $this->transformGoogleGeoCode($geoCodedData);

            }

            return $result;

        } catch (\Exception $e) {

            return $response = [
                'status' => 'error',
                'message' => $e->getMessage()
            ];

        }
    }

    /**
     * Geo Coding with Google
     * @param $geoCoded
     * @return array
     */
    public function transformGoogleGeoCode($geoCoded)
    {
        $data = [];
        if ($geoCoded['status'] == 'OK') {
            if (!empty($geoCoded['results'])) {
                foreach ($geoCoded['results'] as $result) {
                    $item['address'] = $result['formatted_address'];
                    $item['lat'] = $result['geometry']['location']['lat'];
                    $item['long'] = $result['geometry']['location']['lng'];
                    $keyed = collect($result['address_components'])->keyBy(function ($type) {
                        return $type['types']['0'];
                    });
                    $item['country'] = $keyed['country']['long_name'];
                    $item['zip'] = (isset($keyed['postal_code']['long_name'])) ? $keyed['postal_code']['long_name'] : null;
                    $item['state'] = (isset($keyed['administrative_area_level_1']['short_name'])) ? $keyed['administrative_area_level_1']['short_name'] : '';
                    $item['city'] = (isset($keyed['locality']['long_name'])) ? $keyed['locality']['long_name'] : '';
                    $data[] = $item;
                }
                return $response = [
                    'status' => 'success',
                    'data' => $data
                ];
            } else {
                return $this->responseWithError('Results for that Address was not found');
            }
        } elseif ($geoCoded['status'] == config('constants.zero_results')) {

            return $this->responseWithError('Results for that Address was not found');

        } elseif ($geoCoded['status'] == config('constants.request_denied')) {

            return $this->responseWithError('Request Denied');

        } elseif ($geoCoded['status'] == config('constants.invalid_request')) {

            return $this->responseWithError('Invalid Request');

        } else {
            return $this->responseWithError('Invalid Request');
        }
    }

    /**
     * Geo Coding with Bing
     * @param $geoCoded
     * @return array
     */
    public function transformBingGeoCode($geoCoded)
    {
        $data = [];
        if ($geoCoded['status'] == 200) {
            if (($geoCoded['resourceSets'][0]['estimatedTotal'])) {
                foreach ($geoCoded['resourceSets'][0]['resources'] as $result) {
                    $item['address'] = $result['address']['formattedAddress'];
                    $item['lat'] = $result['point']['coordinates'][0];
                    $item['long'] = $result['point']['coordinates'][1];
                    $item['country'] = $result['address']['countryRegion'];
                    $item['zip'] = $result['address']['postalCode'];
                    $item['state'] = $result['address']['adminDistrict'];
                    $item['city'] = $result['address']['adminDistrict2'];
                    $data[] = $item;
                }
                return $response = [
                    'status' => 'success',
                    'data' => $data
                ];
            } else {

                return $this->responseWithError('Results for that Address was not found');

            }
        } elseif ($geoCoded['status'] == 400) {

            return $this->responseWithError('The request contained an error.');

        } elseif ($geoCoded['status'] == 401) {

            return $this->responseWithError('Access was denied. You may have entered your credentials incorrectly, or you might not have access to the requested resource or operation.');

        } elseif ($geoCoded['status'] == 404) {

            return $this->responseWithError('The requested resource was not found.');

        } else {

            return $this->responseWithError('Invalid Request');

        }
    }

    /**
     * @param $message
     * @return array
     */
    public function responseWithError($message)
    {
        return $response = [
            'status' => 'error',
            'message' => $message
        ];
    }
}
