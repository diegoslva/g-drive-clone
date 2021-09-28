<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Folder extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;
    
    
    public $table = 'folders';

    protected $appends = [
        'files',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'parent_id',
        'thumbnail_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    // protected static function booted()
    // {
    //     static::creating(fn(Folder $folder) => $folder->id = (string) Uuid::uuid4());
    // }
    
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function getAttributeDate(Carbon $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null) : void
    {
        $this->addMediaConversion('thumb')->fit('crop', 100, 100);
    }

    public function getFilesAttribute()
    {
        $files = $this->getMedia('files');

        $files->map(function ($file) {
            $file->thumbnail = substr($file->mime_type, 0, 5) == 'image' ? $file->getUrl('thumb') : null;
        });

        return $files;
    }

    public function getImagesAttribute()
    {
        return $this->files->filter(function ($file) {
            return substr($file->mime_type, 0, 5) == 'image';
        });
    }

    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }
    
    public function getCreatedAtAttribute($date) {
        return Carbon::parse($date)->format('d/m/Y');
    }
    
    public function getUpdatedAtAttribute($date) {
        return Carbon::parse($date)->format('d/m/Y');
    }
}
