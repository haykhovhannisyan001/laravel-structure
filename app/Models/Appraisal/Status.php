<?php

namespace App\Models\Appraisal;

use App\Models\BaseModel;

class Status extends BaseModel
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'order_status';

    public function allStatuses()
    {
        return $this->orderBy('descrip', 'ASC')->get();
    }
}
