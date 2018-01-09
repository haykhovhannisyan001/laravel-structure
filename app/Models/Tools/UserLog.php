<?php

namespace App\Models\Tools;

use App\Models\BaseModel;

class UserLog extends BaseModel
{
    protected $table = 'order_log';

    public function scopeFilter($query, $filter)
    {
        if(!empty($filter['date_from'])){
            $query->where('dts','>=',$filter['date_from']);
        }
        if(!empty($filter['date_to'])){
            $query->where('dts','<=',$filter['date_to']);
        }
        if(!empty($filter['admin'])){
            $query->where('userid','=',$filter['admin']);
        }
        if(!empty($filter['log_type'])){
            $query->where('type_id','=',$filter['log_type']);
        }
        return $query;
    }

    public function logType()
    {
        return $this->hasOne('App\Models\Appraisal\LogType','id','type_id');
    }
}
