<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{

public function index(Request $request)
{
$search = $request->search;

$items = Item::when($search,function($query,$search){
return $query->where('name','like',"%$search%")
->orWhere('category','like',"%$search%");
})->paginate(5);

return view('items.index',compact('items'));
}

public function create()
{
return view('items.create');
}

public function store(Request $request)
{

$request->validate([
'name'=>'required',
'category'=>'required',
'price'=>'required',
'quantity'=>'required'
]);

$imageName=null;

if($request->image){
$imageName=time().'.'.$request->image->extension();
$request->image->move(public_path('images'),$imageName);
}

Item::create([
'name'=>$request->name,
'category'=>$request->category,
'price'=>$request->price,
'quantity'=>$request->quantity,
'description'=>$request->description,
'image'=>$imageName
]);

return redirect('/items')->with('success','Menu Added Successfully');
}

public function show($id)
{
$item = Item::findOrFail($id);
return view('items.show',compact('item'));
}

public function edit($id)
{
$item = Item::findOrFail($id);
return view('items.edit',compact('item'));
}

public function update(Request $request,$id)
{

$item = Item::findOrFail($id);

$imageName=$item->image;

if($request->image){
$imageName=time().'.'.$request->image->extension();
$request->image->move(public_path('images'),$imageName);
}

$item->update([
'name'=>$request->name,
'category'=>$request->category,
'price'=>$request->price,
'quantity'=>$request->quantity,
'description'=>$request->description,
'image'=>$imageName
]);

return redirect('/items')->with('success','Updated Successfully');
}

public function destroy($id)
{
Item::destroy($id);
return redirect('/items')->with('success','Deleted Successfully');
}

}