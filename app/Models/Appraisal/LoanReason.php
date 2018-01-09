<?php

namespace App\Models\Appraisal;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanReason extends BaseModel
{
    use SoftDeletes;

    protected $table = 'loanpurpose';
    protected $fillable = ['descrip', 'mismo_label', 'is_protected'];

    public $timestamps = false;

    public function allReasons()
    {
    	return $this->orderBy('descrip', 'ASC')->get();
    }
}
