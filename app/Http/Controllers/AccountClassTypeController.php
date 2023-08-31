<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Account_group_class_type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AccountClassTypeController extends Controller
{
    public function index(Request $request)
    {
        // dd('abcd');
       
        $datearry = null;
       
            $st_date = date('Y-m-d', strtotime(now()));
            $end_date = date('Y-m-d', strtotime(now()));
            //date("d-m-Y", strtotime($orgDate));
            $datearry = array($st_date, $end_date);

            // dd($datearry);
   

        // DB::statement('call calculate_account_balance(?,?)', $datearry);
        return response()->json([
            'results' => Account_group_class_type::with(['classes.groups.accounts'])->search(),
            'data' => Account_group_class_type::with(['classes.groups.accounts'])->search(),
            'user' => User::find(Auth::id()) // with('account_period')
        ]);

    }


    public
    function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'class_type' => 'required|max:100',
            'main_class' => 'required|max:100',
        ]);

        $class_type = new Account_group_class_type();
        $class_type->fill($request->all());
        $class_type->code = (Account_group_class_type::select('code')->orderBy('code', 'desc')->value('code') + 1);
        $class_type->save();

        return response()->json(['saved' => true,  'id' => $class_type->id]);
    }


    public
    function edit($id)
    {
        return response()->json([
            'form' => Account_group_class_type::findOrFail($id)
        ]);
    }

    public
    function update(Request $request, $id)
    {
        $class_type = Account_group_class_type::findOrFail($id);

        $request->validate([
            'class_type' => 'required|max:100',
            'main_class' => 'required|max:100',
        ]);

        $class_type->fill($request->all());
        $class_type->save();

        return response()->json([
            'saved' => true,
            'model' => $class_type,
            'id' => $class_type->id
        ]);
    }


    public function destroy($id)
    {
        $class = Account_group_class_type::findOrFail($id);

        $class->delete();

        return response()
            ->json(['deleted' => true]);
    }
}
