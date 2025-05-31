<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Muestra el formulario de edición del perfil del usuario
    public function edit()
    {
        $user = auth()->user();
        return view('perfil.edit', compact('user'));
    }

    // Actualiza el perfil del usuario
 public function update(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'new_email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|max:2048'
        ], [
            'new_email.unique' => 'El correo electrónico ya está registrado.'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'No se pudo actualizar el perfil.')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Validación extra para el mismo correo (no cambiar)
        if ($request->new_email && $request->new_email === $user->email) {
            return back()->with('error', 'El correo electrónico ingresado es el mismo que el actual.')
                        ->withInput();
        }

        if ($request->new_email && $request->new_email !== $user->email) {
            $user->email = $request->new_email;
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('image')) {
            // Si el usuario tiene una imagen anterior y no es la de defecto
            if ($user->image && $user->image !== 'Imagenes/IconoDefaul.png') {
                // Eliminar imagen anterior
                Storage::disk('public')->delete($user->image);
            }

            // Guardar la nueva imagen
            $user->image = $request->file('image')->store('images', 'public');
        }

        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Perfil actualizado correctamente.');
    }
}