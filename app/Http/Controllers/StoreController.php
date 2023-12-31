<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => Store::with('company' , 'warehouse')->when(\request()->has("fatch_order"),function ($q) {
            $q->where('fetch_order', \request('fatch_order'));
        })->search()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $form = [
            "name" => '',
            "location" => '',
            "company_id" => '',
            "store_type" => '',
            "access_token" => '',
            "plate_form" => '',
            "store_address" => '',
            "api_key" => '',
            "api_secret" => '',
            "word_address" => '',
            "mim_api_key" => '',
            "img" => '',
            "mim_store_address" => '',
            "fetch_order" => 0,

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
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:25',
            'location' => 'required|max:25',
            'company_id' => 'required',
            'store_type' => 'required',
        ]);
        $model = new Store();
        $model->fill($request->except('imgN'));
        if ($request->hasFile('imgN')) {
            $file = $request->file('imgN');
            $extension = $file[0]->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file[0]->move('uploads/store/img', $filename);
            $model->img = $filename;
        }
        // $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Store::with('company')->findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Store::with('company' ,'warehouse')->findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:25',
            'location' => 'required|max:25',
            'company_id' => 'required',
        ]);
//        dd($request);
        $model = Store::with('company')->findOrFail($id);
        $model->fill($request->except('imgN'));
        if ($request->hasFile('imgN')) {
            $file = $request->file('imgN');
            $extension = $file[0]->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file[0]->move('uploads/store/img', $filename);
            $model->img = $filename;
        }
        // $model->fill($request->all());
//        $model->updated_by = Auth::id();
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Store::with('company')->findOrFail($id);
       $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }


    public function stores_data()
    {
        // dd(request('company_id'));
        return response()->json(['data' => Store::where('company_id' , request('company_id'))->where('store_type', 'Online')->search()]);
    }

}
