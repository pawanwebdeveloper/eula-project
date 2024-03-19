<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Eula;

class EulaController extends Controller
{
    public function index()
    {
        $eula = Eula::latest()->first();

        return view('eula.index', compact('eula'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'version' => 'required',
            'content' => 'required'
        ]);

        Eula::updateOrCreate([
            'id' => $request->id
        ], [
            'version' => $request->version,
            'content' => $request->content
        ]);

        return back()->with('success', 'EULA updated successfully.');
    }

    public function show(Request $request)
    {
        $eula = Eula::latest()->first();
        $user = Auth::user();
        if ($user->eula_accepted && ($eula->version == $user->eula_version) && $request->cookie('eula_accepted_'.$user->id)) {
            return redirect()->route('home');
        }

        return view('eula.show', compact('eula'));
    }

    public function accept(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login'); // Redirect if user is not authenticated
        }

        if ($request->input('response') === 'accept') {
            // Define the EULA version
            $eulaVersion = $request->version;

            // Update user's EULA acceptance status and details
            $user->update([
                'eula_accepted' => true,
                'eula_accepted_at' => now(),
                'eula_version' => $eulaVersion
            ]);

            // Set a cookie to remember EULA acceptance for 30 days
            Cookie::queue('eula_accepted_'.$user->id, 'true', 30 * 24 * 60); // 30 days in minutes

            // Redirect to the dashboard or desired page after accepting
            return redirect('/home')->with('success', 'EULA accepted successfully.');
        } else {
            // If rejected, reset the EULA acceptance details
            $user->update([
                'eula_accepted' => false,
                'eula_accepted_at' => null,
                'eula_version' => null
            ]);

            // Redirect to a different page or show a message after rejecting
            // return redirect('/home')->with('error', 'EULA rejected.');

            Auth::logout();
            return redirect('/login')->with('error', 'EULA rejected.');
        }
    }
}
