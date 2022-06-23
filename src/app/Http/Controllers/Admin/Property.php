<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Images;
use App\Models\Message;
use App\Models\Property as ModelsProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Property extends Controller
{
    public function index(Request $req)
    {
        $cities = City::all();
        return view('admin.pages.addproperty',compact('cities'));
    }
    public function getUser(Request $req)
    {
        // echo "<pre>";
        print_r(Auth::guard('admin')->user()->id);
    }
    public function store(Request $req)
    {
        if ($req->hasFile('default_image')) {
            $default_image = $req->file('default_image')->store('images/property','public');
        }
        $property = ModelsProperty::create([
            "admin_id"=>Auth::guard('admin')->user()->id,
            "title"=>$req->title,
            "price"=>$req->price,
            "floor_area"=>$req->floor_area,
            "bedroom"=>$req->bedroom,
            "bathroom"=>$req->bathroom,
            "city"=>$req->city,
            "address"=>$req->address,
            "description"=>$req->description,
            "near_by_places"=>$req->near_by_places,
            "default_image"=>$default_image??null
        ]);

        if ($req->hasFile('image2')) {
            $image2 = $req->file('image2')->store('images/property','public');
            Images::create([
                "property_id"=>$property->id,
                "url"=>$image2
            ]);
        }
        if ($req->hasFile('image3')) {
            $image3 = $req->file('image3')->store('images/property','public');
            Images::create([
                "property_id"=>$property->id,
                "url"=>$image3
            ]);
        }
        if ($req->hasFile('image4')) {
            $image4 = $req->file('image4')->store('images/property','public');
            Images::create([
                "property_id"=>$property->id,
                "url"=>$image4
            ]);
        }
        if ($req->hasFile('image5')) {
            $image5 = $req->file('image5')->store('images/property','public');
            Images::create([
                "property_id"=>$property->id,
                "url"=>$image5
            ]);
        }
        return redirect('/admin/dashboard')->with('success','property added');
    }
    public function show(Request $req)
    {
        $properties = ModelsProperty::all();
        return view('admin.pages.properties',compact('properties'));
    }
    public function edit(Request $req,$id)
    {
        $property = ModelsProperty::find($id);
        $cities = City::all();
        return view('admin.pages.editproperty',compact('property','cities'));
    }
    public function update(Request $req,$id)
    {
        $property = ModelsProperty::find($id);
        $property->update([
            "admin_id"=>Auth::guard('admin')->user()->id,
            "title"=>$req->title,
            "price"=>$req->price,
            "floor_area"=>$req->floor_area,
            "bedroom"=>$req->bedroom,
            "bathroom"=>$req->bathroom,
            "city"=>$req->city,
            "address"=>$req->address,
            "description"=>$req->description,
            "near_by_places"=>$req->near_by_places,
        ]);
        if ($req->hasFile('image2')) {

            $imageid = $property->images[0]->id;
            $imagedb = Images::find($imageid);

            $image5 = $req->file('image2')->store('images/property','public');
            $imagedb->update([
                "url"=>$image5
            ]);
        }
        if ($req->hasFile('image3')) {

            $imageid = $property->images[1]->id;
            $imagedb = Images::find($imageid);

            $image5 = $req->file('image3')->store('images/property','public');
            $imagedb->update([
                "url"=>$image5
            ]);
        }
        if ($req->hasFile('image4')) {

            $imageid = $property->images[2]->id;
            $imagedb = Images::find($imageid);

            $image5 = $req->file('image4')->store('images/property','public');
            $imagedb->update([
                "url"=>$image5
            ]);
        }
        if ($req->hasFile('image5')) {
            $imageid = $property->images[3]->id;
            $imagedb = Images::find($imageid);

            $image5 = $req->file('image5')->store('images/property','public');
            $imagedb->update([
                "url"=>$image5
            ]);
        }
        return redirect('/admin/dashboard')->with('success','property edited');

    }
    public function destroy($id)
    {
        $property = ModelsProperty::find($id);
        $property->delete();
        return redirect('/admin/dashboard')->with('success','property deleted');
    }
    public function showProperty($id)
    {
        $info =new  ModelsProperty();

        dd($info->with('images')->find($id)->images);
    }
    public function showMessages(Request $req,$id)
    {
        $messages = Message::join('users','users.id','=','messages.sender')->where('house',$id)->get();
        // dd($messages);
        // print_r('hello');
        return view('admin.messages',compact('messages'));
    }
}
