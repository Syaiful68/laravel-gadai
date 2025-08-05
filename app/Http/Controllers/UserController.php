<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->search) {
            $data = User::query()->whereAny([
                'user',
                'nama'
            ], 'like', '%' . $request->search . '%');
        } else {
            $data = User::query();
        }

        return Inertia::render('User/index', [
            'data' => $data->paginate(10)
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
        //
        $request->validate([
            'nik' => 'required|unique:users,nik',
            'nama' => 'required',
            'user' => 'required|unique:users,user',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6',
        ]);

        User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'user' => $request->user,
            'password' => Hash::make($request->password),
        ]);
        return to_route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $query = User::query()->where('user', $id)->first();
        return Inertia::render('User/detail', [
            'data' => $query
        ]);
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
        if ($request->password !== null) {
            User::query()->where('user', $id)->update([
                'roles' => $request->role,
                'password' => $request->password
            ]);
        }
        User::query()->where('user', $id)->update([
            'roles' => $request->role
        ]);

        return to_route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
