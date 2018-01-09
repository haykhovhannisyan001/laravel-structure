<?php

namespace App\Models\Integrations\MercuryNetwork;

use Illuminate\Database\Eloquent\Model;

class MercuryStatusRelation extends Model
{
   /**
   * The table associated with the model.
   *
   * @var string
   */
    protected $table = 'mercury_order_status_relation';

    protected $fillable = ['mercury_status_id', 'lni_status_id'];

    public $timestamps = false;
}
