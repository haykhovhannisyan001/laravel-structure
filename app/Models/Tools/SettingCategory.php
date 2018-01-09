<?php

namespace App\Models\Tools;

use App\Models\BaseModel;

class SettingCategory extends BaseModel
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'setting_category';
  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = false;

  protected $fillable = ['title', 'ord', 'description'];

  public static $rules = [
    'title' => 'required|min:3|max:55',
    'description' => 'max:155',
  ];

  public function beforeSave() {
    if(!$this->key) {
      $this->key = str_slug($this->title, '_');
    }

    return parent::beforeSave();
  }

  public function settings()
  {
    return $this->hasMany('App\Models\Tools\Setting', 'category_id');
  }
}
