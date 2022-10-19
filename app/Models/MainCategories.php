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
}
