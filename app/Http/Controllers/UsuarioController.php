<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function usuario(Request $request)
    {
        $user = $request->user();

        return ['status' => true, "usuario" => $user];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function cadastrar(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validacao->fails()) {
            return ['status' => false, 'validacao' => true, "erros" => $validacao->errors()];
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->token = $user->createToken($user->email)->accessToken;

        return ['status' => true, "usuario" => $user];
    }

    /**
     * @param Request $request
     * @return array|false[]
     */
    public function login(Request $request)
    {
        $data = $request->all();

        $validacao = Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if ($validacao->fails()) {
            return ['status' => false, 'validacao' => true, "erros" => $validacao->errors()];
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = auth()->user();

            $user->token = $user->createToken($user->email)->accessToken;
            return ['status' => true, "usuario" => $user];

        } else {
            return ['status' => false];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
