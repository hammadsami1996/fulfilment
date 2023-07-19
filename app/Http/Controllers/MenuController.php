<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissionsData = collect(auth()->user()->getAllPermissions());
        $permissions = $permissionsData->pluck('name');

        $result = Menu::with('children')
//            ->where('guard', auth()->user()->getGuarded())
//            ->where(function ($q) use ($permissions) {
//                $q->whereIn('route', $permissions)
//                    ->orWhere('route', '=', null);
//            })
            ->whereNull('head_id')->orderBy('sort')->get();
//        $result = Menu::with('children')->whereNull('head_id')->orderBy('sort')->get();

        return response()->json([
            'data' => $result
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
