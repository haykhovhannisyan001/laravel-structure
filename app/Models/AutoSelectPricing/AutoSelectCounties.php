<?php

namespace App\Models\AutoSelectPricing;

use Illuminate\Database\Eloquent\Model;

class AutoSelectCounties extends Model
{
    protected $table = 'appr_autoselect_counties';

    protected $fillable = ['id', 'state', 'county'];
}