<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Welcome extends Controller
{
    public function index(){
        $specials = Category::where('name','special')->first();
        return view('welcome',compact('specials'));
    }
    public function thankyou(){
        return view('thankyou');
    }
}
