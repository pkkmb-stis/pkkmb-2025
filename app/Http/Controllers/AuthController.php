<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
    
        $credentials['password'] = md5($request->post('password'));
    
        $remember = $request->post('remember') ? true : false;
    
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $nama = auth()->user()->name;
    
            $request->session()->flash('success', 'Halo ' . $nama . '. Selamat Datang!');
            $request->session()->flash('afterLogin', true);
            
            if(auth()->user()->is_maba){
                return redirect()->intended('dashboard')->with('openAnnouncementModal', true);
            }
            return redirect()->intended('dashboard');
        }
    
        return back()->withErrors([
            'username' => 'No Ujian dan passwordmu tidak cocok',
        ]);
    }    

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $request->session()->flash('success', 'Logout berhasil sampai jumpa!');
        return redirect('/');
    }
}
