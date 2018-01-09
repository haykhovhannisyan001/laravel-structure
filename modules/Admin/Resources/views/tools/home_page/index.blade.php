@extends('admin::layouts.master')

@section('title', 'Home Page Panels Manager')

@component('admin::layouts.partials._breadcrumbs', [
    'crumbs' => [
        ['title' => 'Settings & Templates', 'url' => '#'],
        ['title' => 'Home Page Panels Manager', 'url' => route('admin.tools.home-page-panels')]
    ],
    'actions' => [
        ['title' => 'Add Page Panels Manager', 'url' => route('admin.tools.home-page-panels.create')]
    ]
])
@endcomponent

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="datatable" style="text-align: center;">
                                <thead>
                                <tr>
                                    <th>Move</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Active</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script type="text/javascript" src="{{ masset('js/settings_templates/home_page_panels/index.js') }}"></script>
@endpush