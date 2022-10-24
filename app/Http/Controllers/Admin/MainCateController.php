<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCateRequest;
use App\Models\MainCategories;
use DeepCopy\Filter\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

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


        try {
            //return $request;

            $main_categories = collect($request->category);

            $filter = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] == get_defualt_lang();
            });

            $default_category = array_values($filter->all())[0];


            $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('maincategories', $request->photo);
            }

            DB::beginTransaction();

            $default_category_id = MainCategories::insertGetId([
                'translation_lang' => $default_category['abbr'],
                'translation_of' => 0,
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $filePath
            ]);

            $categories = $main_categories->filter(function ($value, $key) {
                return $value['abbr'] != get_defualt_lang();
            });


            if (isset($categories) && $categories->count()) {

                $categories_arr = [];
                foreach ($categories as $category) {
                    $categories_arr[] = [
                        'translation_lang' => $category['abbr'],
                        'translation_of' => $default_category_id,
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $filePath
                    ];
                }

                MainCategories::insert($categories_arr);
            }

            DB::commit();

            return redirect()->route('admin.mainCategories')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.mainCategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($mainCategory)
    {
        $mainCategory = MainCategories::selection()->find($mainCategory);
        if (!$mainCategory) {
            return redirect()->route('admin.mainCategories')->with(['errors' => 'this is not have this section']);
        }
        return view('Dashboard.mainCate.edit', compact('mainCategory'));
    }

    public function update($mainCategory_id, MainCateRequest $request)
    {
        //validtion



        //find main id
        $mainCategory = MainCategories::find($mainCategory_id);

        $category = array_values($request->category)[0];
        if (!$mainCategory) {
            return redirect()->route('admin.mainCategories')->with(['errors' => 'this is not have this section']);
        }

        MainCategories::where('id', $mainCategory_id)->update([
            'name' => $category['name'],
        ]);
        return redirect()->back()->with(['success' => 'this is updated']);


        //update
        // MainCategories::where('id', $mainca)->find($maincat_id);
    }
}
