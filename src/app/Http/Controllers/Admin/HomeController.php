<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $req)
    {
        $my_properties = Property::where('admin_id',Auth::guard('admin')->user()->id)->get();

        return view('admin.dashboard',compact('my_properties'));
    }
    public function adminhome(Request $req)
    {

            if (Auth::guard('admin')->check()) {
                return redirect()->route('admin.dashboard');
            }
            else
            {
                return redirect()->route('admin.login');
            }
    }
}
