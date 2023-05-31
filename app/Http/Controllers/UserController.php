<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return view('user.index',[
            'users' => User::all(),
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
        $attributes = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $role = $request->role;
        $user = User::create($attributes);
        $user->assignRole($role);
        session()->flash('success','User Added.....');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $role = $user->getRoleNames()[0];

        return compact('user','role');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $attributes = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
        ]);
        $user = User::find($id);
        $user->update($attributes);
        $user->syncRoles(request()->role);
        session()->flash('success','User Updated....');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = User::destroy($id);
        if ($delete == 1) {
            $success = true;
            $message = "Category deleted successfully";
        } else {
            $success = true;
            $message = "Category not found";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function stateUpdate(string $id)
    {
        $user = User::find($id);
        // dd($user);
        if(request()->state == 'true')
        {
            $user->givePermissionTo(request()->permission);
            session()->flash('success','Permission assigned...');
        }
        else
        {
            $user->revokePermissionTo(request()->permission);
            session()->flash('success','permission Removed...');
        }
    }
}
