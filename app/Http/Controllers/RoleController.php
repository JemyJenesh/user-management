<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller {
  public function __construct() {
    $this->middleware(['permission:access roles'])->only('index');
    $this->middleware(['permission:show roles'])->only('show');
    $this->middleware(['permission:create roles'])->only('create', 'store');
    $this->middleware(['permission:edit roles'])->only('edit', 'update');
    $this->middleware(['permission:delete roles'])->only('destory');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $roles = Role::where('id', '!=', 1)->get();
    $permissionsCount = Permission::all()->count();
    return view('roles.index', compact('roles', 'permissionsCount'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('roles.create', [
      'permissions' => Permission::all(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $request->validate([
      'name' => 'required|unique:roles,name',
      'permissions' => "required",
    ], [
      'name.unique' => 'The role already exist!',
      'permissions.required' => 'Select atleast one permission!',
    ]);

    $role = Role::create([
      'name' => $request->name,
    ]);

    $role->syncPermissions($request->permissions);

    return redirect()->route('roles.show', $role)->with('success', 'Role created successfully!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function show(Role $role) {
    $permissions = Permission::paginate(5);
    return view('roles.show', compact('role', 'permissions'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function edit(Role $role) {
    $permissions = Permission::all();
    return view('roles.edit', compact('role', 'permissions'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Role $role) {
    $request->validate([
      'name' => 'required|unique:roles,name,' . $role->id,
      'permissions' => "required",
    ], [
      'name.unique' => 'The role already exist!',
      'permissions.required' => 'Select atleast one permission!',
    ]);

    $role->update([
      'name' => $request->name,
    ]);

    $role->syncPermissions($request->permissions);

    return redirect()->route('roles.show', $role)->with('success', 'Role updated successfully!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function destroy(Role $role) {
    if ($role->users()->count() > 0) {
      return redirect()->route('roles.index')->with('error', 'Some users are attached to this role!');
    }
    $role->delete();

    return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
  }
}
