<?php

namespace App\Models\Appraisal;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class DelayCode extends BaseModel
{
    use SoftDeletes;

    protected $table = 'appr_order_delay_code_type';
    protected $fillable = ['key','name'];

    public $timestamps = false;
}
