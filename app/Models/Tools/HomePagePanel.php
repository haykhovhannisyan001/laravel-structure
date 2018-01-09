<?php

namespace App\Models\Tools;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\ModifiedUser;

class HomePagePanel extends Model
{
    use ModifiedUser;
    
    protected $table = 'homepage_panels';

    protected $fillable = [
        'image',
        'title',
        'slogan',
        'description',
        'created_by',
        'sort_ord',
        'active',
        'link',
    ];
}
