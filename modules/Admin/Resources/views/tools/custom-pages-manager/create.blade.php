@extends('admin::layouts.master')

@section('title', 'Custom Pages Manager')

@component('admin::layouts.partials._breadcrumbs', [
    'crumbs' => [
      ['title' => 'Custom Pages Manager', 'url' => '#'],
      ['title' => 'Custom Pages', 'url' => route('admin.tools.custom-pages-manager.index')],
      ['title' => 'New Custom Page', 'url' => '#']
    ]
])
@endcomponent

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"></h3>
                </div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h3 class="text-center" style="color:cornflowerblue">Custom Page Information </h3>
                    {{ Form::open([ 'route' => 'admin.tools.custom-pages-manager.store',
                                    'class' => 'form-group',
                                    'id' => 'custom-page-store-form',
                                    'file'=> 'true', 'enctype' => 'multipart/form-data'])}}
                        @include('admin::tools.custom-pages-manager.partials._form', ['button_label' => 'Create'])
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
<script type="text/javascript">
    // Ckeditor
    $(document).ready(function() {
        CKEDITOR.replace('content');
    });
</script>
<script src="{{ masset('js/modules/admin/tools/custom-pages-manager/validation.js') }}"></script>
@endpush