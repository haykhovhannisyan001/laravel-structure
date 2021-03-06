@extends('admin::layouts.master')

@section('title', 'Edit User Group')

@component('admin::layouts.partials._breadcrumbs', [
'crumbs' => [
  ['title' => 'Tiger', 'url' => '#'],
  ['title' => 'Clients', 'url' => route('admin.tiger.clients.index')],
  ['title' => 'Update for Client '.$client->title, 'url' => '']
]
])
@endcomponent
@section('content')
    <div class="tabbable-line">
        <ul class="nav nav-tabs ">
            <li class="active">
                <a href="#client" data-toggle="tab">
                    Basic Info </a>
            </li>
            <li class="">
                <a href="#payment_profile" data-toggle="tab">
                    Payment Info </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="client">
                <div class="row">
                    <div class="col-lg-8">
                        {{ Form::model($client, ['route' => ['admin.tiger.clients.update', $client->id], 'method' => 'patch', 'class' => 'form-horizontal']) }}

                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Update</h3>
                            </div>
                            @include('admin::tiger.clients.partials._form', ['button_label' => 'Update'])
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="tab-pane"  id="payment_profile">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        TBA
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop