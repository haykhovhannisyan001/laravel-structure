@extends('admin::layouts.master')

@section('title', 'Fha Licenses')

@component('admin::layouts.partials._breadcrumbs', [
'crumbs' => [
  ['title' => 'Management', 'url' => '#'],
  ['title' => 'FHA Licenses', 'url' => route('admin.management.fha-licenses.index')]
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
                            <table class="table table-striped table-bordered table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Number</th>
                                    <th>Expiration</th>
                                    <th>Type</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip</th>
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
<script>
    $(function() {
        $app.datatables('#datatable', '{!! route('admin.management.fha-licenses.data') !!}', {
            columns: [
                { data: 'firstname', name: 'firstname' },
                { data: 'lastname', name: 'lastname' },
                { data: 'license_number', name: 'license_number'},
                { data: 'license_exp_human', name: 'license_exp_human'},
                { data: 'license_type', name: 'license_type'},
                { data: 'address', name: 'address'},
                { data: 'city', name: 'city'},
                { data: 'state', name: 'state', searchable: true},
                { data: 'zip', name: 'zip'}
            ],
            order : [ [ 0, 'asc' ] ],
            initComplete: function () {
                var states = {!! $states !!};
                var column = this.api().columns(7);
                var select = $('<select style="width: 200px;float:right;margin-right:30px;"><option value=""></option></select>')
                        .appendTo( $('#datatable_filter') )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                            );

                            column
                                    .search( val )
                                    .draw();
                        } );
                for (var stateCode in states) {
                    select.append( '<option value="'+stateCode+'">'+states[stateCode]+'</option>' )
                }
            }
        });
    });
</script>
@endpush