<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rules;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $genres = Genre::latest()->get();

        return view('profile.edit', [
            'user' => $request->user(),
            'genres' => $genres,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

        return Redirect::to('/');
    }



    public function adminDeleteProfile($user_id)
    {
        $user = User::find($user_id);

        if ($user->id == Auth::user()->id) {
            return redirect()->back()->with('admin-cannot-delete', 'You cannot delete your own profile.');
        }

        // Delete all the user's books and their associated images before deleting the user
        foreach ($user->books as $book) {
            Storage::delete($book->image);
            $book->delete();
        }

        $user->delete();

        return redirect()->back()->with('admin-user-deleted', 'User deleted.');
    }



    public function createAdminForm()
    {
        $genres = Genre::latest()->get();

        return view('create-admin', [
            'genres' => $genres,
        ]);
    }



    public function createAdmin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        User::factory()->create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true,
        ]);

        return redirect('/dashboard')->with('admin-created', 'Admin user created successfully.');
    }

}
