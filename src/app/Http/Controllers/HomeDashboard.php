<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Message;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeDashboard extends Controller
{
    public function index(Request $req)
    {
        $cities = City::all();
        $info = Property::with('images')->get();

       return  view('welcome',compact('cities','info'));
    }
    public function filterSortHomePage(Request $req)
    {

        $info = new Property();
        if ($req->city!=null) {
            $info = $info->where('city',$req->city);
        }
        if ($req->bedroom!=null) {
            $info = $info->where('bedroom',$req->bedroom);
        }
        if ($req->price!=null) {
            $info = $info->where('price','<=',$req->price);
        }
        if ($req->search!=null) {
            $info = $info->where('title','like','%'.$req->search.'%');
        }
        $info = $info->get();

        $cities = City::all();

        return  view('welcome',compact('cities','info'));
    }
    public function showProperty($id)
    {
        $info = Property::with('images')->find($id);
        return view('propertiview',compact('info'));
        // dd($info);
    }
    public function sendMessage(Request $req)
    {
        $userid = Auth::user()->id;
        $property_id = $req->property;
        $property = Property::find($property_id);
        $seller = $property->admin_id;
        $msg = Message::create([
            "sender"=>$userid,
            "reciver"=>$seller,
            "house"=>$property_id,
            "message"=>$req->message
        ]);
        return redirect()->back()->with('success','your message send to admin');
    }
}
