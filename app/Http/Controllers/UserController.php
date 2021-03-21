<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller {
  public function __construct() {
    $this->middleware(['permission:access users'])->only('index');
    $this->middleware(['permission:show users'])->only('show');
    $this->middleware(['permission:create users'])->only('create', 'store');
    $this->middleware(['permission:edit users'])->only('edit', 'update');
    $this->middleware(['permission:delete users'])->only('destory');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $users = User::where('id', '!=', 1)->latest()->paginate(5);
    return view('users.index', ['users' => $users]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $roles = Role::all()->except(1);
    return view('users.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'role' => 'required',
    ]);
    $rand = Str::random(20);
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($rand),
    ]);
    $user->assignRole($request->role);

    // dd(compact('rand', 'user'));

    return redirect()->route('users.show', $user)->with('success', 'User created successfully!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $user) {
    return view('users.show', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user) {
    $roles = Role::all()->except(1);
    return view('users.edit', compact('user', 'roles'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user) {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'password' => 'nullable|min:8',
      'role' => 'required',
    ]);
    $user->update([
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password ? Hash::make($request->password) : $user->password,
    ]);
    $user->syncRoles($request->role);

    return redirect()->route('users.show', $user)->with('success', 'User updated successfully!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user) {
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully!');
  }
}
