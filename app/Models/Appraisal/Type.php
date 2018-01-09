<?php

namespace App\Models\Appraisal;

use App\Models\BaseModel;
use DB;

class Type extends BaseModel
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'appr_type';

    public function getTitleAttribute() {
        return $this->form ? trim( $this->form . ' - ' . $this->descrip ) : $this->descrip;
    }

    public function allTypes() {
        return $this->orderBy(DB::raw('CONCAT(form,"",descrip)'), 'ASC')->get();
    }
}
