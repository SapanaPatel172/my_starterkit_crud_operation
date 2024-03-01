<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Mail\MyEmailTemplate;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
   
    public function create()
    {
        addJavascriptFile('assets/js/custom/authentication/sign-up/general.js');

        return view('pages/auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
       
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'email_verified_at'=>Carbon::now(),
            'password' => Hash::make($request->password),
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
        $user->assignRole('trial');
        Mail::to($user->email)->send(new MyEmailTemplate($user));
        event(new Registered($user));
       // $data=EmailTemplates::all();
        Auth::login($user);
        return response()->json(['message' => 'Registration successful'], 200);
        // return redirect(RouteServiceProvider::HOME);
       
    }
}
