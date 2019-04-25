<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Extra;
use App\ExtraType;
use App\ProductExtra;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Notification;

class ProductController extends Controller
{
	public function Index()
	{
		$products = Product::all()->where('active', 1);
		return view("shop")->with('products',$products);
	}

	public function IndexAdmin()
	{
		return view('admin.products.index');
	}

	public function getData()
	{
		return Datatables::of(Product::all())->make(true);
	}

	public function Show($url)
	{
		$product = Product::where('product_url', $url)->firstOrFail();
		return view('shop.product')->with('product',$product);

	}

	public function ShowAdmin($id)
	{
		$product = Product::findOrFail($id);
		return view('admin.products.show')->with('product',$product);
	}

	public function Create()
	{
		$extras = Extra::all();
		return view('admin.products.create')->with('extras',$extras);
	}

	public function Store(Request $request)
	{
		$v = $request->validate([
			'input_img' => 'mimes:jpeg,png,jpg,gif,svg|max:8192',
			'input_name' =>'required',
			'input_price' =>'required',
		]);	
		$file = $request->file('input_img');
		$name = $request->input('input_name');
		$description = $request->input('input_desc');
		$price = $request->input('input_price');
		$extras = $request->extra;
		$fileName = "";
		$filePath = "";
		if($file!=null)
		{
			$path = 'products/';
			$fileName=$file->getClientOriginalName();
			$filePath = $path.$file->getClientOriginalName();
			Storage::disk('public')->put($filePath, file_get_contents( $file));
		}
		if($description==null)
			$description = '';
		

		$product = new Product;
		$product->name = $name;
		$product->description = $description;            
		$product->img_name = $fileName;
		$product->img_url = $filePath;
		$product->price = $price;
		$product->product_url = "";
		$product->active = 0;
		$product->save();

		if(count($extras)>0)
		{
			foreach($extras as $extraID){
				if(!$product->hasExtra($extraID))
				{
					$extra = Extra::find($extraID);
					$product->extras()->attach($extra);
				}				
			}
			//Ahora eliminaremos las que ya no estan seleccionadas
		}
		Notification::success("S'ha creat un nou producte");		
		return redirect()->route('admin.product.index');		
	}

	public function Edit($id)
	{
		$product = Product::findOrFail($id);
		$extras = Extra::all();
		return view ('admin.products.edit')->with('product',$product)->with('extras',$extras);
	}

	public function Update(Request $request)
	{
		
		$v = $request->validate([
			'input_img' => 'mimes:jpeg,png,jpg,gif,svg|max:8192',
			'input_name' =>'required',
			'input_price' =>'required',
		]);	
		
		$file = $request->file('input_img');
		$name = $request->input('input_name');
		$description = $request->input('input_desc');
		$price = $request->input('input_price');
		$previousImg = $request->input('previous_img');
		$extras = $request->extra;
		if($description==null)
			$description = '';
		$product = Product::findOrFail($request->id);
		$product->name = $name;
		$product->description = $description;
		$product->price = $price;
		$fileName = "";
		$filePath = "";
		if($file!=null)
		{
			
			$path = 'products/';
			$fileName = $file->getClientOriginalName();
			$filePath = $path.$fileName;
			if($previousImg!=$fileName){
				$previousPath = $path.$previousImg;
				Storage::disk('public')->put($fileName, file_get_contents( $file));
				$product->img_url = $filePath;
				$product->img_name = $fileName;
				Storage::disk('public')->delete($previousPath);
			}
		}				
		$product->save();
		$product->extras()->detach();
		if(count($extras)>0)
		{
			foreach($extras as $extraID){
				if(!$product->hasExtra($extraID))
				{
					$extra = Extra::find($extraID);
					$product->extras()->attach($extra);
				}				
			}
			//Ahora eliminaremos las que ya no estan seleccionadas
		}
		Notification::success("S'ha creat un nou producte");		
		return redirect()->route('admin.product.index');	
	}

	public function Delete($id)
	{
		$product = Product::findOrFail($id);
		if($product!=null)		
		{
			if($exists = Storage::disk('public')->exists($product->img_url))
			{
				Storage::disk('public')->delete($product->img_url);
			}
			$product->extras()->detach();
			$product->delete();
		}
	}

	public function Activate(Request $request)
	{
		$id = $request->id;
		$product = Product::findOrFail($id);
		$active = $request->activate;
		$product_url = $product->product_url;
		if($active=="1"){
			$product_url = Controller::seoUrl($product->name)."-".$id;	
		}		
		if($product!=null){
			if($product->img_url!=''){
				$product->active = $active;
				$product->product_url = $product_url;
				$product->save();	
			}
		}
	}

}
