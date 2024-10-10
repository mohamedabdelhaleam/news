<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageAttribute()
    {
        if ($this->attributes['image'] !== null) {
            return URL('storage/categories/images') . '/' . $this->attributes['image'];
        }
        return null;
    }
    public function articles()
    {
        return $this->hasMany(Article::class , 'category_id' , 'id');
    }
}
