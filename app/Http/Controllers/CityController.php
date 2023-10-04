<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\City_Courier;
use Illuminate\Http\Request;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $results = City::when(request()->has('country_id') && \request('country_id'), function ($query) {
            $query->where('country_id', \request('country_id'));
        })->when(request('q', null), function ($query) {
            $query->where('name', 'like', '%' . request('q') . '%');
        })->paginate(10);
        return response()->json(['data' => $results]);
    }

    public function index()
    {
        return response()->json(['data' => City::with('couriers')
            ->when(\request()->has('country_id') && \request('country_id'), function ($q) {
            $q->where('country_id', \request('country_id'));
        })->when(\request()->has('city_id') && \request('city_id'), function ($q) {
            $q->where('id', \request('city_id'));
        })->when(request()->has('city') && request('city'), function ($q) {
            $q->where('name', 'like', '%' . request('city') . '%');
        })->search()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function storebulk(Request $request)
    {
        $cityIds = [];

        if ($request->city_id) {
            $cityIds = [$request->city_id];
        } elseif ($request->country_id) {
            $cityIds = City::where('country_id', $request->country_id)->pluck('id')->toArray();
        }

        if (!empty($cityIds)) {
            City_Courier::whereIn('city_id', $cityIds)->delete();

            $pivotData = [];

            if (isset($request->courier_id)) {
                $pivotData['courier_id'] = $request->courier_id;
            }
            if (isset($request->shipping_charges)) {
                $pivotData['delivery_charges'] = $request->shipping_charges;
            }

            foreach ($cityIds as $cityId) {
                $pivotData['city_id'] = $cityId;
                City_Courier::create($pivotData);
            }
        }

        return response()->json(['saved' => true]);
    }


//    public function storebulk(Request $request)
//    {
//        if ($request->city_id) {
//            $city = City::where('id', $request->city_id)->pluck('id');
//        } else {
//            $city = City::where('country_id', $request->country_id)->pluck('id');
//        }
//        foreach ($city as $city_id) {
//            $deleted = City_Courier::where('city_id', $city_id)->first();
//            if ($deleted) {
//                $deleted->delete();
//            }
//            $pivot = new City_Courier;
//            $pivot->city_id = $city_id;
//            if (isset($request->courier_id)) {
//                $pivot->courier_id = $request->courier_id;
//            }
//            if (isset($request->shipping_charges)) {
//                $pivot->delivery_charges = $request->shipping_charges;
//            }
//            $pivot->save();
//        }
//        return response()->json(['saved' => true]);
//    }
}
