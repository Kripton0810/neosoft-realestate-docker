<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password'         => 'required|min:6',
            'password_confirm' => 'required|same:password'
        ]);
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->update();
        return redirect()->back()->with('success', 'Password updated successfully');
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'profilepic' => [ 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],

        ]);


        $user = new User();
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        if ($request->profilepic!=null) {
            $filepath = Auth::user()->profilepic;
            Storage::delete([$filepath]);
            $fileupload = $request->file('profilepic')->store('profile/dp','public');
            $user->profilepic = $fileupload;
        }
        else {
            print_r('no pic');
        }
        $user->update();


        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
