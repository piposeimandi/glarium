<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\UserCity;
use App\Helpers\OtherHelper;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen.
    |
    */

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Try to get the user's capital city
            $capital = $user->capital;
            
            if ($capital && $capital->city_id) {
                return redirect('/game/city/' . $capital->city_id);
            }
            
            // If no capital city, create one using OtherHelper
            try {
                $cityId = OtherHelper::newPlayer($user);
                return redirect('/game/city/' . $cityId)->with('message', '¡Bienvenido! Tu ciudad ha sido creada.');
            } catch (\Exception $e) {
                // If city creation fails, redirect to home with error
                return redirect('/')->with('error', 'Error al crear tu ciudad. Contacta al administrador.');
            }
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->withInput($request->only('email'));
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
}
