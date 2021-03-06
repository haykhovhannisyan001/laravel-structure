<link href="{{ masset('css/settings_templates/home_page_panels/options.css') }}" rel="stylesheet" />
<a class="btn btn-info buttons_style home_page_panels_edit_button" data-id="{{$row->id}}" href="{{ route('admin.tools.home-page-panels.edit', ['id' => $row->id]) }}"><i class="fa fa-edit"></i> Edit</a>
@if(!$row->is_protected)
	{{ Form::open( ['route' => ['admin.tools.home-page-panels.delete', 'id' => $row->id], 'class' => 'form-horizontal']) }}
		{{method_field('delete')}}
		<button type="submit" class="btn btn-danger buttons_style home_page_panels_delete_button"><i class="fa fa-trash"></i> Delete</button>
	{{ Form::close() }}
@endif