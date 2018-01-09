<?php

namespace App\Models\Integrations\MercuryNetwork;

use Illuminate\Database\Eloquent\Model;

class MercuryLoanType extends Model
{
    /**
   * The table associated with the model.
   *
   * @var string
   */
    protected $table = 'mercury_loan_types';

    protected $fillable = ['title', 'external_id'];


    public function allTypes()
    {
        return $this->orderBy('title', 'ASC')->get();
    }
}
