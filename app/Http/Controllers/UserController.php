<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::paginate(10)->withQueryString();
        return view('pages.users.index', [
            'title' => 'User Data',
            'users' => $users
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
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email|min:5'
        ],[
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal harus 3 huruf',
            'email.required' => 'Email harus diisi',
            'email.min' => 'Email minimal harus 5 huruf',
            'email.unique' => 'Email sudah digunakan'
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'email_verified_at' => now(),
            'password' => strtolower(str_replace(' ', '', $request->input('name'))),
            'profile' => 'https://api.dicebear.com/9.x/initials/svg?seed=' . urlencode($request->input('name')),
            'role' => 'user'
        ];

        User::create($data);
        return redirect()->route('users')->with('successAdd','Berhasil simpan data');
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
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:5'
        ],[
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal harus 3 huruf',
            'email.required' => 'Email harus diisi',
            'email.min' => 'Email minimal harus 5 huruf',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'email_verified_at' => now(),
            'password' => strtolower(str_replace(' ', '', $request->input('name'))),
            'profile' => 'https://api.dicebear.com/9.x/initials/svg?seed=' . urlencode($request->input('name')),
            'role' => 'user'
        ];

        User::where('id', $id)->update($data);
        return redirect()->route('users')->with('successUpdate','Berhasil update data');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        User::where('id', $id)->delete($id);
        return redirect()->route('users')->with('successDelete', 'Berhasil menghapus data');
    }

    public function search(Request $request){
        $search = $request->input('search');
        $users = User::where('name', 'like', '%' . $search . '%')->paginate(10)->withQueryString();

        return view('users', [
            'title' => 'User Data',
            'users' => $users
        ]);
    }
}