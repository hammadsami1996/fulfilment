<?php

namespace App\Http\Controllers;

use App\Models\AssignSet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignSetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AssignSet::paginate(request('per_page') ? request('per_page') : 25);
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form= [
            'group_title' => null,
            'sets' => null,
            'groups' => null,
            'active' => null,
            'deleted' => null,
            'active' => null,
            'edit_by' => null,
            'add_by'=> null,
        ];

        return response()
            ->json(['form' => $form]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = new AssignSet();
        $model->fill($request->all());
        $model->group_title  = $request->attribute_groups['title'];
        $model->edit_by  = Auth::user()->id;
        $model->active  = 1;
        $model->deleted =1;
        $model->add_by = Carbon::now();
        $model->save();
        return response()->json(['saved' => true,'id'=> $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignSet $assignSet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $form = AssignSet::with('attribute_sets','attribute_groups')->findOrFail($id);
        return response()
            ->json(['form' => $form ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = AssignSet::findOrFail($id);
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
        AssignSet::destroy($id);
        return response()
            ->json(['deleted'=>true]);

    }
}
