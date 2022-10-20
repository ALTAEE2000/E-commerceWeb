<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sail\Console\PublishCommand;

class Languages extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'abbr',
        'locale',
        'name',
        'direction',
        'active',
        'created_at',
        'updated_at'
    ];
    protected $table = 'languages';

    public function scopeSelection($query)
    {
        return $query->select('name', 'abbr', 'direction', 'active');
    }

    public function scopeActive($qurey)
    {
        return $qurey->where('active', 1);
    }

    // public function getActiveAttribute($val) //this will add for all data in the site global
    // {
    //     return   $val == 1 ? 'active' : 'not active';
    // }

    public function getActive()
    {
        return   $this->active == 1 ? 'active' : 'not active'; // this is will add gust when you  clalled it
    }
}
