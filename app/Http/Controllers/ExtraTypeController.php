<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ExtraType;
use Yajra\Datatables\Datatables;
use Notification;

class ExtraTypeController extends Controller
{
	public function Index()
	{
		return view("admin.products.index_type");
	}

	public function getData()
	{
		return Datatables::of(ExtraType::all())->make(true);
	}

	public function Create()
	{
		return view('admin.products.create_type');
	}

	public function Store(Request $request)
	{
		$v = $request->validate([
			'input_name' =>'required',
		]);
		$name = $request->input('input_name');

		$extraType = new ExtraType;
		$extraType->name = $name;
		$extraType->save();
		Notification::success("S'ha creat un nou tipus");		
		return redirect()->route('admin.product.extraType.index');		
	}

	public function Edit($id)
	{
		$extraType = ExtraType::findOrFail($id);
		return view ('admin.products.edit_type')->with('extraType',$extraType);
	}

	public function Update(Request $request)
	{
		
		$v = $request->validate([
			'input_name' =>'required',
		]);
		$name = $request->input('input_name');

		$extraType = ExtraType::findOrFail($request->id);
		$extraType->name = $name;
		$extraType->save();

		Notification::success("S'ha actualitzat el tipus");		
		return redirect()->route('admin.product.extraType.index');	
	}

	public function Delete($id)
	{
		$extraType = ExtraType::findOrFail($id);
		if($extraType!=null)		
		{
			$extraType->delete();
		}
	}
}
