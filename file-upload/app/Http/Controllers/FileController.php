<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\File; 

class FileController extends Controller
{
    //
    public function index(): View
    {
        return view('fileUpload');
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);
      
        $fileName = time().'.'.$request->file->extension();  
       
        $request->file->move(public_path('uploads'), $fileName);
     
        /*  
            Write Code Here for
            Store $fileName name in DATABASE from HERE 
        */
        File::create([
            'file_name' => $fileName,
        ]);
       
        return back()
            ->with('success','You have successfully upload file.')
            ->with('file', $fileName);
   
    }
}
