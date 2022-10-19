<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        return view('Dashboard.languages.create');
    }
    /*
    // public function store(languagesReqeuest $request)
    {
        // validation of reqyest
        // in request validation

        // insert to db

        try {
            // $languages = Languages::create($request->except(['_token']));
            return redirect()->route('admin.languages.create')->with(['success' => 'this is success']);
        } catch (\Exception $e) {
            return redirect()->route('admin.languages.create')->with(['errors' => 'this is erroros']);
        }
    }

    public function edit($id)
    {

        $languages = Languages::find($id);
        if (!$languages) {
            return  redirect()->back();
        } else {
            return view('Dashboard.languages.edit', compact('languages'));
        }
    }
    public function update($id, languagesReqeuest $request)
    {


        try {
            $languages = Languages::find($id);
            if (!$languages) {
                return redirect()->route('admin.languages.edit', $id);
            }
            $languages->update($request->except('_token'));
            return redirect()->route('admin.languages')->with(['success' => 'succrss to udapte data ']);
        } catch (Exception $e) {
            return redirect()->route('admin.languages.edit', $id);
        }
    }
    public function delete($id)
    {
        $languages = Languages::find($id)->delete();
        return redirect()->route('admin.languages')->with(['success' => 'success to update data']);
    }
    */
}
