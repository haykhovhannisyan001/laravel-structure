<?php
namespace Modules\Admin\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Requests;
use Modules\Admin\Http\Controllers\AdminBaseController;
use App\Models\Management\ASCLicense;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Http\Requests\ASCLicensesRequest;

class ASCLicensesController extends AdminBaseController
{
    public function index()
    {
        $states = getStates();
        $licenseType = array(
            1 => 'Licensed',
            2 => 'Certified General',
            3 => 'Certified Residential',
            4 => 'Transitional License',
        );
        $licenseStatus = [
            'A' => 'Active',
            'I' => 'Inactive'
        ];
        return view('admin::management.asc-licenses.index',compact('states','licenseType','licenseStatus'));
    }

    /**
     * Process datatables ajax request
     * @param Request $request
     * @return mixed
     */
    public function ascLicensesData(ASCLicensesRequest $request)
    {
        if ($request->ajax()) {
            $ascLicenses = ASCLicense::orderBy('id','DESC');
            if($request->filter['search']){
                $ascLicenses = $ascLicenses->search($request->filter['search']);
            }
            if($request->filter['filter']){
                $ascLicenses = $ascLicenses->filter($request->filter['filter']);
            }
            $ascLicenses = $ascLicenses->paginate($request->filter['length']);
            $licenseType = array(
                1 => 'Licensed',
                2 => 'Certified General',
                3 => 'Certified Residential',
                4 => 'Transitional License',
            );

            return view('admin::management.asc-licenses.partials._data',compact('ascLicenses','licenseType'));
        }
    }
}