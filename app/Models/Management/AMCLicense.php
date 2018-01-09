<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Model;

class AMCLicense extends Model
{
    protected $table = 'amc_registration';
    protected $fillable = ['state','reg_number','expires','sec_expires','admin_id'];
}
