<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountClass;
use App\Models\Account_group_class_type;

class AccountClassController extends Controller
{
    public function search()
    {
        $results = AccountClass::orderBy('id')
            ->when(request('q'), function ($query) {
                $query->where('classname', 'like', '%' . request('q') . '%');
            })->limit(6)->get();

        return response()->json(['results' => $results]);
    }

    public function create($id)
    {
        $form = [
            'code' => (AccountClass::select('code')->where('class_type_id', $id)->orderBy('code', 'desc')->value('code') != null ? AccountClass::select('code')->where('class_type_id', $id)->orderBy('code', 'desc')->value('code') + 1 : Account_group_class_type::findOrfail($id)->code . '001'),
            'classname' => null,
            'class_type_id' => null,
            'class_type' => null,
            'active' => 1,
        ];

        

        return response()->json(['form' => $form]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        // dd($request->class_type_id);
        $request->validate([
            'classname' => 'required|max:100',
            'class_type_id' => 'required|integer|exists:account_group_class_types,id',
        ]);

        $class = new AccountClass();
        $class->fill($request->all());
        $class->code = (AccountClass::select('code')->where('class_type_id', $request->class_type_id)->orderBy('code', 'desc')->value('code') != null ? AccountClass::select('code')->where('class_type_id', $request->class_type_id)->orderBy('code', 'desc')->value('code') + 1 : Account_group_class_type::findOrfail($request->class_type_id)->code . '001');
        $class->save();

        return response()->json(['saved' => true,  'id' => $class->id]);
    }

    public function edit($id)
    {
        // dd('abcd');
        return response()->json([
            'form' => AccountClass::with('class_type')->findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $class = AccountClass::findOrFail($id);

        $request->validate([
            'classname' => 'required|max:100',
            'class_type_id' => 'required|integer|exists:account_group_class_types,id',
        ]);

        $class->fill($request->all());
        $class->save();

        return response()->json([
            'saved' => true,
            'model' => $class,
            'id' => $class->id
        ]);
    }

    public function destroy($id)
    {
        $class = AccountClass::findOrFail($id);

        $class->delete();

        return response()
            ->json(['deleted' => true]);
    }
}
