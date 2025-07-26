<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AssociationController extends Controller
{

    public function findAll()
    {
        try {
            $association = Association::get();

            return response()->json(['status' => 'success', 'associations' => $association]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function findById($id)
    {
        try {
            $association = Association::where('id', $id)->
                            with('users')->
                            get();

            return response()->json(['status' => 'success', 'associations' => $association]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function findAssociation(Request $request){
        try {
            $param = $request->input('key');
            $offset = $request->input('offset'); // Valeur par défaut de 0
            $limit = $request->input('limit');   // Valeur par défaut de 10

            $associations = Association::query();

            if ($param) {
                $associations->where('name', 'like', "%$param%");
            }

            $associations->orderBy('id', 'desc');
            $associationCount = $associations->count();
            $results = $associations->limit($limit)->offset($offset)->get();

            return response()->json([
                'status' => 'success',
                'associations' => $results,
                'associationCount' => $associationCount
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function upload(Request $request)
    {
        $paths = [];
        if ($request->hasFile('fichier')) {
            foreach ($request->file('fichier') as $file) {
                $path = $file->store('documents', 'public');
                $paths[] = $path;
            }

            return response()->json([
                'message' => 'success',
                'paths' => $paths,
            ]);
        } else {
            return response()->json([
                'message' => 'error',
                'error' => 'No files provided',
            ], 400);
        }
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'logo' => 'required|string', // ou mettez 'required' si le logo est obligatoire
        ]);

        // Création de l'association
        $association = new Association();
        $association->name = $request->input('name');
        $association->desc = $request->input('desc');
        $association->logo = $request->input('logo'); // URL ou chemin du logo
        $association->save();

        // Retourne une réponse JSON
        return response()->json([
            'message' => 'Association enregistrée avec succès',
            'association' => $association,
        ], 201);
        // try {
        //     $data = $request->all();
        //     $association = Association::create($data);
        //     return response()->json(['status' => 'success', 'message' => 'Association créé avec succès']);
        // }catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
    }
    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $member = Association::findOrFail($request->id);
            $member->update($data);

            return response()->json(['status' => 'success', 'message' => 'Association mis à jour avec succès']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $member = Association::findOrFail($id);
            $member->delete();
            return response()->json(['status' => 'success', 'message' => 'Association supprimé avec succès']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
