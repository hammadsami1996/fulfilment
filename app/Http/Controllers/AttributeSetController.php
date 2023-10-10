<?php

namespace App\Http\Controllers;

use App\Models\AttributeSet;
use Illuminate\Http\Request;

class AttributeSetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AttributeSet::paginate(request('per_page') ? request('per_page') : 25);
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form= [
            'title' => null,
        ];

        return response()
            ->json(['form' => $form]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = new AttributeSet();
        $model->fill($request->all());
        $model->save();
        return response()->json(['saved' => true, 'id' => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $form = AttributeSet::findOrFail($id);
        return response()
            ->json(['form' => $form ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = AttributeSet::findOrFail($id);
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
        AttributeSet::destroy($id);
        return response()
            ->json(['deleted'=>true]);
    }
}
