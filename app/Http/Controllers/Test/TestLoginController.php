<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TestLoginController extends Controller
{
    public function testLogin(Request $request)
    {
        Log::info('TestLogin called', $request->all());
        
        $email = $request->input('email');
        $password = $request->input('password');
        
        Log::info('Attempting login', ['email' => $email]);
        
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            Log::info('Login successful');
            return response()->json(['success' => true, 'message' => 'Login successful']);
        } else {
            Log::warning('Login failed');
            return response()->json(['success' => false, 'message' => 'Login failed']);
        }
    }
}