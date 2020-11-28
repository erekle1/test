<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Employ extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [ 'first_name', 'last_name', 'email', 'phone', 'company_id' ];
    protected $table = "employees";

    /**
     *
     */
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    /**
     * @return string
     */
    public function getSlugAttribute()
    {
        return  $this->full_name.'_' . $this->id;
    }

    public function getFullNameAttribute(){
       return  $this->first_name . $this->last_name ;
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232);
    }
}
