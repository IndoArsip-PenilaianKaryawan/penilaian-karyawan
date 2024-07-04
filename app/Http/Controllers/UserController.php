<?php

namespace App\Http\Controllers;

use App\Models\M_users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = M_users::all();

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:m_users',
            'password' => 'required',
            'name' => 'required',
        ]);

        $username = $request->input('username');
        $password = Hash::make($request->input('password'));
        $name = $request->input('name');


        M_users::addUser([
            'username' => $username,
            'password' => $password,
            'name' => $name,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $user = M_users::editUser($id);
        $view_data = [
            'user' => $user
        ];

        return view ('users.edit', $view_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:m_users,username,' . $id,
            'password' => 'sometimes',
            'name' => 'required',
        ]);

        $username = $request->input('username');
        $name = $request->input('name');

        $updateData = [
            'username' => $username,
            'name' => $name,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->input('password'));
        }

        M_users::updateUser($updateData, $id);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Hapus semua referensi di tabel m_karyawan
        DB::table('m_karyawan')->where('id_approval_1', $id)->orWhere('id_approval_2', $id)->orWhere('id_atasan', $id)->delete();

        // Hapus user dari tabel m_users
        M_users::deleteUser($id);

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

}
