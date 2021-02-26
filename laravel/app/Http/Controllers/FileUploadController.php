<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response,File;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
 
  
        if ($files = $request->file('file')) {
             
            //store file into document folder
	$resizedImage = cloudinary()->upload($request->file('image')->getRealPath(), [
            'folder' => 'uploads',
            'transformation' => [
                'gravity' => 'faces',
                'crop' => 'fill',
             ]
                ])->getSecurePath();
 
            //store your file into database
              
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $resizedImage
            ]);
  
        }
 
  
    }
    

	
    public function storeUploads(Request $request)
    {
    	 $resizedImage = cloudinary()->upload($request->file('image')->getRealPath(), [
            'folder' => 'uploads',
            'transformation' => [
              	'gravity' => 'faces',
              	'crop' => 'fill',
	
             ]
		])->getSecurePath();

	//   dd($resizedImage);

	return response()->json([
		'url'=>$resizedImage,
		]);

     }

}
