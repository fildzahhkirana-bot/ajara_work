<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show() { return view('profile.show'); }
    public function edit() { return view('profile.edit'); }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'nim' => ['required', 'string', 'max:30', 'unique:users,nim,'.auth()->id()],
            'email' => ['required', 'email', 'max:150', 'unique:users,email,'.auth()->id()],
        ]);
        auth()->user()->update($data);
        return redirect()->route('profile.show')->with('success', 'Data akun berhasil diperbarui.');
    }
}
