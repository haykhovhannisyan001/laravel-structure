<?php

namespace App\Models\Management;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ASCLicense extends BaseModel
{
    protected $table = 'asc_data';
    protected $fillable = [
        'st_abbr',
        'lic_number',
        'lname',
        'fname',
        'mname',
        'name_suffix',
        'street',
        'city',
        'state',
        'zip',
        'company',
        'phone',
        'country',
        'country_code',
        'status',
        'lic_type',
        'exp_date',
        'post_lat',
        'post_long'
    ];

    public $timestamps = false;

    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            $query->where('fname', 'like', $search . '%');
            $query->orWhere('lname', 'like', $search . '%');
            $query->orWhere('lic_number', 'like', $search . '%');
            $query->orWhere('city', 'like', $search . '%');
        }
        return $query;
    }

    public function scopeFilter($query,$filter)
    {
        if (!empty($filter)) {
            if (!empty($filter['from'])) {
                $query->where('exp_date', '>=', $filter['from']);
            }
            if (!empty($filter['to'])) {
                $query->where('exp_date', '<=', $filter['to']);
            }
            if (!empty($filter['state'])) {
                $query->where('state', '=', $filter['state']);
            }
            if (!empty($filter['license_status'])) {
                $query->where('status', '=', $filter['license_status']);
            }
            if (!empty($filter['license_type'])) {
                $query->where('lic_type', '=', $filter['license_type']);
            }
        }
        return $query;
    }

    public static function getLicenseTypes()
    {
        $licenseType = array(
            1 => 'Licensed',
            2 => 'Certified General',
            3 => 'Certified Residential',
            4 => 'Transitional License',
        );
        return $licenseType;
    }

    public static function getLicenseStatus()
    {
        $licenseStatus = [
            'A' => 'Active',
            'I' => 'Inactive'
        ];
        return $licenseStatus;
    }
}
