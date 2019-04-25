<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\Gallery;
use Carbon\Carbon;
use Image;
use Illuminate\Support\Facades\Storage;


class GalleryController extends Controller
{
	
	public function Index()
	{
		$galleries = Gallery::all()->sortBy('position');
		return view('gallery')->with('galleries',$galleries);
	}
	public function IndexAdmin()
	{
		$galleries = Gallery::all()->sortBy('position');
		return view("admin.gallery.index")->with('galleries',$galleries);
	}

	public function Upload(Request $request)
	{
		$fileNames="";
		$path = 'uploads/';
		$files = $request->file('files');
		$num_files = count($files);
		for($i=0;$i<$num_files;$i++){

			$file = $files[$i];
			$fileName = $file->getClientOriginalName();
			Storage::disk('public')->put($path.$fileName, file_get_contents( $file));
			$fileNames.= $fileName;
			if($i!=$num_files-1){
				$fileNames.=';';
			}

		}
		
		return $fileNames;
	}

	public function SaveGallery(Request $request)
	{
		$images = $request->input("file");
		$i = 0;
		foreach($images as $image)
		{
			$galeria = Gallery::firstOrNew(['name' => $image]);
			if($galeria->id==null)
			{
				$imgUrl = '/gallery/'.$image;
				$thumbPath = '/gallery/thumb/';
				$img = Image::make(Storage::disk('public')->get('uploads/'.$image));				
				$img->resize(570, 326, function ($constraint) {
					$constraint->aspectRatio();
				});
				$thumbUrl = $thumbPath.$image;
				$img->save(storage_path('/app/public'.$thumbUrl));
				Storage::disk('public')->move('uploads/'.$image,$imgUrl);
				
				$galeria->url = $imgUrl;
				$galeria->thumb_url = $thumbUrl;	
			}
			$galeria->position = $i; 
			$galeria->save();
			$i++;

		}
	}

	public function Delete($id)
	{
		$galeria = Gallery::findOrFail($id);
		if($galeria!=null)
		{
			if($exists = Storage::disk('public')->exists($galeria->url))
			{
				$file =  Storage::disk('public')->delete($galeria->url);
			}
			$galeria->delete();			
		}
	}
	
	public function RemoveImg($id)
	{
		if($exists = Storage::disk('public')->exists('/uploads/'.$id))
		{
			$file =  Storage::disk('public')->delete('/uploads/'.$id);
		}
	}
}

