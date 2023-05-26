<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('role.index',[
            'roles' => Role::all()
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
            'name' => 'required',
        ]);
        // dd($request->permission);
        $role = Role::create($attributes);
        $role->syncPermissions($request->permission);
        session()->flash('success','Role Added....');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $users = User::role($role)->get();
        foreach($users as $user)
        {
        $user->assignRole('visitor');
        }
        $delete = $role->delete();
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
    public function stateUpdate($id)
    {
        $role = Role::find($id);
        // dd($user);
        if(request()->state == 'true')
        {
            $role->givePermissionTo(request()->permission);
            session()->flash('success','Permission assigned...');
        }
        else
        {
            $role->revokePermissionTo(request()->permission);
            session()->flash('success','permission Removed...');
        }
    }
}
