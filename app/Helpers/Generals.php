<?php

use App\Models\Languages;
use Illuminate\Support\Facades\Config;

function  showName()
{
    return 'ali mohammed';
}

// get lang of languages table of db
function get_languages()
{
    return  Languages::active()->selection()->get();
}

// native lang of web
function get_defualt_lang()
{
    return Config::get('app.locale');
}

//save images
function uploadImage($folder, $image)
{
    $image->store('/',  $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}
