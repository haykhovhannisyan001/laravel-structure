<?php

namespace App\Models\Integrations\MercuryNetwork;

use Illuminate\Database\Eloquent\Model;

class MercuryLoanTypeRelation extends Model
{
    /**
   * The table associated with the model.
   *
   * @var string
   */
    protected $table = 'mercury_order_loan_type_relation';

    protected $fillable = ['mercury_type_id', 'lni_type_id', 'lni_reason_id'];

    public $timestamps = false;
}
