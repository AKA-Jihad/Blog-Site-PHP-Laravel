<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Spatie\Permission\Contracts\Permission;
use App\Models\Permission as AppModelsPermission;
use Spatie\Permission\Models\Permission as ModelsPermission;

class RolePermissionController extends Controller
{
    
    public function index(){
        $roles = Role::whereNotIn('name',['admin'])->get();
        return view('role.index', compact('roles'));
    }
    public function create(){
        $permissions = ModelsPermission::orderBy('id', 'desc')->get(['id', 'name']);
        return view('role.create', compact('permissions'));
    }
    
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        $role->givePermissionTo($request->permission);

        return back()->with('success', "Role add succesful!");
    }

    //optional
    public function storePermission(Request $request){
        $request->validate([
            'name'=>'required',
        ]);

        ModelsPermission::create([
            'name' => $request->name
        ]);

        return back()->with('success', "Permission add succesful!");
    }
    
}
