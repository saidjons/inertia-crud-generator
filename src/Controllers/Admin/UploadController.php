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


              if ($request->hasFile('image')) {
                     $originalName = $request->file('image')->getClientOriginalName();


                     $file = $request->file('image');

                     $imageTitle = now()->timestamp . '-' . $originalName;

                     $file->storeAs(config('inertia-crud-generator.ckeditorImageFolder'), $imageTitle);

                     $url =  Storage::url(config('inertia-crud-generator.ckeditorImageFolder') . $imageTitle);
                     return response()->json([
                            'url' => $url,
                     ], 200);
                     ob_end_clean();
              } else {


                     return response()->json([
                            'message' => 'No File attached'
                     ], 203);
              }
       }

       public function imageUpload(Request $request, $fieldName)
       {

              $validator = Validator::make($request->all(), [
                     $fieldName => 'required|image|max:1000',
              ]);

              if ($validator->fails()) {


                     return response()->json([
                            'error' => $validator->errors()->first(),
                     ], 203);
              }


              if ($request->hasFile($fieldName)) {



                     $originalName = $request->file($fieldName)->getClientOriginalName();
                     $file = $request->file($fieldName);

                     $imageTitle = now()->timestamp . '-' . trim($originalName);

                     if (!file_exists(config('inertia-crud-generator.imageUploadFolder'))) {
                            mkdir(config('inertia-crud-generator.imageUploadFolder'), 0777, true);
                     }

                     $file->storePubliclyAs(config('inertia-crud-generator.imageUploadFolder'), $imageTitle);

                     $url =  Storage::url(config('inertia-crud-generator.imageUploadFolder') . $imageTitle);
                     return response()->json([
                            'url' => $url,
                     ], 200);
                     ob_end_clean();
              } else {


                     return response()->json([
                            'message' => 'No File attached'
                     ], 203);
              }
       }
       public function imageDelete(Request $request,$fieldName)
       {
              $validator = Validator::make($request->all(), [
                     $fieldName => 'required|string',
              ]);

              $image = $request->input($fieldName);



              if ($validator->fails()) {


                     return response()->json([
                            'error' => $validator->errors()->first(),
                     ], 203);
              }


              if ($request->has($fieldName)) {

                     $imagePath = explode('storage', $image);


                     if (Storage::disk('public')->exists($imagePath[1])) {
                            $r = Storage::disk('public')->delete($imagePath[1]);
                     }

                     if ($r) {
                            return response()->json(['message' => $r,], 204);
                            ob_end_clean();
                     } else {
                            return response()->json(['message' => $r,], 401);
                     }
              } else {


                     return response()->json([
                            'message' => 'Invalid image path '
                     ], 203);
              }
       }




       public function fileDelete(Request $request, $filename)
       {
              $validator = Validator::make($request->all(), [
                     $filename => 'required|string',
              ]);

              $file = $request->input($filename);



              if ($validator->fails()) {


                     return response()->json([
                            'error' => $validator->errors()->first(),
                     ], 203);
              }


              if ($request->has($filename)) {

                     // remove "storage" from filepath . because Storage::disk() also adds "storage" to the path
                     $filePath = explode('storage', $file);

                     if (Storage::disk('public')->exists($filePath[1])) {
                            $r = Storage::disk('public')->delete($filePath[1]);
                     }

                     if ($r) {
                            return response()->json(['message' => `File Deleted : {$file}`,], 200);
                            ob_end_clean();
                     } else {
                            return response()->json(['message' => $r,], 401);
                     }
              } else {


                     return response()->json([
                            'message' => 'Invalid file path '
                     ], 203);
              }
       }


       public function fileUpload(Request $request, $fieldName)
       {

              $validator = Validator::make($request->all(), [
                     $fieldName => 'required|file|max:100000',
              ]);

              if ($validator->fails()) {


                     return response()->json([
                            'error' => $validator->errors()->first(),
                     ], 203);
              }


              if ($request->hasFile($fieldName)) {



                     $originalName = $request->file($fieldName)->getClientOriginalName();
                     $file = $request->file($fieldName);
                     $filePath = 'public/' . $fieldName . '/';

                     $imageTitle = now()->timestamp . '-' . trim($originalName);

                     if (!file_exists($filePath)) {
                            mkdir($filePath, 0777, true);
                     }

                     $file->storePubliclyAs($filePath, $imageTitle);

                     $url =  Storage::url($filePath . $imageTitle);
                     return response()->json([
                            'url' => $url,
                     ], 200);
                     ob_end_clean();
              } else {


                     return response()->json([
                            'message' => 'No File attached'
                     ], 203);
              }
       }




     
     
}
