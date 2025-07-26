<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class PostController extends Controller
{

    public function findAll()
    {
        try {
            $post = Post::with("user")->orderBy('created_at', 'desc')->get();
            return response()->json(['status' => 'success', 'posts' => $post]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function upload_post(Request $request){
        $paths = [];
        $request->validate([
            'file' => 'required|file|mimes:png,jpg,pdf',
        ]);
            if($request->hasFile('file')){
                $files = $request->file('file');
                $path = $files->store('documents', 'public');
                $paths[] = $path;
                return response()->json([
                    'message' => 'success',
                    'paths' => $paths,
                ], 200);
            }

            return response()->json([
                'message' => 'NOT Ok',
            ], 400);
    }

    public function update_profil(Request $request){
        try {
            $user = User::findOrFail($request->id);

            $user->fill($request->only(['profil']));
            $user->save();
            return response()->json(['status' => 'success', 'message' => 'Utilisateur mis a jour avec succès', 'user' => $user]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $firstError = $exception->validator->getMessageBag()->first();
            return response()->json(['error' => $firstError], 422);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $posts = Post::create($data);
            return response()->json(['status' => 'success', 'message' => 'Publication créée avec succès']);
        }catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $member = Post::findOrFail($id);
            $member->update($data);

            return response()->json(['status' => 'success', 'message' => 'Publication mis à jour avec succès']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $member = Post::findOrFail($id);
            $member->delete();
            return response()->json(['status' => 'success', 'message' => 'Publication supprimée avec succès']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
