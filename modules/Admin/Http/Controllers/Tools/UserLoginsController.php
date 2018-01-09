<?php

namespace Modules\Admin\Http\Controllers\Tools;

use App\Models\Tools\UserLogin;
use Illuminate\Http\Request;
use Modules\Admin\Http\Controllers\AdminBaseController;
use Modules\Admin\Http\Requests\UserLogsRequest;
use Yajra\DataTables\Datatables;

class UserLoginsController extends AdminBaseController
{

    /**
     * Get index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $admins = admins();
        $admins = $admins->keyBy('id')->sortBy('userData.firstname')->map(function ($item) {
            return $item->userData->firstname . ' ' . $item->userData->lastname;
        });
        return view('admin::tools.user-logins.index',compact('admins'));
    }

    /**
     * Get JSON data with all rows
     * @param Request $request
     * @return mixed
     */
    public function userLoginsData(UserLogsRequest $request)
    {
        if ($request->ajax()) {
            if(!empty($request->filter['date_from']) && !empty($request->filter['date_to']) && !empty($request->filter['admin'])){
                $userLogins = UserLogin::filter($request->filter)->get();
            }else {
                $userLogins = UserLogin::all();
            }
            return Datatables::of($userLogins)
                ->editColumn('userid',function($r){
                    return $r->user->userData->firstname . ' ' . $r->user->userData->lastname;
                })
                ->editColumn('login', function($r){
                    return $r->types[$r->login];
                })
                ->make(true);
        }
    }
}
