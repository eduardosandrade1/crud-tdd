<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
                Log::alert('Não logou no test');
                Log::alert($request->all());
                return redirect()->back();
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
}
