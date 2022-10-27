<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'vendors';

    protected $fillable = [
        'id',
        'name',
        'mobile',
        'email',
        'address',
        'active',
        'category_id',
        'logo'
    ];

    protected $hidden = ['category_id'];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function getLogoAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : '';
    }

    public function scopeSelection($query)
    {
        return $query->select('id', 'name', 'logo', 'category_id', 'mobile');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\MainCategories', 'category_id', 'id');
    }

    public function getActive()
    {
        return $this->active == 1 ? 'is active' : 'not active';
    }
}
