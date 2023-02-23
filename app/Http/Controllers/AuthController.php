<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{


    public function create()
    {
        return view('login');
    }


    public function store(Request $request)
    {
        try {

            $attempt = auth()->attempt([
                'email' => $request->post('email'),
                'password' => $request->post('password'),
            ]);

            if ( !$attempt ) {
                return redirect()->route('login.create');
            }

            return redirect()->route('home');

        } catch (Exception $e) {
            Log::alert($e->getMessage(). " " . $e->getLine());
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('login.create');

    }
}
