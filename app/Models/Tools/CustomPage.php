<?php

namespace App\Models\Tools;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Services\CreateS3Storage;

class CustomPage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'custom_pages';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'title',
        'description',
        'keywords',
        'route',
        'content',
        'template_id',
        'is_active',
        'permission',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
        'is_protected',
        'logo_image',
        'logo_link',
        'logo_title',
        'logo_slogan',
        'logo_description'
    ];

    /**
     * custom page is created by user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->with('userData');
    }

    /**
     * return custom page logo path
     *
     * @return response
     */
    public function customPageLogoImagePath()
    {
        
        $createS3Service = new CreateS3Storage();
        
        $bucketName = env('S3_BUCKET');

        // Upload file to server
        $s3 = $createS3Service->make($bucketName);
        
        return $s3->url('custom-pages/'.$this->id.'/'.$this->logo_image);
    }
}
