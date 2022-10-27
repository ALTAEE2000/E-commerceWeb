<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategories extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'translation_lang',
        'translation_of',
        'name',
        'slug',
        'active',
        'photo',
        'created_at',
        'updated_at'
    ];
    protected $table = 'main_categories';

    public function scopeActive($qurey)
    {
        return $qurey->where('active', 1);
    }
    public function getActive()
    {
        return $this->active == 1 ? 'is active' : 'not active';
    }

    public function scopeSelection($query)
    {
        return $query->select('id', 'translation_of',  'translation_lang', 'name', 'slug', 'photo', 'active');
    }


    public function getPhotoAttribute($val)
    {
        return  $val !== null ? $val : '';
    }

    public function categories()
    {
        return  $this->hasMany(self::class, 'translation_of');
    }
    public function vendors()
    {
        return $this->hasMany('App\Models\Vendors', 'category_id');
    }
}
