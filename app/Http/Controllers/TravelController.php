<?php

namespace App\Http\Controllers;

use App\Http\Resources\Travelrecource;
use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function index()
    {
        $travels = Travel::where('is_public', true)->paginate();

        return Travelrecource::collection($travels);
    }

    public function store(Request $request)
    {

        //     $travel=Travel::create( [
        //         'is_public'=>$request->is_public,
        //         'name'=>$request->name,
        //         'description'=>$request->description,
        //         'number_of_days'=>$request->number_of_days
        // ]);

        return $request->toArray();

    }
}
