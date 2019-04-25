<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Extra;
use App\ExtraType;
use Yajra\Datatables\Datatables;
use Notification;

class ExtraController extends Controller
{
	public function Index()
	{
		return view("admin.products.index_extra");
	}

	public function getData()
	{
		return Datatables::of(Extra::all())->make(true);
	}

	public function Create()
	{
		$extraTypes = ExtraType::all();
		return view('admin.products.create_extra')->with('extraTypes',$extraTypes);
	}

	public function Store(Request $request)
	{
		$v = $request->validate([
			'input_type' =>'required',
			'input_value' =>'required',
		]);
		$type = $request->input('input_type');
		$value = $request->input('input_value');

		$extra = new Extra;
		$extra->type = $type;
		$extra->value = $value;
		$extra->save();
		Notification::success("S'ha creat un nou extra");		
		return redirect()->route('admin.product.extra.index');		
	}

	public function Edit($id)
	{
		$extra = Extra::findOrFail($id);
		$extraTypes = ExtraType::all();
		return view ('admin.products.edit_extra')->with('extra',$extra)->with('extraTypes',$extraTypes);
	}

	public function Update(Request $request)
	{
		
		$v = $request->validate([
			'input_type' =>'required',
			'input_value' =>'required',
		]);
		$type = $request->input('input_type');
		$value = $request->input('input_value');

		$extra = Extra::findOrFail($request->id);
		$extra->type = $type;
		$extra->value = $value;
		$extra->save();

		Notification::success("S'ha actualitzat el extra");		
		return redirect()->route('admin.product.extra.index');	
	}

	public function Delete($id)
	{
		$extra = Extra::findOrFail($id);
		if($extra!=null)		
		{
			$extra->delete();
		}
	}
}
