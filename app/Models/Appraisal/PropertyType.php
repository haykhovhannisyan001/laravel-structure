<?php

namespace App\Models\Appraisal;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyType extends BaseModel
{
    use SoftDeletes;
    
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'prop_types';
    
    /**
     * Fillable Fields
     *
     * @var array
     */
    protected $fillable = [
        'descrip',
        'mismo_label'
    ];
    
    /**
     * Soft Delete column
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    /**
     * We don't use saved and updated timestamps
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * Store property type
     *
     * @param $request
     * @return bool
     */
    public function store($request)
    {
        $propertyType = PropertyType::findOrNew($request->id);
        $propertyType->fill($request->all());
        $propertyType->save();
    
        return true;
    }
    
    /**
     * Check if property type can be soft deleted
     *
     * @param PropertyType $propertyType
     * @return bool
     */
    public function isProtected()
    {
        return $this->is_protected;
    }
}
