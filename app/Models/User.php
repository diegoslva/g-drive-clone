<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'fantasy_name',
        'company_name',
        'cnpj',
        'status',
        'email_verified_at',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    
    public function getCreatedAtAttribute($date) {
        return Carbon::parse($date)->format('d/m/Y');
    }

    public function parentDirectory()
    {
        return $this->hasOne(Folder::class)->whereNull('parent_id');
    }

    public function folders()
    {
      return $this->hasMany(Folder::class, 'user_id');
    }

    public function getFilesAttribute()
    {
        if ($this->parentDirectory) {
            return $this->parentDirectory->files;
        }

        return collect();
    }

    public function getImagesAttribute()
    {
        if ($this->parentDirectory) {
            return $this->parentDirectory->images;
        }

        return collect();
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ?  bcrypt($input) : $input;
        }
    }

}
