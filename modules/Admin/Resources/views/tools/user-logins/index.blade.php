@extends('admin::layouts.master')

@section('title', 'User Logins')

@component('admin::layouts.partials._breadcrumbs', [
'crumbs' => [
  ['title' => 'Tools', 'url' => '#'],
  ['title' => 'User Logins', 'url' => route('admin.tools.user.logins')]
]
])
@endcomponent
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="panel-body panel-body-table">
                        <div class="table">
                            <div class="col-md-9">
                                {!! Form::open(['route' => 'admin.tools.user-logs.data','class' => 'form-horizontal','id' => 'filterForm']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('date_from','',['class' => 'date_from form-control datepicker','placeholder' => 'Date From']) !!}
                                    {!! Form::text('date_to','',['class' => 'date_to form-control datepicker','placeholder' => 'Date To']) !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::select('admin',$admins,'',['class' => 'admin form-control','placeholder' => 'Admin']) !!}
                                </div>
                                <div class="col-md-6 col-md-offset-6">
                                    <div class="col-md-2 pull-right">
                                        {!! Form::submit('Reset',['class' => 'btn btn-primary','id' => 'resetFilter']) !!}
                                    </div>
                                    <div class="col-md-2 pull-right">
                                        {!! Form::submit('Filter',['class' => 'btn btn-success','id' => 'sendFilter']) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel-body panel-body-table" id="showData">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Login Type</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal"></div>
@stop

@push('scripts')
<script type="text/javascript">
    $(function () {
        var data = {
            url: '{!! route('admin.tools.user.logins.data') !!}',
            data: function (d) {
                d.filter = {
                    date_from: $('.date_from').val(),
                    date_to: $('.date_to').val(),
                    admin: $('.admin').val()
                }
            }
        };
        userLogins = $app.datatables('#datatable', data, {
            dom: 'Bfrtip',
            columns: [
                {data: 'userid'},
                {data: 'dts'},
                {data: 'login'}
            ],
            order: [0, 'asc'],
            buttons: ['csv'],
            tableTools: {
                "sSwfPath": "{{ masset('swf/copy_csv_xls.swf')  }}"
            }
        });
    });
    $(document).ready(function () {
        $('#sendFilter').click(function (e) {
            e.preventDefault();
            var date_from = $('.date_from').val();
            var date_to = $('.date_to').val();
            var admin = $('.admin').val();
            if(date_from.length != 0 && date_to.length != 0){
                userLogins.on('xhr.dt', function() {
                    $('#showData').show();
                });
                userLogins.draw();
            }else{
                alert('Please fill form');
            }
        });
        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });
        $('#resetFilter').click(function (e) {
            e.preventDefault();
            $('#filterForm')[0].reset();
        });
    });
</script>
@endpush

