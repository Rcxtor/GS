<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Address;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
    //     $user = Auth::user();
    // $shippingAddress = Address::where('user_id', $user->id)->first();
    //     dd($shippingAddress);
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function password(Request $request): View
    {
        return view('profile.password', [
            'user' => $request->user(),
        ]);
    }
    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        // Validate and upload the photo if present
        if ($request->hasFile('photo')) 
            {
                $validatedData = $request->validated();
                
                // Delete the old photo if it exists
                if ($user->photo) 
                {
                    Storage::disk('public')->delete($user->photo);
                }

                // Store the new photo and save the path
                $path = $request->file('photo')->store('profile-dp', 'public'); // store(folder, parentfolder)
                $validatedData['photo'] = $path;
            } 
        else 
            {
                $validatedData = $request->validated();
            }

        // Fill and save the user data
        $user->fill($validatedData);
        $user->save();

        return Redirect::route('profile.edit')->with('success', 'Profile Updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('error', 'Profile Destroyed');
    }
}
