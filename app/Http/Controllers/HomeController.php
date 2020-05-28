<?php

namespace App\Http\Controllers;

use App\Http\Requests\fileUpload\UploadRequest;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $files_array = Files::paginate(config('view.pagination'));

        return view('home', [
            'files' => $files_array,
        ]);
    }

    /**
     * Function to update the directory list
     */
    public function updateFiles()
    {
        $files = File::files(public_path('storage'));

        Files::truncate();

        foreach ($files as $file) {

            $new_file = new Files();
            $new_file->file_name = $file->getFilename();
            $new_file->file_path = public_path('storage') . '/' . $file->getFilename();
            $new_file->save();
        }

        return redirect('home');
    }

    /**
     * Function to delete File from directory and
     */
    public function deleteFile(Files $file)
    {

        if (File::exists($file->file_path)) {
            $delete = File::delete($file->file_path);
        }

        if ($delete) {
            Files::find($file->file_id)->delete();
        }

        return redirect('home');
    }


    /**
     * Function to upload files
     */
    public function uploadFilePost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:txt,doc,docx,pdf,png,jpeg,jpg,gif|max:2048',
        ]);


        try {
            $file_name = $request->file->getClientOriginalName();

            $request->file->move(public_path('storage'), $file_name);
            return redirect('/update-page')
                ->with('success', 'You have successfully upload file.')
                ->with('file', $file_name);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Function to upload files
     */
    public function uploadFile()
    {
        return redirect('home');
    }


    /**
     * Function for Live search
     */
    // public function search() {
    //     $search_text = $_GET['text'];
    //     if ($search_text==NULL) {
    //         $data= Files::all();
    //     } else {
    //         $data=Files::where('finle_name','LIKE', '%'.$search_text.'%')->get();
    //     }
    //     return view('home')->with('results',$data);
    // }
}
