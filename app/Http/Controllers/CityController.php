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
//    public function storebulk(Request $request)
//    {
//        $cityIds = [];
//
//        if ($request->city_id) {
//            $cityIds = [$request->city_id];
//        } elseif ($request->country_id) {
//            $cityIds = City::where('country_id', $request->country_id)->pluck('id')->toArray();
//        }
//
//        if (!empty($cityIds)) {
//            City_Courier::whereIn('city_id', $cityIds)->delete();
//
//            $pivotData = [];
//
//            if (isset($request->courier_id)) {
//                $pivotData['courier_id'] = $request->courier_id;
//            }
//            if (isset($request->shipping_charges)) {
//                $pivotData['delivery_charges'] = $request->shipping_charges;
//            }
//
//            foreach ($cityIds as $cityId) {
//                $pivotData['city_id'] = $cityId;
//                City_Courier::create($pivotData);
//            }
//        }
//
//        return response()->json(['saved' => true]);
//    }
    public function storebulk(Request $request)
    {
        if (!$request->city_id && !$request->country_id) {
            return response()->json(['saved' => false, 'message' => 'Both city_id and country_id are missing.']);
        }
        $excludeCondition = $request->has('exclude') && $request->exclude == 1 && ($request->city_id || $request->country_id);
        $includeCondition = (!$request->has('exclude') || $request->exclude == 0) && ($request->city_id || $request->country_id);
        if ($excludeCondition) {
            $cityIds = City::where('country_id', $request->country_id)->whereNotIn('id',[$request->city_id])->pluck('id')->toArray();
        }elseif ($includeCondition) {
            $cityIds = City::where('country_id', $request->country_id)->whereIn('id',[$request->city_id])->pluck('id')->toArray();
        } elseif ($request->city_id) {
            $cityIds = [$request->city_id];
        } else {
            $cityIds = City::where('country_id', $request->country_id)->pluck('id')->toArray();
        }
        $cityIds = array_merge([$request->city_id], $cityIds);
        if (!empty($cityIds)) {
            $pivotData = [
                'courier_id' => $request->courier_id ?? null,
                'delivery_charges' => $request->shipping_charges ?? 0,
            ];

            City_Courier::whereIn('city_id', $cityIds)->delete();

            $insertData = array_map(function ($cityId) use ($pivotData) {
                return array_merge(['city_id' => $cityId], $pivotData);
            }, $cityIds);

            City_Courier::insert($insertData);
        }

        return response()->json(['saved' => true]);
    }
}
