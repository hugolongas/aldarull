<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Download;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Notification;

class DownloadController extends Controller
{
	public function Index()
	{
		$downloads = Download::all();
		return view("download")->with('downloads', $downloads);
	}

	public function IndexAdmin()
	{
		return view('admin.downloads.index');
	}


	public function getData()
	{
		return Datatables::of(Download::all())->make(true);
	}

	public function Create()
	{
		return view('admin.downloads.create');
	}

	public function Store(Request $request)
	{
		$v = $request->validate([
			'file_url' => 'required',
			'file_title' => 'required',
		]);
		$file_url = $request->file('file_url');
		$file_title = $request->input('file_title');
		$file_desc = $request->input('file_desc');
		$filePath = "";
		$fileName = "";
		if ($file_url != null) {
			$path = 'downloads/';
			$fileName = $file_url->getClientOriginalName();
			$filePath = $path . $fileName;
			Storage::disk('public')->put($filePath, file_get_contents($file_url));
		}
		if ($file_title == null)
			$file_title = '';
		if ($file_desc == null)
			$file_desc = '';

		$download = new Download;
		$download->file_title = $file_title;
		$download->file_desc = $file_desc;
		$download->file_url = $filePath;
		$download->file_name = $fileName;
		$download->save();

		Notification::success("S'ha creat un nou element de descarrega");
		return redirect()->route('admin.download.index');
	}

	public function Edit($id)
	{
		$download = Download::findOrFail($id);
		return view('admin.downloads.edit')->with('download', $download);
	}

	public function Update(Request $request)
	{

		$v = $request->validate([
			'file_title' => 'required',
		]);
		$file_url = $request->file('file_url');
		$file_title = $request->input('file_title');
		$file_desc = $request->input('file_desc');
		$previous_file = $request->file('previous_file');
		$fileName = "";
		$filePath = "";
		if ($file_title == null)
			$file_title = '';

		$download = Download::findOrFail($request->id);
		$download->file_title = $file_title;
		$download->file_desc = $file_desc;
		$fileName = "";
		$filePath = "";
		if ($file_url != null) {

			$path = 'downloads/';
			$fileName = $file_url->getClientOriginalName();
			$filePath = $path . $fileName;
			if ($previous_file != $fileName) {
				$previousPath = $path . $previous_file;
				Storage::disk('public')->put($fileName, file_get_contents($file_url));
				$download->file_url = $filePath;
				$download->file_name = $fileName;
				Storage::disk('public')->delete($previousPath);
			}
		}
		$download->save();
		Notification::success("S'ha editat la descarrega");
		return redirect()->route('admin.download.index');
	}

	public function Delete($id)
	{
		$download = Download::findOrFail($id);
		if ($download != null) {
			if ($exists = Storage::disk('public')->exists($download->file_url)) {
				Storage::disk('public')->delete($download->file_url);
			}
			$download->delete();
		}
	}

	public function getDownload($id)
	{
		$download = Download::findOrFail($id);
		return Storage::disk('public')->download($download->file_url);
	}
}
