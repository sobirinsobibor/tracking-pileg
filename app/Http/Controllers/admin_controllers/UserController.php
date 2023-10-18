<?php

namespace App\Http\Controllers\admin_controllers;

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

        return view('templating.admin-view.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $user_exist = User::where('nik', '=', $id)->exists();
            if(!$user_exist){
                return redirect('/dashboard/admin/user')->with('message', ['text' =>'User Tidak Ditemukan', 'class' => 'danger']);
            }
            $user = User::select([
                'name',
                'email',
                'nik',
                'telephone',
                'address',
                'roles.role_name'
            ])->join('roles', 'users.id_role', '=', 'roles.id')
              ->where('nik', '=', $id)->first();
       
            return view('templating.admin-view.user.detail', [
                'user' => $user
            ]);
    
        }catch(\Exception $e){
            return redirect('/dashboard/admin/user')->with('message', ['text' => $e->getMessage(), 'class' => 'danger']);
        }

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
