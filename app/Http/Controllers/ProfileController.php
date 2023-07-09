<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Post;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
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
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
    public function index(Request $request)
    {
        $user = $request->user();
        $posts = Post::where('user_id', $user->id)->get();
        return view('profile')->with(['posts' => $posts, 'user' => $user]);
    }
    
    public function introduction(Request $request)
    {
        $user = Auth::user();
        $input_introduction = $request['user_introduction'];
        $user->content = $input_introduction;
        $user->save();
        return redirect()->back();
    }
    
    public function postByDate($date)
    {
        $posts = Post::whereDate('date', $date)->get();

        return view('posts.showMyPost', ['posts' => $posts]);
    }
}
