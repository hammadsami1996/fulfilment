<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BrandController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Brand::search()]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "title" => '',
            "active" => '',
            "status" => '',
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
            'title' => 'required|max:25',
        ]);
        $model = new Brand();
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = Brand::findOrFail($id);
        return response()->json(["data" => $model]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Brand::findOrFail($id);
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
            'title' => 'required|max:25',
        ]);
        $model = Brand::findOrFail($id);
        $model->fill($request->all());
//        $model->updated_by = Auth::id();
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Brand::findOrFail($id);
       $model->deleted_by = Auth::id();
        $model->save();
        $model->delete();
        return response()->json(["deleted" => true]);
    }


}
