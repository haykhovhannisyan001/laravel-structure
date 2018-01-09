<div class="panel-body panel-body-table">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="datatable">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>License State</th>
                <th>License Number</th>
                <th>License Type</th>
                <th>License Expiration</th>
                <th>License Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ascLicenses as $ascLicense)
                <tr class="odd gradeX">
                    <td>{{ $ascLicense->fname or '' }}</td>
                    <td>{{ $ascLicense->lname or '' }}</td>
                    <td>{{ $ascLicense->street or '' }}</td>
                    <td>{{ $ascLicense->city or '' }}</td>
                    <td>{{ (getStateByAbbr($ascLicense->st_abbr))?:$ascLicense->st_abbr }}</td>
                    <td>{{ $ascLicense->zip or '' }}</td>
                    <td>{{ (getStateByAbbr($ascLicense->state))?:$ascLicense->state }}</td>
                    <td>{{ $ascLicense->lic_number or '' }}</td>
                    <td>{{ $licenseType[$ascLicense->lic_type] or '' }}</td>
                    <td>{{ $ascLicense->exp_date or '' }}</td>
                    <td>{{ ($ascLicense->status == 'I')?'Inactive':'Active' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-left">
            <p>Showing {!! number_format($ascLicenses->firstItem()) !!} to {{ number_format($ascLicenses->lastItem()) }}
                of {{ number_format($ascLicenses->total()) }} entries</p>
        </div>
        <div class="pull-right">
            {!! $ascLicenses->links() !!}
        </div>
    </div>
</div>

