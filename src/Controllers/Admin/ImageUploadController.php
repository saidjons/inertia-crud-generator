<?php

 
namespace Saidjon\InertiaCrudGenerator\Controllers\Admin;

use Illuminate\Http\Request;
use RahulHaque\Filepond\Facades\Filepond;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
     
     public function articleImageUpload(Request $request)
     {

            
      if ($request->hasFile('image')) {
             $originalName = $request->file('image')->getClientOriginalName();

             $file = $request->file('image');

             $imageTitle = now()->timestamp.'-'.$originalName;

             $file->storeAs(config('inertia-crud-generator.imageUploadFolder'),$imageTitle);
             
            $url =  Storage::url(config('inertia-crud-generator.imageUploadFolder').$imageTitle);
             return response()->json([
                'url'=>$url,
            ],200);
         ob_end_clean();
           

         }else{
             
               
                return response()->json([
                       'message' => 'No File attached'
                ],203);
         }
     }

     
     
}
