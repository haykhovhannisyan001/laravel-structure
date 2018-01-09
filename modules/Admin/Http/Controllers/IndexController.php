<?php 

namespace Modules\Admin\Http\Controllers;

use App\Models\Appraisal\Order;

class IndexController extends AdminBaseController {
	
	public function index()
	{
		return view('admin::index.index');
	}
}