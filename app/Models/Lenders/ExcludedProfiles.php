<?php

namespace App\Models\Lenders;

use App\Models\BaseModel;

class ExcludedProfiles extends BaseModel
{
    protected $table = 'user_group_lender';

    public function profiles()
    {
        return $this->belongsToMany('App\Models\User','user_group_lender_exclude_appraiser','lenderid','userid')->withPivot('created_date');
    }
    public function licenses()
    {
        return $this->hasMany('App\Models\Lenders\ExcludedLicenses','lender_id');
    }
    
}
