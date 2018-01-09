<?php

namespace App\Models\Tickets;

use Carbon\Carbon;
use App\Models\BaseModel;

class Ticket extends BaseModel
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'tickets';

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
}