@extends('admin::layouts.master')


@section('title', isset($homePagePanel) ? "Edit Home Page Panel" : 'Create Home Page Panel')

@component('admin::layouts.partials._breadcrumbs', [
    'crumbs' => [
        ['title' => 'Home Page Panel Manager', 'url' => '#'],
        ['title' => isset($homePagePanel) ? "Edit Home Page Panel" : 'Create Home Page Panel', 'url' => isset($homePagePanel) ? route('admin.tools.home-page-panels.edit', ['id' => $homePagePanel->id]) : route('admin.tools.home-page-panels.create')]
    ]
])
@endcomponent

@section('content')
    <div class="row">
        <div class="col-lg-6">
            @if(isset($homePagePanel))
                {{ Form::model( $homePagePanel, ['route' => ['admin.tools.home-page-panels.update', 'id' => $homePagePanel->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
                {{method_field('put')}}
            @else
                {{ Form::open(['route' => ['admin.tools.home-page-panels.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
            @endif
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">{{isset($homePagePanel) ? 'Updating' : 'Creating'}}</h3>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {{ Form::label('title', 'Title', ['class' => 'col-lg-3 col-xs-12 required']) }}
                                        <div class="col-lg-12 col-xs-12">
                                            {{ Form::text('title', old('title'), ['class' => 'form-control', 'required']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('link', 'Links', ['class' => 'col-lg-3 col-xs-12 required']) }}
                                        <div class="col-lg-12 col-xs-12">
                                            {{ Form::text('link', old('link'), ['class' => 'form-control', 'required']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('slogan', 'Slogan', ['class' => 'col-lg-3 col-xs-12 required']) }}
                                        <div class="col-lg-12 col-xs-12">
                                            {{ Form::textarea('slogan', old('slogan'), ['class' => 'form-control', 'style' => 'resize: vertical', 'size' => '4x3', 'required']) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('description', 'Description', ['class' => 'col-lg-3 col-xs-12']) }}
                                        <div class="col-lg-12 col-xs-12">
                                            {{ Form::textarea('description', old('description'), ['class' => 'form-control', 'style' => 'resize: vertical', 'size' => '4x3']) }}
                                        </div>
                                    </div>
                                    @if(isset($homePagePanel))
                                        <div class="form-group">
                                            {{ Form::label('image', 'Image', ['class' => 'col-lg-3 col-xs-12']) }}
                                            <div class="col-lg-12 col-xs-12">
                                                {{ Form::file('image', old('image')) }}
                                            </div>
                                        </div>
                                    @else 
                                        <div class="form-group">
                                            {{ Form::label('image', 'Image', ['class' => 'col-lg-3 col-xs-12 required']) }}
                                            <div class="col-lg-12 col-xs-12">
                                                {{ Form::file('image', ['required' => 'required']) }}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        {{ Form::label('active', 'Active', ['class' => 'col-lg-3 col-xs-12']) }}
                                        <div class="col-lg-12 col-xs-12">
                                            {{ Form::select('active', [0 => 'No', 1 => 'Yes'], old('active'), ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="ibox-footer">
                                    <button class="btn btn-success pull-right">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@stop