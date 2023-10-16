<?php

namespace App\Http\Controllers\super_admin_controllers;

use Rules\Password;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select([
            'name',
            'email',
            'nik',
            'telephone',
            'address',
            'email',

            'roles.role_name'
        ])->join('roles', 'users.id_role', '=', 'roles.id')
          ->get();

        return view('templating.super-admin-view.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::select([
            'id',
            'role_name'
        ])->get();


        return view('templating.super-admin-view.user.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'nik' => ['required', 'numeric', 'digits:16', 'unique:'.User::class],
                'telephone' => ['required', 'string', 'unique:'.User::class],
                'address' => ['required', 'string', 'max:255'],
                'id_role' => ['required'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nik' => $request->nik,
                'id_role' => $request->id_role,
                'telephone' => $request->telephone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));
            return redirect('/dashboard/superadmin/user')->with('message', ['text' => 'Data Successfully Added', 'class' => 'success']);

        }catch(\Exception $e){
            return redirect('/dashboard/superadmin/user')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }



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
    public function destroy(string $id)
    {
        //
    }
}
