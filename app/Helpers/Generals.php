<?php

use App\Models\Languages;
use Illuminate\Support\Facades\Config;

function  showName()
{
    return 'ali mohammed';
}

function get_languages()
{
    return  Languages::active()->selection()->get();
}
function get_defualt_lang()
{
    return Config::get('app.locale');
}
