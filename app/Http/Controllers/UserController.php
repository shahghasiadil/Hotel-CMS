<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin.users');
    }

    public function get_users()
    {
        return User::with('role')->latest()->paginate(10);
    }

    public function get_roles()
    {
        $collection = Role::get(['name', 'id']);
        foreach ($collection as $item) {
            $roles[$item->id]  = $item->name;
        }
        return response()->json($roles, 200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'user_name'  => 'required|string|max:255',
            'role_id' => 'required',
            'password' => ['required'],
            'confirm_password' => ['same:password'],
        ]);

        User::create([
            'user_name' => $request['user_name'],
            'role_id' => $request['role_id'],
            'status' => 1,
            'password' => bcrypt($request['password']),
        ]);
        //

        return response()->json("User Has been created!!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'user_name'  => 'required|string|max:255',
            'role_id' => 'required',
            'confirm_password' => ['same:password'],
        ]);

        if ($request['password']) {
            $user->update([
                'user_name' => $request['user_name'],
                'role_id' => $request['role_id'],
                'password' => bcrypt($request['password']),
            ]);
            return response()->json("User Has been updated!!!");
        } else {
            $user->update([
                'user_name' => $request['user_name'],
                'role_id' => $request['role_id'],
                'status' => $request['status'],
            ]);
            return response()->json("User Has been updated!!!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json("User Has been Deleted");
    }

    // public function search_users()
    // {
    //     if ($search = request()->get('q')) {
    //         return  User::with('role')->whereHas('role', function ($query) use ($search) {
    //             $query->where('name', 'LIKE', "%$search%");
    //         })
    //             ->Orwhere('user_name', 'LIKE', "%$search%")
    //             ->paginate(10);
    //     } else {
    //         return User::with('role')->latest()->paginate(10);
    //     }
    // }
}
