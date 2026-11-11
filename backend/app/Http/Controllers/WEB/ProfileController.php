<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */$user = Auth::user();

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'no_hp'       => 'nullable|string|max:20',
            'alamat'      => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.mimes' => 'Format foto harus JPG, JPEG, atau PNG.',
            'foto_profil.max'   => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            $path =$request->file('foto_profil')->store('profiles', 'public');
            $user->foto_profil =$path;
        }

        $user->name   =$request->name;
        $user->email  =$request->email;
        $user->no_hp  =$request->no_hp;
        $user->alamat =$request->alamat;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}