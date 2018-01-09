<?php 

namespace Modules\Admin\Http\Controllers\Tools;

use Modules\Admin\Http\Controllers\AdminBaseController;
use App\Models\Tools\{Setting, SettingCategory};
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\SettingsTemplates\LogoManagerRequest;
use App\Models\Tools\LogoManager;
use Carbon\Carbon, Session, Input, Html, DB, Validator, Auth, Response, Exception;
use App\Services\CreateS3Storage;

class LogoManagerController extends AdminBaseController {


    protected $createS3Service;

    public function __construct()
    {
        $this->createS3Service = new CreateS3Storage;
    }


    /**
    * Index
    * @param $request
    * @return index page
    */
    public function index()
    {
        return view('admin::tools.logo_manager.index');
    }

    /**
    * Create
    * @param $request
    * @return create form
    */
    public function create()
    {
        return view('admin::tools.logo_manager.create_edit');
    }

    /**
    * Create
    * @param $request
    * @return void
    */
    public function store(LogoManagerRequest $request)
    {
        $inputs = $request->all();
        $path = 'uploads/';
        if ($image =  $request->file('image')) {
            $image_name = md5(microtime()).'.'.$image->getClientOriginalExtension();
            // Upload file to server
            $s3 = $this->createS3Service->make(config('filesystems.disks.s3.bucket'));
            // putFile automatically controls the streaming of this file to the storage
            $s3->putFileAs($path, $image, $image_name, $this->createS3Service->getFileVisibility('public'));
        }

        LogoManager::create([
            'title' => $inputs['title'],
            'image' => $image_name,
            'start_date' => Carbon::parse($inputs['start_date'])->timestamp,
            'end_date' => Carbon::parse($inputs['end_date'])->timestamp,
        ]);
        Session::flash('success', 'Successfully Created!');
        return redirect(route('admin.tools.logos'));
    }

    /**
    * Edit
    * @param $id
    * @return update form
    */
    public function edit($id)
    {
        $logo = LogoManager::where('id', $id)->first();
        return view('admin::tools.logo_manager.create_edit', compact('logo'));
    }

    /**
    * Update
    * @param $request, $id
    * @return void
    */
    public function update(LogoManagerRequest $request, $id)
    {
        $inputs = $request->all();

        LogoManager::where('id', $id)->update([
            'title' => $inputs['title'],
            'start_date' => Carbon::parse($inputs['start_date'])->timestamp,
            'end_date' => Carbon::parse($inputs['end_date'])->timestamp,
        ]);
        
        if($image = $request->file('image')) {
            $path = 'uploads/';
            // Delete old file from server
            $filename = LogoManager::where('id', $id)->first()->image;
            $s3 = $this->createS3Service->make(config('filesystems.disks.s3.bucket'));
            $exists = $s3->exists($path.$filename);
            if ($exists) {
                $s3->delete($path.$filename);
            }
            // Upload new file to server
            $image_name = md5(microtime()).'.'.$image->getClientOriginalExtension();
            $s3 = $this->createS3Service->make(config('filesystems.disks.s3.bucket'));
            $s3->putFileAs($path, $image, $image_name, $this->createS3Service->getFileVisibility('public'));

            LogoManager::where('id', $id)->update([
                'image' => $image_name,
            ]);
        }

        Session::flash('success', 'Successfully Updated!');
        return redirect(route('admin.tools.logos'));
    }

    /**
    * Delete
    * @param $id
    * @return void
    */
    public function destroy($id)
    {
        $path = 'uploads/';
        $filename = LogoManager::where('id', $id)->first()->image;
        $s3 = $this->createS3Service->make(config('filesystems.disks.s3.bucket'));
        $exists = $s3->exists($path.$filename);
        if ($exists) {
            // Delete File from S3 storage
            $s3->delete($path.$filename);
        }
        LogoManager::where('id', $id)->delete();
        Session::flash('success', 'Successfully Deleted!');
        return redirect()->back();
    }

   /**
     * Yajra\Datatables\Datatables api route for frontend
     *
     * @return \Response
     */
    public function data()
    {
        $logos = LogoManager::orderBy('created_at', 'DESC')->get();
        foreach ($logos as $logo) {
            $logo->is_active = $logo->is_active ? 'Yes' : 'No';
            $logo->start_date = date("m/d/Y", $logo->start_date);
            $logo->end_date = date("m/d/Y", $logo->end_date);
        }
        return Datatables::of($logos)

            ->editColumn('image', function ($r) {
                $s3 = $this->createS3Service->make(config('filesystems.disks.s3.bucket'));
                $url = $s3->url('uploads/'.$r->image);

                return view('admin::tools.logo_manager.partials._image', ['row' => $r, 'url' => $url]);
            })
            ->addColumn('action', function ($r) {
                return view('admin::tools.logo_manager.partials._options', ['row' => $r]);
            })
            ->make(true);
    }
}
