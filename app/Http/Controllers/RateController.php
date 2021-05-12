<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;

class RateController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return Rate::with('hotel')->latest()->paginate(10);
    }

    public function get_hotels()
    {
        $collection = Hotel::get(['id', 'name']);
        foreach ($collection as $item) {
            $hotel[$item->id]  = $item->name;
        }
        return response()->json($hotel, 200);
    }
    public function store(Request $request)
    {


        $this->validate($request, [
            'date' => 'date',
            'adult_rate_per_night' => 'integer',
            'children_rate_per_night' => 'integer',
            'hotel_id' => 'required',
        ]);

        $rates = new Rate();
        $rates->from = $request->from;
        $rates->to = $request->to;
        $rates->adult_rate_per_night = $request->adult_rate_per_night;
        $rates->hotel_id = $request->hotel_id;
        $rates->children_rate_per_night = $request->children_rate_per_night;
        $rates->save();
    }


    public function update(Request $request, $id)
    {
        $rates = Rate::findOrFail($id);
        $this->validate($request, [
            'from' => 'date',
            'to' => 'date',
            'adult_rate_per_night' => 'integer',
            'children_rate_per_night' => 'integer',
            'hotel_id' => 'required',
        ]);
        $inputs = $request->all();
        $rates->update($inputs);
    }

    public function destroy($id)
    {
        $rates = Rate::findOrFail($id);
        $rates->delete();
    }

    public function search()
    {
        if ($search = request()->get('q')) {
            return Rate::with('hotel')->whereHas('hotel', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })->OrWhere('from', 'LIKE', "%$search%")
                ->orWhere('to', 'LIKE', "%$search%")
                ->orWhere('children_rate_per_night', 'LIKE', "%$search%")
                ->orWhere('adult_rate_per_night', 'LIKE', "%$search%")
                ->paginate(10);
        } else {
            return Rate::with('hotel')->latest()->paginate(10);
        }
    }
    // This method works when user filter for rates
    public function filter(Request $request)
    {
        return Rate::with('hotel')
            ->where('from', '>=', $request->from)->where('to', '<=', $request->to)
            ->latest()
            ->paginate(10);
    }
}
