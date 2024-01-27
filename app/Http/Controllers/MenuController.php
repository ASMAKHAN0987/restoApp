<?php

namespace App\Http\Controllers;

use App\Models\menu;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\MenuStoreRequest;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = menu::all();
        return view('admin.menus.index',compact('menus'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
      return view('admin.menus.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuStoreRequest $request)
    {
        $image = $request->file('image')->store('public/menus');
       $menu =  Menu::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>$image
        ]);
        if($request->has('categories')){
            $menu->categories()->attach($request->categories);
        } 
        // dd($request);
        return to_route('admin.menus.index')->with('success','Menu Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('admin.menus.edit',compact('menu','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, menu $menu)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'description'=>'required'
        ]);
        $image= $menu->image;
        if($request->hasFile('image')){
            Storage::delete($menu->image);
            $image = $request->file('image')->store('public/menus');
        }
        $menu->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'image'=>$image
        ]);
        if($request->has('categories')){
            $menu->categories()->sync($request->categories);
        } 
        return to_route('admin.menus.index')->with('success','Menu Updated Successfully');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(menu $menu)
    {
        Storage::delete($menu->image);
        $menu->categories()->detach();
        $menu->delete();
        return to_route('admin.menus.index')->with('danger','Menu Deleted Successfully');
    }
}
