<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequiest;
use App\Models\MainCategories;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index()
    {
        $vendors = Vendor::selection()->paginate(PAGINATION_COUNT);
        return view('Dashboard.vendors.index', compact('vendors'));
    }

    public function create()
    {
        $categories = MainCategories::where('translation_of', 0)->active()->get();
        return view('Dashboard.vendors.create', compact('categories'));
    }

    public function store(VendorRequiest $request)
    {
        try {


            if (!$request->has('active')) {
                $request->request->add(['active' => 0]);
            } else {
                $request->request->add(['active' => 1]);
            }

            $filePath = "";
            if ($request->has('logo')) {

                $filePath = uploadImage('vendors', $request->logo);
            }
            $vendor = Vendor::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'active' => $request->active,
                'address' => $request->address,
                'logo' => $filePath,
                // 'password' => $request->password,
                'category_id' => $request->category_id,
                // 'latitude' => $request->latitude,
                // 'longitude' => $request->longitude,
            ]);
            return redirect()->route('admin.vendors.create')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            return redirect()->back()->with(['errors' => 'you have some errors']);
        }
    }


    public function edit()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function changeStatus()
    {
    }
}
