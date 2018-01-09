<?php

namespace Modules\Admin\Http\Controllers\Appraisal\EAD;

use App\Helpers\Widget;
use App\Models\Appraisal\EAD\EADUnit;
use App\Models\Appraisal\LoanType;
use App\Models\Appraisal\Type;
use App\Models\Clients\Client;
use App\Models\Lenders\Lender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Http\Controllers\AdminBaseController;
use Modules\Admin\Http\Requests\EADUnitRequest;
use Yajra\DataTables\Datatables;

class EADUnitController extends AdminBaseController
{
    public function index()
    {
        return view('admin::appraisal.ead-unit.index');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function eadData(Request $request)
    {
        if ($request->ajax()) {
            $eadData = EADUnit::select(['*']);
            return Datatables::of($eadData)
                ->editColumn('is_active', function ($r) {
                    return $r->is_active?'Yes':'No';
                })
                ->addColumn('action', function ($r) {
                    return view('admin::appraisal.ead-unit.partials._options', ['row' => $r]);
                })
                ->make(true);
        }
    }

    /**
     * @param EADUnitRequest $request
     * @param EADUnit $eadUnit
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function createEADUnit(EADUnitRequest $request,EADUnit $eadUnit) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $create = $eadUnit->create($data);
            if ($create) {
                $eadUnit->saveRelations($create,$data);
                Session::flash('success', 'Business Unit Created.');
                return redirect()->route('admin.appraisal.ead-unit');
            }
        }
        $eadUnit->appr_type_all = multiselect(Type::all(), ['form', 'short_descrip']);
        $eadUnit->loan_type_all = multiselect(LoanType::all(), 'descrip');
        $eadUnit->clients_all = multiselect(Client::select(['id', 'descrip'])->get(), 'descrip');
        $eadUnit->lenders_all = multiselect(Lender::all(), 'lender');
        return view('admin::appraisal.ead-unit.create', compact('eadUnit'));
    }

    /**
     * @param EADUnitRequest $request
     * @param EADUnit $eadUnit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEADUnit(EADUnitRequest $request,EADUnit $eadUnit) {
        if ($request->isMethod('put')) {
            $data = $request->all();
            $update = $eadUnit->update($data);
            $eadUnit->updateRelations($eadUnit,$data);
            Session::flash('success', 'Business Unit Updated.');
            return redirect()->route('admin.appraisal.ead-unit');
        }
        return redirect()->route('admin.appraisal.ead-unit');
    }

    /**
     * @param EADUnit $eadUnit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteEADUnit(EADUnit $eadUnit)
    {
        $eadUnit->delete();
        Session::flash('success', 'Business Unit Deleted.');
        return redirect()->route('admin.appraisal.ead-unit');
    }
}
