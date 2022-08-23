<?php

 
namespace Saidjon\InertiaCrudGenerator\Controllers\Admin;

use Illuminate\Http\Request;
 

use App\Http\Controllers\Controller;
 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
 

class UploadController extends Controller
{
        public function ckeditorImageUpload(Request $request)
     {

            
      if ($request->hasFile('profile_photo_path')) {
             $originalName = $request->file('image')->getClientOriginalName();
 

             $file = $request->file('image');

             $imageTitle = now()->timestamp.'-'.$originalName;

             $file->storeAs(config('inertia-crud.ckeditorImageFolder'),$imageTitle);
             
            $url =  Storage::url(config('inertia-crud.ckeditorImageFolder').$imageTitle);
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
          
         
        return response()->json([
               'error'=>$validator->errors()->first(),
            ],203);
        }
           
          
      if ($request->hasFile($fieldName)) {

          

             $originalName = $request->file($fieldName)->getClientOriginalName();
             $file = $request->file($fieldName);

             $imageTitle = now()->timestamp.'-'.trim($originalName);

              if (!file_exists(config('inertia-crud.imageUploadFolder'))) {
                     mkdir(config('inertia-crud.imageUploadFolder'), 0777, true);
              }

             $file->storePubliclyAs(config('inertia-crud.imageUploadFolder'),$imageTitle);
             
            $url =  Storage::url(config('inertia-crud.imageUploadFolder').$imageTitle);
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
      public function fileUpload(Request $request,$fieldName)
     {
            
       $validator = Validator::make($request->all(), [
            $fieldName => 'required|file|max:100000',
        ]);
     
        if ($validator->fails()) {
          
          
        return response()->json([
               'error'=>$validator->errors()->first(),
            ],203);
        }
           
          
      if ($request->hasFile($fieldName)) {

          

             $originalName = $request->file($fieldName)->getClientOriginalName();
             $file = $request->file($fieldName);

             $imageTitle = now()->timestamp.'-'.trim($originalName);

              if (!file_exists(config('inertia-crud.fileUploadFolder'))) {
                     mkdir(config('inertia-crud.fileUploadFolder'), 0777, true);
              }

             $file->storePubliclyAs(config('inertia-crud.fileUploadFolder'),$imageTitle);
             
            $url =  Storage::url(config('inertia-crud.fileUploadFolder').$imageTitle);
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
