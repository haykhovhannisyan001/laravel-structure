@extends('admin::layouts.master')

@section('title', 'ASC Appraiser List')

@component('admin::layouts.partials._breadcrumbs', [
'crumbs' => [
  ['title' => 'Management', 'url' => '#'],
  ['title' => 'ASC Appraiser List', 'url' => route('admin.management.asc-licenses')]
]
])
@endcomponent
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-md-9">
                                {!! Form::open(['route' => 'admin.management.asc-licenses.data','class' => 'form-horizontal','id' => 'filterForm']) !!}
                                <div class="col-md-4">
                                    {!! Form::text('expiration_from','',['class' => 'expiration_from form-control datepicker','placeholder' => 'Expiration From']) !!}
                                    {!! Form::text('expiration_to','',['class' => 'expiration_to form-control datepicker','placeholder' => 'Expiration To']) !!}
                                    {!! Form::select('license_type',$licenseType,'',['class' => 'license_type form-control','placeholder' => 'License Type']) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! Form::select('state',$states,'',['class' => 'state form-control','placeholder' => 'Select State']) !!}
                                    {!! Form::select('license_status',$licenseStatus,'',['class' => 'license_status form-control','placeholder' => 'License Status']) !!}
                                    <div class="col-md-3">
                                        {!! Form::submit('Reset',['class' => 'btn btn-primary','id' => 'resetFilter']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::submit('Save',['class' => 'btn btn-success','id' => 'sendFilter']) !!}
                                    </div>

                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    Show
                                    <select name="table_length" id="length">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50" selected>50</option>
                                        <option value="75">75</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="500">500</option>
                                    </select>
                                    entries
                                </div>
                                <div class="col-md-3 pull-right">
                                    <input type="text" id="search" class="form-control" placeholder="Search">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="asc-table"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    function getData(page, filter = '') {
        var _token = '{{ csrf_token() }}';
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.management.asc-licenses.data') }}',
            data: {_token: _token, page: page, filter: filter}
        }).done(function (data) {
            $('#asc-table').html(data);
        }).fail(function () {
            console.log('Posts could not be loaded.');
        });
    }
    function collectFilterData(page = 1) {
        var from = $('.expiration_from').val();
        var to = $('.expiration_to').val();
        var state = $('.state').val();
        var license_status = $('.license_status').val();
        var license_type = $('.license_type').val();
        var search = $('#search').val();
        var length = $('#length').val();
        var obj = {
            filter: {
                from: from,
                to: to,
                state: state,
                license_status: license_status,
                license_type: license_type
            },
            search: search,
            length: length
        };
        getData(page, obj);
    }
    $(document).ready(function () {
        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        collectFilterData();
        $(document).on('click', '#asc-table .pagination a', function (e) {
            var page = $(this).attr('href').split('page=')[1];
            collectFilterData(page);
            e.preventDefault();
        });
        $('#search').keyup(function () {
            collectFilterData();
        });
        $('#filterForm').submit(function (e) {
            e.preventDefault();
            collectFilterData();
        });
        $('#resetFilter').click(function (e) {
            e.preventDefault();
            $('#filterForm')[0].reset();
            collectFilterData();
        });
        $('#length').change(function () {
            collectFilterData();
        })
    });
</script>
@endpush