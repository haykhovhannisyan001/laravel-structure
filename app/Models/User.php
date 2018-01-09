<?php

namespace App\Models;

use App\Models\Appraiser\AppraiserGroup;
use Carbon;
use App\Models\BaseModel;
use App\Hash\Hasher as Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Authenticatable
{
    use Notifiable;

    const USER_TYPE_ADMIN = 1;
    const APPRAISER = 4;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    protected $fillable = [
        'email',
        'active',
        'password',
        'password_confirmation',
        'user_type',
        'admin_priv'
    ];

    protected $primaryKey = 'id';
    public static $rules = [
        'email' => 'required|email|max:255|unique:user',
        'password' => 'required|min:6|confirmed',
    ];

    public function beforeSave()
    {
        if ($this->password) {
            $this->password = (new Hash)->make($this->password);
        }

        unset($this->password_confirmation);

        if($this->isNewRecord) {
            $this->register_date = Carbon::now();
        }

        return parent::beforeSave();
    }

    public function getPublicInfo()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'fullname' => $this->fullname,
        ];
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    public function getFullNameAttribute()
    {
        return $this->userData ? trim(ucwords(strtolower($this->userData->firstname . ' ' . $this->userData->lastname))) : null;
    }

    public function userData()
    {
        return $this->hasOne('App\Models\UserData', 'user_id');
    }
    public function userType()
    {
        return $this->hasOne('App\Models\Management\UserType', 'id','user_type');
    }

    public function remoteFiles()
    {
        return $this->hasMany('App\Models\Tools\RemoteFile' );
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function isActive()
    {
        return $this->active == 'Y';
    }

    public function isAdmin()
    {
        return $this->user_type == static::USER_TYPE_ADMIN;
    }

    public function hasAdminAccess()
    {
        return $this->isActive() && $this->isAdmin();
    }

    public function scopeAdmins($query)
    {
        return $query->with('userData')->where('user_type', static::USER_TYPE_ADMIN);
    }

    /**
     * user appraiser in many groups
     *
     * @return mixed
     * @author CodeIdea
     */
    public function appraiserGroups()
    {
        return $this->belongsToMany(AppraiserGroup::class, 'appr_group_user', 'userid', 'groupid')->with('userData');
    }
}
