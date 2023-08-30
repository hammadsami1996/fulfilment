<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account_group;
use App\Models\AccountClass;

class AccountGroupController extends Controller
{
    public function search()
    {
        $results = Account_group::orderBy('id')
            ->when(request('q'), function ($query) {
                $query->where('groupname', 'like', '%' . request('q') . '%');
            })->get();

        return response()->json(['results' => $results]);
    }

    public function create($id)
    {
        $form = [
            'code' => (Account_group::select('code')->where('class_id', $id)->orderBy('code', 'desc')->value('code') != null ? Account_group::select('code')->where('class_id', $id)->orderBy('code', 'desc')->value('code') + 1 : AccountClass::findOrfail($id)->code . '001'),
            'groupname' => null,
            'class_id' => null,
            'classes' => null,
            'active' => 1,
        ];

        if ($id == 0) {
            return response()->json(['form' => $form]);
        }

      

        return response()->json(['form' => $form]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'groupname' => 'required|max:100',
            'class_id' => 'required|integer|exists:account_group_classes,id',
        ]);

        $group = new Account_group();
        $group->fill($request->all());
        $group->code = (Account_group::select('code')->where('class_id', $request->class_id)->orderBy('code', 'desc')->value('code') != null ? Account_group::select('code')->where('class_id', $request->class_id)->orderBy('code', 'desc')->value('code') + 1 : AccountClass::findOrfail($request->class_id)->code . '001');
        $group->save();

        return response()->json(['saved' => true, 'model' => $group, 'id' => $group->id]);
    }

    public function edit($id)
    {
        return api([
            'form' => Account_group::with('classes')->findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $group = Account_group::findOrFail($id);

        $request->validate([
            'groupname' => 'required|max:100',
            'class_id' => 'required|integer|exists:account_group_classes,id',
        ]);

        $group->fill($request->all());
        $group->save();

        return api([
            'saved' => true,
            'model' => $group,
            'id' => $group->id
        ]);
    }

    public function destroy($id)
    {
        $group = Account_group::findOrFail($id);

        $group->delete();

        return response()
            ->json(['deleted' => true]);
    }
}
