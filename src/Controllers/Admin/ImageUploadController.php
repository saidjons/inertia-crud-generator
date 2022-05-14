<?php

 
namespace Saidjon\InertiaCrudGenerator\Controllers\Admin;

use Illuminate\Http\Request;
 

use App\Http\Controllers\Controller;
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
 

class ImageUploadController extends Controller
{
        public function ckeditorImageUpload(Request $request)
     {

            
      if ($request->hasFile('profile_photo_path')) {
             $originalName = $request->file('image')->getClientOriginalName();
 

             $file = $request->file('image');

             $imageTitle = now()->timestamp.'-'.$originalName;

             $file->storeAs(config('inertia-crud-generator.ckeditorImageFolder'),$imageTitle);
             
            $url =  Storage::url(config('inertia-crud-generator.ckeditorImageFolder').$imageTitle);
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

      public function imageUpload(Request $request,$fieldName)
     {
            
       $validator = Validator::make($request->all(), [
            $fieldName => 'required|image|max:1000',
        ]);
     
        if ($validator->fails()) {
          
          logger(json_encode($validator->errors()->first()));
        return response()->json([
               'error'=>$validator->errors()->first(),
            ],203);
        }
           
          
      if ($request->hasFile($fieldName)) {

          

             $originalName = $request->file($fieldName)->getClientOriginalName();
             $file = $request->file($fieldName);

             $imageTitle = now()->timestamp.'-'.trim($originalName);

              if (!file_exists(config('inertia-crud-generator.imageUploadFolder'))) {
                     mkdir(config('inertia-crud-generator.imageUploadFolder'), 0777, true);
              }

             $file->storePubliclyAs(config('inertia-crud-generator.imageUploadFolder'),$imageTitle);
             
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
