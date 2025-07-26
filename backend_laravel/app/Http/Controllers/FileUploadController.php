<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\Documents;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload_logo(Request $request){
        if($request->hasFile('fichier'))
        {
            $result = $request->file('fichier')->store('documents', 'public');
            $assoc = new Association();
            $assoc->logo = $result;
            $assoc->desc = $request->input('desc');
            $assoc->name = $request->input('name');
            $assoc->save();
            return response()->json([
                'message' => 'Image uploadée avec succès',
                'file_path' => $result
            ], 200);
        }else {
            return response()->json(['error' => 'Pas de fichier'], 400);
        }
    }
}
