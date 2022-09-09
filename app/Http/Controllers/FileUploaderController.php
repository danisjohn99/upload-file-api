<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use Auth;
use Illuminate\Support\Str;

use App\Models\File;

/**
 * FileUploaderController
 * This controlleris used to interact file upload operations.
 *
 * @author      LearnPanda <danisjohn99@gmail.com>
 */

class FileUploaderController extends Controller
{

        /**
         * File Upload.
         *
         * @param  Request  $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function uploadPdf(Request $request)
        {

            $validator = Validator::make($request->all(), [
                'pdf' => 'required|mimes:pdf|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
            
            try {
                $userId = Auth::user()->id;
                $file = $request->file('pdf');
                $fileType = $file->getClientOriginalExtension();
                $fileName = time() . Str::random(5) . '_' . $file->getClientOriginalName();
                \Storage::disk('pdf')->put($fileName, file_get_contents($file));
                 File::create(['user_id'=>$userId,'file_name'=>$fileName,'file_type'=>$fileType]);
                return response()->json(['success' => 'Uploaded Successfully'], 200);
            }catch (JWTException $e) {
            return response()->json(['error' => 'Failed'], 500);
            }
            
        }


        /**
         * Users Uploaded PDF List.
         *
         * @param Request  $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function pdfList(Request $request)
        {

            $userId = Auth::user()->id;
            $data =[];
            try {
                $pdfList = File::where([ ['user_id',$userId],['file_type','pdf'] ])->paginate(10);

                 if(count($pdfList)){
                    foreach($pdfList as $pdf){
                        $fileUrl = \Storage::disk('pdf')->path($pdf['file_name']);
                        $data[] = ['id'=> $pdf['id'],'file_name'=> $pdf['file_name'],'file_type'=> $pdf['file_type'],'file_url'=>$fileUrl];
                    }
                 }

                 $response = [
                    'status' => 'success',
                    'data' => $data,
                ];
                return response()->json($response, 200); 

            }catch (JWTException $e) {
            return response()->json(['error' => 'Failed'], 500);
            }
            
        }


}
