<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

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
        return view('role.addrole');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
        ]);

        $role = Role::create($attributes);
        $role->syncPermissions($request->permission);
        session()->flash('success','Role Added....');
        return redirect('/role');
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
    public function edit($id)
    {
        $role = Role::findById($id);
        $rolePermission = $role->getAllPermissions();
        // dd($rolePermission);
        return view('role.edit',compact('role','rolePermission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $attributes = request()->validate([
            'name' => 'required|min:3',
        ]);
        $role = Role::findById($id);
        $role->update($attributes);
        $role->syncPermissions(request()->permission);
        session()->flash('success','Role Updated....');
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
