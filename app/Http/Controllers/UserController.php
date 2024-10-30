<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{


    public function index(Request $request)
    {

        // for the search function
        $users = User::query()
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', "%$name%",);
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('pages.users.index', compact('users'));
    }


    public function create()
    {
        return view('pages.users.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required',
        ]);

        $data = ([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,

        ]);

        User::create($data);
        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',

        ]);

        $data = ([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,

        ]);

        // dont put the password there so its not required (it will just save hashed "nothing" cause we didnt put anything)

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }



}

