<?php

namespace App\Models\Geo;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddressGeoCode extends BaseModel
{
    use SoftDeletes;

    protected $table = 'address_geo_code';
    protected $fillable = ['address', 'city', 'state', 'zip', 'country', 'lat', 'long','address_not_formatted'];
}
