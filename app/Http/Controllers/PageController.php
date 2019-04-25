<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Page;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Notification;

class PageController extends Controller
{
	public function getQuiSom()
	{
		$page = Page::findOrFail(1);
		return view("weare")->with('page',$page);
	}

	public function Index()
	{
		return view('admin.pages.index');
	}

	public function getData()
	{
		return Datatables::of(Page::all())->make(true);
	}

	public function Show($id)
	{
		$page = Page::findOrFail($id);
		return view('admin.pages.show')->with('page',$page);
	}

	public function Create()
	{
		return view('admin.pages.create');
	}

	public function Store(Request $request)
	{
		$v = $request->validate([
			'input_img' => 'mimes:jpeg,png,jpg,gif,svg|max:8192',
			'input_page_name' =>'required',
			'input_title' =>'required',
			'input_text' =>'required',
		]);	
		$file = $request->file('input_img');
		$page_name = $request->input('input_page_name');
		$title = $request->input('input_title');
		$text = $request->input('input_text');
		
		$page = new Page;
		$page->page_name = $page_name;
		$page->page_title = $title;            
		$page->page_text = $text;
		$fileName="";
		$filePath = "";
		if($file!=null)
		{
			$path = 'pages/';
			$fileName = $file->getClientOriginalName();
			$filePath = $path.$fileName;
			Storage::disk('public')->put($filePath, file_get_contents( $file));
		}	
		$page->img_url = $filePath;
		$page->img_name = $fileName;
		$page->save();

		$insertedID = $page->id;
		Notification::success("S'ha creat una nova página");		
		return redirect()->route('admin.page.index');		
	}

	public function Edit($id)
	{
		$page = Page::findOrFail($id);
		return view ('admin.pages.edit')->with('page',$page);
	}

	public function Update(Request $request)
	{
		$v = $request->validate([
			'input_img' => 'mimes:jpeg,png,jpg,gif,svg|max:8192',
			'input_page_name' =>'required',
			'input_title' =>'required',
			'input_text' =>'required',
		]);	

		$file = $request->file('input_img');
		$page_name = $request->input('input_page_name');
		$title = $request->input('input_title');
		$text = $request->input('input_text');		
		$previousImg = $request->input('previous_img');

		$page = Page::findOrFail($request->id);
		$page->page_name = $page_name;
		$page->page_title = $title;
		$page->page_text = $text;
		$fileName="";
		$filePath = "";
		if($file!=null)
		{			
			$path = 'pages/';
			$fileName = $file->getClientOriginalName();
			$filePath = $path.$fileName;
			if($previousImg!=$fileName){
				Storage::disk('public')->put($filePath, file_get_contents( $file));
				$page->img_name = $fileName;
				$page->img_url = $filePath;
				$previousPath = $path.$previousImg;
				Storage::disk('public')->delete($previousPath);
			}
		}
		$page->save();

		$insertedID = $page->id;
		Notification::success("S'ha creat una nova página");		
		return redirect()->route('admin.page.index');		
	}
}