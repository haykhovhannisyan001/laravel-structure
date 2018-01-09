<?php

namespace App\Models\Appraisal;

use Carbon\Carbon;
use App\Models\BaseModel;

class Order extends BaseModel
{
  const TEMP_STATUS = 9;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'appr_order';

  public function getAddressAttribute() {
    return trim( trim($this->propaddress1 . ' ' . $this->propaddress2) . ', ' . $this->propcity . ', ' . $this->propstate . ' ' . $this->propzip );
  }

  public function getClientNameAttribute() {
    return $this->client ? $this->client->fullname : null;
  }

  public function getAppraisalTypeNameAttribute() {
    return $this->appraisalType ? $this->appraisalType->title : null;
  }

  public function getStatusNameAttribute() {
    return $this->orderStatus ? $this->orderStatus->descrip : null;
  }

  public function getSearchDateString() {
    return $this->date_delivered ? ( Carbon::createFromFormat('Y-m-d H:i:s', $this->date_delivered)->format('m/d/Y') . ' Delivered' ) : ( Carbon::createFromFormat('Y-m-d H:i:s', $this->ordereddate)->format('m/d/Y') . ' Ordered' );
  }

  public function scopeActive($query)
  {
      return $query->where('status', '!=', static::TEMP_STATUS);
  }

  /**
   * Conneciton to User table
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function client()
  {
      return $this->belongsTo('App\Models\User', 'orderedby');
  }

  /**
   * Conneciton to status table
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function orderStatus()
  {
      return $this->belongsTo('App\Models\Appraisal\Status', 'status');
  }

  /**
   * Conneciton to Appraisal Type table
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function appraisalType()
  {
      return $this->belongsTo('App\Models\Appraisal\Type', 'appr_type');
  }
}