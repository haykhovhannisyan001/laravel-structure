<?php 

namespace Modules\Admin\Http\Controllers\Tools;

use Modules\Admin\Http\Controllers\AdminBaseController;
use App\Models\Tools\{Setting, SettingCategory};
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\Tools\HomePagePanel;
use App\Models\UserData;
use Modules\Admin\Http\Requests\SettingsTemplates\HomePagePanelsRequest;
use Carbon\Carbon, Session, Input, Html, DB, Validator, Auth, Response, Exception;
use App\Services\CreateS3Storage;

class HomePagePanelController extends AdminBaseController {
  

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
        return view('admin::tools.home_page.index');
    }

    /**
    * Create
    * @param $request
    * @return create form
    */
    public function create()
    {
        return view('admin::tools.home_page.create_edit');
    }

    /**
    * Create
    * @param $request
    * @return void
    */
    public function store(HomePagePanelsRequest $request)
    {
        $data = $request->all();
        $path = 'uploads/';
        if ($image =  $request->file('image')) {
            $image_name = md5(microtime()).'.'.$image->getClientOriginalExtension();
            // Upload file to server
            $s3 = $this->createS3Service->make(config('filesystems.disks.s3.bucket'));
            // putFile automatically controls the streaming of this file to the storage
            $s3->putFileAs($path, $image, $image_name, $this->createS3Service->getFileVisibility('public'));
        }

        HomePagePanel::create([
            'title' => $data['title'],
            'link' => $data['link'],
            'slogan' => $data['slogan'],
            'description' => $data['description'],
            'active' => $data['active'],
            'image' => $image_name,
        ]);
        Session::flash('success', 'Successfully Created!');
        return redirect(route('admin.tools.home-page-panels'));
    }

    /**
    * Edit
    * @param $id
    * @return update form
    */
    public function edit($id)
    {
        $homePagePanel = HomePagePanel::findOrFail($id);
        return view('admin::tools.home_page.create_edit', compact('homePagePanel'));
    }

    /**
    * Update
    * @param $request, $id
    * @return void
    */
    public function update(HomePagePanelsRequest $request, $id)
    {
        $data = $request->all();
        HomePagePanel::where('id', $id)->update([
            'title' => $data['title'],
            'link' => $data['link'],
            'slogan' => $data['slogan'],
            'description' => $data['description'],
            'active' => $data['active'],
        ]);



        if($image = $request->file('image')) {
            $path = 'uploads/';
            // Delete old file from server
            $filename = HomePagePanel::where('id', $id)->first()->image;
            $s3 = $this->createS3Service->make(config('filesystems.disks.s3.bucket'));
            $exists = $s3->exists($path.$filename);
            if ($exists) {
                $s3->delete($path.$filename);
            }
            // Upload new file to server
            $image_name = md5(microtime()).'.'.$image->getClientOriginalExtension();
            $s3 = $this->createS3Service->make(config('filesystems.disks.s3.bucket'));
            $s3->putFileAs($path, $image, $image_name, $this->createS3Service->getFileVisibility('public'));

            HomePagePanel::where('id', $id)->update([
                'image' => $image_name,
            ]);
        }
        Session::flash('success', 'Successfully Updated!');
        return redirect(route('admin.tools.home-page-panels'));
    }

    /**
    * Delete
    * @param $id
    * @return void
    */
    public function destroy($id)
    {
        $path = 'uploads/';
        $filename = HomePagePanel::where('id', $id)->first()->image;
        $s3 = $this->createS3Service->make(config('filesystems.disks.s3.bucket'));
        $exists = $s3->exists($path.$filename);
        if ($exists) {
            // Delete File from S3 storage
            $s3->delete($path.$filename);
        }
        HomePagePanel::where('id', $id)->delete();
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
        $pagePanels = HomePagePanel::orderBy('sort_ord', 'ASC')->get();
        foreach ($pagePanels as $value) {
            $user = UserData::where('user_id', $value->created_by)->first();
            $userFullName = $user['firstname'] . ' ' . $user['lastname'];
            $value->created_by = $userFullName;
            $value->active = $value->active ? 'Yes' : 'No'; 
        }
        return Datatables::of($pagePanels)

            ->editColumn('image', function ($r) {
                $s3 = $this->createS3Service->make(config('filesystems.disks.s3.bucket'));
                $url = $s3->url('uploads/'.$r->image);

                return view('admin::tools.home_page.partials._image', ['row' => $r, 'url' => $url]);
            })
            ->addColumn('action', function ($r) {
                return view('admin::tools.home_page.partials._options', ['row' => $r]);
            })
            ->addColumn('move', function ($r) {
                return view('admin::tools.home_page.partials._move');
            })
            ->make(true);
    }


    /**
    * Reorder
    * @param $request
    * @return void
    */
    public function reorder(Request $request)
    {
        $inputs = $request->all();
        $data = $inputs['data'];
        DB::beginTransaction();
        try {
            foreach ($data as $row) {
                DB::table('homepage_panels')->where('id', $row['id'])->update(['sort_ord' => $row['sort_id']]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}