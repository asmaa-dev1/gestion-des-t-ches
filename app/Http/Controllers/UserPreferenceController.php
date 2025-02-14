<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;

class UserPreferenceController extends Controller
{
    public function edit()
    {
        $preferences = auth()->user()->preferences;
        return view('preferences.edit', compact('preferences'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'theme' => 'required|in:light,dark',
            'language' => 'required|in:fr,en',
            'email_notifications' => 'boolean',
            'dashboard_widgets' => 'array',
            'default_view' => 'required|in:list,grid'
        ]);

        auth()->user()->preferences()->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Préférences mises à jour avec succès.');
    }
}