<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
class EmailVerificationPromptController extends Controller
{
  
    public function __invoke(Request $request)
    {
        $user = $request->user();
        if(!$user->hasVerifiedEmail())
        {
            $user->email_verified_at = Carbon::now();
            $user->save();
        }
        return $user->hasVerifiedEmail()
        ? redirect()->intended(RouteServiceProvider::HOME)
        : view('pages/auth.verify-email');
    }
}
