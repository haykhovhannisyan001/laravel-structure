<?php

namespace App\Models;

use App\Models\BaseModel;

class UserData extends BaseModel
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'user_data';

  protected $fillable = ['user_id', 'firstname', 'lastname'];
}
