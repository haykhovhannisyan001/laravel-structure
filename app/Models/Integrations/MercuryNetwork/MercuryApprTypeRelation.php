<?php

namespace App\Models\Integrations\MercuryNetwork;

use Illuminate\Database\Eloquent\Model;

class MercuryApprTypeRelation extends Model
{
    /**
   * The table associated with the model.
   *
   * @var string
   */
    protected $table = 'mercury_order_appraisal_type_relation';

    protected $fillable = ['mercury_type_id' ,'lni_type_id', 'property_type_id', 'occ_type_id', 'addendas'];

    public $timestamps = false;

    public function getSavedData()
    {
        return $this->all();
    }
}
