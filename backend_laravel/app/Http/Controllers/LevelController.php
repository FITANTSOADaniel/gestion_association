<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class LevelController extends Controller
{
    // public function __construct( Request $request)
    // {
    //     $this->middleware('auth:api');
    // }

    public function findAll()
    {
        try {
            $association = Level::get();
            return response()->json(['status' => 'success', 'niveau' => $association]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $association = Level::create($data);
            return response()->json(['status' => 'success', 'message' => 'Niveau ajouté avec succès']);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $member = Level::findOrFail($id);
            $member->update($data);

            return response()->json(['status' => 'success', 'message' => 'Niveau mis à jour avec succès']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $member = Level::findOrFail($id);
            $member->delete();
            return response()->json(['status' => 'success', 'message' => 'Niveau supprimé avec succès']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
