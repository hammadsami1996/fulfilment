<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Company::with( 'country', 'city','stores')->search()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "name" => '',
            "phone" => '',
            "tax_number" => '',
            "city_id" => '',
            "country_id" => '',
            "postal" => '',
            "province" => '',
            "address" => '',
            "logo" => '',
            "email" => '',
        ];
        return response()->json([
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $model = new Company();
        $model->fill($request->except('imgN'));
        if ($request->hasFile('imgN')) {
            $file = $request->file('imgN');
            $extension = $file[0]->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file[0]->move('uploads/company/logo', $filename);
            $model->logo = $filename;
        }
//        dd($model);
        $model->save();

//        foreach ($request->product_img as $key => $item) {




//        }
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Company::with('stores')->findOrFail($id);
        // dd($model);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Company::with( 'country', 'city')->findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:25',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $model = Company::findOrFail($id);
        $model->fill($request->except('imgN'));
        if ($request->hasFile('imgN')) {
            $file = $request->file('imgN');
            $extension = $file[0]->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file[0]->move('uploads/company/logo', $filename);
            $model->logo = $filename;
        }
//        $model->updated_by = Auth::id();
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Company::findOrFail($id);
       $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }
}
