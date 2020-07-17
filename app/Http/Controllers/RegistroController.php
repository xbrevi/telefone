<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function create() {
        return view('registro.create', [
            'topico' => 'Registrar-se',
        ]);
    }

    public function store(Request $request) {
        $data = $request->except('token');
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('form_listar_territorios');
    }



}
