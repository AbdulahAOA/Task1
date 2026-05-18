<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'main_image',
    ];

    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }
    
}