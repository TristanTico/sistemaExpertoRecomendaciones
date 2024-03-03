<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
       $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('Home'));
        } else {
            return redirect()->route('login')->withErrors(['email' => 'Credenciales no válidas']);
        }
    }
    
    /**
     * Destroy an authenticated session.
     */
  
     public function destroy(Request $request)
     {
         Auth::logout();
 
         $request->session()->invalidate();
 
         $request->session()->regenerateToken();
 
         return redirect()->route('login');
     }
}
