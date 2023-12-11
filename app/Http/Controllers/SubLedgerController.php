<?php

namespace App\Http\Controllers;

use App\Models\SubLedger;
use Illuminate\Http\Request;

class SubLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => SubLedger::search()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $form = [
            "subledger_title" => '',
            "active" => '',
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
        $model = new SubLedger;
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $model = SubLedger::findOrFail($id);
        return response()->json(["data" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = SubLedger::findOrFail($id);
        return response()->json([
            "form" => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $model = SubLedger::findOrFail($id);
        $model->fill($request->all());
        $model->save();
        return response()->json(["saved" => true, "id" => $model->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $account = SubLedger::findOrFail($id);
        $account->deleted_by = Auth::id();
        $account->save();
        $account->delete();
        return response()
            ->json(['deleted' => true]);
    }

    public function bulk_active(Request $request){
        $id = $request->id;
        $item = SubLedger::findOrFail($id);
        $item->active = $request->data;
        $item->save();
    
        return response()->json(['message' => 'status updated successfully']);

    }
}
