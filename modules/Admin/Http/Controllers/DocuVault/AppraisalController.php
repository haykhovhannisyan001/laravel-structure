<?php
    
namespace Modules\Admin\Http\Controllers\DocuVault;

use App\Models\DocuVault\Appraisal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Http\Controllers\AdminBaseController;
use Modules\Admin\Http\Requests\DocuVault\AppraisalRequest;
use Yajra\DataTables\Facades\Datatables;


class AppraisalController extends AdminBaseController
{
    /**
     * Index page for Appraisal
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin::docuvault.appraisal.index');
    }
    
    /**
     * Gather data for index page and datatables
     */
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $appraisals = Appraisal::all();
            
            return Datatables::of($appraisals)
                ->editColumn('is_active', function ($r) {
                    return ($r->is_active) ? 'Yes' : 'No';
                })
                ->addColumn('action', function ($r) {
                    return view('admin::docuvault.appraisal.partials._options', ['row' => $r]);
                })
                ->make(true);
        }
    }
    
    /**
     * Create new appraisal
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin::docuvault.appraisal.create');
    }
    
    
    public function store(AppraisalRequest $request, Appraisal $appraisal)
    {
        $appraisal->store($request);
        Session::flash('success', 'DocuVault Appraisal Type Successfully Created.');
        
        return redirect()->route('admin.docuvault.appraisal.index');
    }
    
    /**
     * Edit property type details
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $appraisal = Appraisal::findOrFail($id);
        
        return view('admin::docuvault.appraisal.edit', compact('appraisal'));
    }
    
    /**
     * Update appraisal type
     *
     * @param AppraisalRequest $request
     * @param Appraisal $appraisal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AppraisalRequest $request, Appraisal $appraisal)
    {
        $appraisal->store($request);
        Session::flash('success', 'DocuVault Appraisal Type Successfully Updated.');
        
        return redirect()->route('admin.docuvault.appraisal.index');
    }
    
    /**
     * Delete DocuVault Appraisal type
     *
     * @param Appraisal $appraisal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Appraisal $appraisal)
    {
        Session::flash('success', 'DocuVault Appraisal Type is deleted.');
        $appraisal->delete();
        
        return redirect()->route('admin.docuvault.appraisal.index');
    }
}
