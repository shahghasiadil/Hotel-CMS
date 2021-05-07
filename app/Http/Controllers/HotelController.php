<?php

namespace App\Http\Controllers;

use App\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        return Hotel::latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string',
            'stars' => 'required|integer',
            'address' => 'required|string'
        ]);

        Hotel::Create([
            'name' => $request->name,
            'stars' => $request->stars,
            'address' => $request->address
        ]);
    }

    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string',
            'stars' => 'required|integer',
            'address' => 'required|string'
        ]);

        $inputs = $request->all();
        $hotel->update($inputs);
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
    }

    public function search()
    {
        if ($search = request()->get('q')) {
            return Hotel::where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('stars', 'LIKE', "%$search%")
                    ->orWhere('address', 'LIKE', "%$search%");
            })->paginate(10);
        } else {
            return Hotel::latest()->paginate(10);
        }
    }
}
