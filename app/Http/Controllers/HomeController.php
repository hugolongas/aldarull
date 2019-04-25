<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Cover;
use App\Gallery;
use App\Schedule;
use App\Product;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function IndexAdmin()
    {
        return view('admin.index');
    }
    public function Index()
    {
        $covers = Cover::all();
        $galleries = Gallery::orderBy('created_at','desc')->take(8)->get();
        $slider = Gallery::inRandomOrder()->take(5)->get();
        $schedules = Schedule::orderBy('event_date','desc')->where('active',1)->take(3)->get();
        $products = Product::all()->where('active',1)->take(4);
        return view('index')->with('covers', $covers)->with('galleries', $galleries)->with('slider',$slider)
        ->with('schedules',$schedules)->with('products',$products);
    }

    public function contact(Request $request)
    {
        $name = $request->input('name');
        $message = $request->input('message');
        $email = $request->input('email');
        Mail::to('contacte@aldarullgrup.cat')->send(new Contact($name,$email,$message)); 
       $response = [
            'status' => 'success',
            'msg' => $message ,
        ];
        return response()->json([$response], 200);
    }

    public function getDownload($id)
	{
        $cover = Cover::findOrFail($id);
        $link_url = $cover->GetValue('link_url');
		return Storage::disk('public')->download($link_url);
	}
}
