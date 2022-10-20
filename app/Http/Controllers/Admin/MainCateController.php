<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCateRequest;
use App\Models\MainCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class MainCateController extends Controller
{
    public function index()
    {
        $default_lang = get_defualt_lang();

        $mainCate = MainCategories::where('translation_lang', $default_lang)->selection()->get();

        return view('Dashboard.mainCate.index', compact('mainCate'));
    }

    public function create()
    {

        return view('Dashboard.mainCate.create');
    }

    public function store(MainCateRequest $request)
    {

        //return $request;

        $main_categories = collect($request->category);

        $filter = $main_categories->filter(function ($value, $key) {
            return $value['abbr'] == get_defualt_lang();
        });


        $categories = $main_categories->filter(function ($value, $key) {
            return $value['abbr'] != get_defualt_lang();
        });

        $default_category = array_values($filter->all())[0];

        $filePath = "";
        if ($request->has('photo')) {

            $filePath = uploadImage('maincategories', $request->photo);
        }

        return $default_category_id = MainCategories::insertGetId([
            'translation_lang' => $default_category['abbr'],
            'translation_of' => 0,
            'name' => $default_category['name'],
            'slug' => $default_category['name'],
            'photo' => $filePath
        ]);
    }
}
