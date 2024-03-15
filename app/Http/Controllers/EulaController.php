<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class EulaController extends Controller
{
    public function show()
    {
        return view('eula.show');
    }

    public function accept(Request $request)
    {
        $user = Auth::user();

        // Define the EULA version
        $eulaVersion = 'Version 1.0';

        // Update user's EULA acceptance status and details
        $user->update([
            'eula_accepted' => true,
            'eula_accepted_at' => now(),
            'eula_version'    => $eulaVersion
        ]);

        // Set a cookie to remember EULA acceptance for 30 days
        Cookie::queue('eula_accepted', 'true', 30 * 24 * 60); // 30 days in minutes

        return redirect('/home'); // Redirect to dashboard or desired page
    }
}
