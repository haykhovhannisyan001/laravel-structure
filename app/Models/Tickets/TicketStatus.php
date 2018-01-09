<?php

namespace App\Models\Tickets;

use Carbon\Carbon;
use App\Models\BaseModel;

class TicketStatus extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tickets_status';

    /**
     * Fillable Fields
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'bgcolor',
        'textcolor'
    ];

    /**
     * We don't use saved and updated timestamps
     *
     * @var bool
     */
    public $timestamps = false;


    public function beforeSave()
    {
        $this->skey = getCode($this->name);
        return parent::beforeSave();
    }


    /**
     * Store ticket status
     *
     * @param $request
     * @return bool
     */
    public function store($request)
    {
        $status = TicketStatus::findOrNew($request->id);
        $status->fill($request->all());

        $status->save();

        return true;
    }


}
