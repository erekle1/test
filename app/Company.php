<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

/**
 * Class Company
 * @package App
 */
class Company extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [ 'website', 'email', 'name' ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany(Employ::class);
    }

    /**
     * @return int
     */
    public function getNumberOfEmployeesAttribute()
    {
        return $this->employees()->count();
    }

    /**
     * @return int
     */
    public function getSlugAttribute()
    {
        return $this->name . "_" . $this->id;
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232);
    }

}

