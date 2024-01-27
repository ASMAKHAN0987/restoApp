<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
class MenuController extends Controller
{
   public function index(){
    $menus = Menu::all();
     return view('menu.index',compact('menus'));
   }
}
