<?php

namespace App\Models\Appraisal;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanType extends BaseModel
{
    use SoftDeletes;

    protected $table = 'loantype';
    protected $fillable = ['descrip','mismo_label','is_protected','is_default'];
    public $timestamps = false;
    protected $dates = ['deleted_at'];
}
