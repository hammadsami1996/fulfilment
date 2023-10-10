<?php

namespace App\Http\Controllers;

use App\Models\AttributeGroup;
use Illuminate\Http\Request;

class AttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AttributeGroup::paginate(request('per_page') ? request('per_page') : 25);
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form= [
            'title'=> null,
            'sets'=> null,
            'show_filter'=> null,
            'show_on_front'=> null,
            'sort'=> null,
            'status'=> null,
            'active'=> null,
        ];

        return response()
            ->json(['form' => $form]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = new AttributeGroup();
        $model->fill($request->all());
        $model->sets = 0;
        $model->sort = 0;
        $model->active = 1;
        $model->save();
        return response()->json(['saved' => true,'id'=> $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AttributeGroup $attributeGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $form = AttributeGroup::findOrFail($id);
        return response()
            ->json(['form' => $form ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = AttributeGroup::findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return response()
            ->json(['saved' => true,'id'=> $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        AttributeGroup::destroy($id);
        return response()
            ->json(['deleted'=>true]);
    }
}
