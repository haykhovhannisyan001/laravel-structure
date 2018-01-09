<?php

namespace App\Models\Integrations\MercuryNetwork;

use Illuminate\Database\Eloquent\Model;

class MercuryApprType extends Model
{
    /**
   * The table associated with the model.
   *
   * @var string
   */
    protected $table = 'mercury_appr_types';

    protected $fillable = ['external_id' ,'title'];

    public function allTypes()
    {
        return $this->orderBy('title', 'ASC')->get();
    }
}
