<?php

namespace Modules\Admin\Http\Controllers\Management;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Modules\Admin\Http\Controllers\AdminBaseController;
use App\Models\Management\FHALicense;
use App\Http\Requests;
use Yajra\DataTables\Datatables;
use Html, Session;


class FhaLicensesController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = getStates();
        return view('admin::management.fha-licenses.index', [
            'states' => collect($states)->toJson()
        ]);
    }

    /**
     * Get all FHA licenses records
     * @return JSON
     */
    public function data()
    {
        $rows = FHALicense::all();

        return Datatables::of($rows)
            ->make(true);
    }
}