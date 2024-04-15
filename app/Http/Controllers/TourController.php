<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TourController extends Controller
{
    public function index(Travel $travel, Request $request)
    {

        $request->validate([
            'priceto' => 'numeric',
            'pricefrom' => 'numeric',
            'datefrom' => 'date',
            'dateto' => 'date',
            'sortby' => Rule::in(['price']),
            'sortorder' => Rule::in(['asc', 'desc']),
        ]);
        $tours = $travel->tours()
            ->when($request->pricefrom, function ($query) use ($request) {
                $query->where('price', '>=', $request->pricefrom * 100);
            })
            ->when($request->priceto, function ($query) use ($request) {
                $query->where('price', '<=', $request->priceto * 100);
            })
            ->when($request->datefrom, function ($query) use ($request) {
                $query->where('starting_date', '<=', $request->datefrom);
            })
            ->when($request->dateto, function ($query) use ($request) {
                $query->where('starting_date', '<=', $request->dateto);
            })
            ->when($request->sortby && $request->sortorder, function ($query) use ($request) {
                if (! in_array($request->sortorder, ['asc', 'desc'])) {
                    return;
                }
                $query->orderby($request->sortby, $request->sortorder);
            })
            ->orderby('starting_date')->paginate();
        // ->orderby('starting_date')
        // ->get();
        return $tours;
    }

    public function store(Travel $travel, Request $request)
    {
        // return $request;
        $travel->tours()->create([
            'name' => $request->name,
            'starting_date' => $request->starting_date,
            'ending_date' => $request->ending_date,
            'price' => $request->price,
        ]);

        return $travel->tours;
    }

    public function update(Travel $travel, Request $request)
    {
        $travel->update([
            'is_public' => $request->is_public,
            'name' => $request->name,
            'description' => $request->description,
            'number_of_days' => $request->number_of_days,
        ]);

        return $travel;
    }



}
