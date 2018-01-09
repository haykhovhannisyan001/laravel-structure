<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	@if(View::hasSection('title'))
		<title>Landmark Network - @yield('title')</title>
	@else
		<title>Landmark Network</title>
	@endif

	<link href="{{ masset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ masset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

	<link href="{{ masset('css/animate.css') }}" rel="stylesheet">
	<link href="{{ masset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
	<link href="{{ masset('css/plugins/summernote/summernote.css')  }}" rel="stylesheet" type="text/css" />
	<link href="{{ masset('css/plugins/iCheck/custom.css')  }}" rel="stylesheet">
	<link href="{{ masset('css/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')  }}" rel="stylesheet" type="text/css" />
	<link href="{{ masset('css/plugins/bootstrap-select/bootstrap-select.css')  }}" rel="stylesheet" type="text/css" />
	<link href="{{ masset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ masset('css/plugins/codemirror/codemirror.css') }}" rel="stylesheet" type="text/css" />
	<link rel="icon" href="{{ masset('favicon.ico')  }}" type="image/x-icon" />

	<link href="{{ masset('css/style.css') }}" rel="stylesheet">
	<link href="{{ '/modules/dashboard/style.css' }}" rel="stylesheet">

	<script type="text/javascript">var $app = {};</script>
	@stack('heads')
	{!! Asset::styles() !!}
</head>

<body class="">

<div id="wrapper">

	<div id="page-wrapper" class="gray-bg">

		<div class="row border-bottom">
			<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
						<div class="navbar-header" style="padding:10px;">
							<a href='{{ route('admin') }}'>
								<img src='{{ companyLogo() }}' class="img-responsive" />
							</a>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
						<ul class="nav navbar-top-links" style="margin-top:10px;">
							<li class="environments">
								<button data-toggle="dropdown" class="btn btn-default" type="button" aria-expanded="false">Quick Nav. <span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="{{ route('admin') }}">Home</a></li>
									<li><a href="#">Order</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="col-lg-4 col-md-3 col-sm-3 col-xs-8">
						<form role="search" class="form-horizontal navbar-form-custom " action="" style="margin-top:10px;">
							<div class="col-lg-8 col-xs-10">
								<div class="form-group">
									<input type="text" placeholder="Search..." class="form-control" name="top-search" id="top-search">
									<ul class="dropdown-menu noticebar-menu noticebar-hoverable search-bar-results hover-content" role="menu"></ul>
								</div>
							</div>


							<div class="col-lg-4 col-xs-2">
								<div class="form-group">
									<select id='navbar-search-type' name='navbar-search-type' class='form-control select'>
										<option value='appraisal' >Appraisal</option>
										<option value='markitvalue' >Alternative Valuation</option>
										<option value='docuvault' >DocuVault</option>
										<option value='user' >User</option>
										<option value='group' >Client Settings</option>
										<option value='lender' >Wholesale Lender</option>
										<option value='ticket' >Support Ticket</option>
										<option value='setting' >Settings</option>
									</select>
								</div>
							</div>

						</form>
					</div>
					<div class="col-lg-4 col-lg-offset-0 col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-0 col-xs-4">
						<ul class="nav navbar-top-links navbar-right" style="margin-top:10px;">
							<li class="environments">
								<button data-toggle="dropdown" class="btn btn-default" type="button" aria-expanded="false">Dashboard <span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">My Account</a></li>
									<li><a href="#">Test Email</a></li>
									<li><a href="{{ route('admin.logout') }}">Log Out</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>

		@include('admin::layouts.partials._breadcrumbs')

		<div class="wrapper wrapper-content">
			@yield('content')
		</div>

		<div class="footer">
			<div>
				Landscape &copy; {{ date('Y') }}
			</div>
		</div>

	</div>
</div>

<!-- Mainly scripts -->
<script src="{{ masset('js/jquery-2.1.1.js') }}"></script>
<script src="{{ masset('js/bootstrap.min.js') }}"></script>
<script src="{{ masset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ masset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<script src="{{ masset('js/plugins/dataTables/datatables.min.js')  }}"></script>
<script src="{{ masset('js/plugins/dataTables/dataTables.responsive.min.js')  }}"></script>
<script src="{{ masset('js/plugins/codemirror/codemirror.js')  }}"></script>
<script src="{{ masset('js/plugins/codemirror/mode/xml/xml.js')  }}"></script>
<script src="{{ masset('js/plugins/codemirror/mode/javascript/javascript.js')  }}"></script>
<script src="{{ masset('js/plugins/codemirror/mode/css/css.js')  }}"></script>
<script src="{{ masset('js/plugins/codemirror/mode/php/php.js')  }}"></script>
<script src="{{ masset('js/plugins/codemirror/mode/htmlmixed/htmlmixed.js')  }}"></script>
<script src="{{ asset('vendor/handlebars/handlebars-v4.0.5.js') }}"></script>
<script src="{{ asset('vendor/lodash/lodash.js') }}"></script>


<!-- Custom and plugin javascript -->
<script src="{{ masset('js/inspinia.js') }}"></script>
<script src="{{ masset('js/modules/admin/ui.js') }}"></script>
<script src="{{ masset('js/modules/admin/datatables.js')  }}"></script>
<script type="text/javascript" src="{{ masset('js/modules/admin/datatables/buttons.html5.min.js')  }}"></script>
<script type="text/javascript" src="{{ masset('js/modules/admin/datatables/dataTables.buttons.min.js')  }}"></script>
<script type="text/javascript" src="{{ masset('js/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ masset('js/plugins/iCheck/icheck.min.js')  }}"></script>
<script type="text/javascript" src="{{ masset('js/plugins/moment.min.js')  }}"></script>
<script type="text/javascript" src="{{ masset('js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')  }}"></script>
<script type="text/javascript" src="{{ masset('js/plugins/bootstrap-select/bootstrap-select.js')  }}"></script>
<script src="{{ masset('js/plugins/toastr/toastr.min.js') }}"></script>
{{--<script>--}}
	{{--$app.user = {!! json_encode(admin()->getPublicInfo()) !!};--}}
	{{--$(document).ready(function () {--}}
		{{--@foreach(['success', 'error', 'warning', 'info'] as $message)--}}
				{{--@if(Session::has($message))--}}
				{{--toastr['{{$message}}']('{{ Session::get($message) }}', '{{$message}}'.toUpperCase());--}}
		{{--@endif--}}
		{{--@endforeach--}}
	{{--});--}}

</script>

@stack('scripts')
{!! Asset::scripts() !!}

<script id="search-result-row" type="text/x-handlebars-template">
	<li>
		<a href="@{{link}}" target="_blank" class="noticebar-item">
			<div class="noticebar-item-body">
				<div class="noticebar-item-text">@{{{title}}}</div>
				<div class="noticebar-item-time">@{{{description}}}</div>
			</div>
		</a>
	</li>
</script>

<script src="{{ masset('js/search.js') }}"></script>

</body>

</html>
