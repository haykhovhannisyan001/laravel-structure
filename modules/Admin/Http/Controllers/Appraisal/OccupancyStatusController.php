<?php
namespace Modules\Admin\Http\Controllers\Appraisal;

use Illuminate\Http\Request;
use App\Http\Requests;
use Modules\Admin\Http\Controllers\AdminBaseController;
use App\Models\Appraisal\OccupancyStatus;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Http\Requests\OccupancyRequest;

class OccupancyStatusController extends AdminBaseController
{
    public function index()
    {
        return view('admin::appraisal.occupancy.index');
    }

    /**
     * Process datatables ajax request
     * @param Request $request
     * @return mixed
     */
    public function occupancyData(Request $request)
    {
        if ($request->ajax()) {
            $occupancy = OccupancyStatus::all();
            return Datatables::of($occupancy)
                ->editColumn('is_protected', function ($r) {
                    return ($r->is_protected) ? 'Yes' : 'No';
                })
                ->addColumn('action', function ($r) {
                    return view('admin::appraisal.occupancy.partials._options', ['row' => $r]);
                })
                ->make(true);
        }
    }

    /**
     * @param OccupancyRequest $request
     * @param OccupancyStatus $occupancy
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createOccupancy(OccupancyRequest $request,OccupancyStatus $occupancy)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            $create = $occupancy->create($data);
            if ($create) {
                Session::flash('success', 'Occupancy Status Created.');
                return redirect()->route('admin.appraisal.occupancy.status');
            }
        }
        return view('admin::appraisal.occupancy.create', compact('occupancy'));
    }

    /**
     * @param OccupancyRequest $request
     * @param OccupancyStatus $occupancy
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOccupancy(OccupancyRequest $request, OccupancyStatus $occupancy)
    {
        if ($request->isMethod('put')) {
            $data = $request->all();
            $update = $occupancy->update($data);
            if ($update) {
                Session::flash('success', 'Occupancy Status Updated.');
            }
        }
        return redirect()->route('admin.appraisal.occupancy.status');
    }

    /**
     * @param OccupancyStatus $occupancy
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function deleteOccupancy(OccupancyStatus $occupancy)
    {
        if($occupancy->is_protected){
            Session::flash('error', 'You cannot delete that item');
            return redirect()->route('admin.appraisal.occupancy.status');
        }
        $occupancy->delete();
        Session::flash('success', 'Occupancy Deleted.');
        return redirect()->route('admin.appraisal.occupancy.status');
    }
}