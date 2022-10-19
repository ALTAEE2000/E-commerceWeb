<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\languagesReqeuest;
use App\Models\Languages;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\Language;

class LnaguagesController extends Controller
{
    public function index()
    {
        $languages = Languages::select()->paginate(PAGINATION_COUNT);

        return view('Dashboard.languages.index', compact('languages'));
    }

    public function create()
    {

        return view('Dashboard.languages.create');
    }

    public function store(languagesReqeuest $request)
    {
        // validation of reqyest
        // in request validation

        // insert to db

        try {
            $languages = Languages::create($request->except(['_token']));
            return redirect()->route('admin.languages.create')->with(['success' => 'this is success']);
        } catch (\Exception $e) {
            return redirect()->route('admin.languages.create')->with(['errors' => 'this is erroros']);
        }
    }

    public function edit($id)
    {

        $languages = Languages::find($id);
        if (!$languages) {
            redirect()->back();
        } else {
            return view('Dashboard.languages.edit', compact('languages'));
        }
    }
    public function update()
    {
    }
}
