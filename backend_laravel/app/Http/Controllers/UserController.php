<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use App\Models\Notification;
use App\Http\Controllers\SendEmailController;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function searchUser(Request $request)
    {
        try {
            $param = $request->input('key');
            $offset = $request->input('offset');
            $limit = $request->input('limit');
            $users = User::with('level')->with("association");

                if ($param) {
                    $users->where(function ($query) use ($param) {
                        $query->where('first_name', 'like', "%$param%")
                        ->orWhere('email', 'like', "%$param%")
                        ->orWhere('last_name', 'like', "%$param%");;
                    })->orWhereHas('association', function ($query) use ($param) {
                        $query->where('name', 'like', "%$param%");
                    });

                }
            $users->where('is_admin', 0);
            $users->whereIn('status', [0,1]);
            $users->orderBy('id', 'desc');
            $userCount = $users->count();
            $users = $users->skip($offset)->take($limit)->get();
            return response()->json(['status' => 'success', 'users' => $users, 'userCount' => $userCount]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function searchOrder(Request $request)
    {
        try {
            $param = $request->input('key');
            $offset = $request->input('offset');
            $limit = $request->input('limit');
            $users = User::with('level')->with("association");

                if ($param) {
                    $users->where(function ($query) use ($param) {
                        $query->where('first_name', 'like', "%$param%")
                        ->orWhere('email', 'like', "%$param%")
                        ->orWhere('last_name', 'like', "%$param%");
                    });

                }
            $users->where('is_admin', 0);
            $users->where('status', 2);
            $users->orderBy('id', 'desc');
            $userCount = $users->count();
            $users = $users->skip($offset)->take($limit)->get();
            return response()->json(['status' => 'success', 'users' => $users, 'userCount' => $userCount]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getDetailsClient($id)
    {
        try {
            $clients = User::where('id', $id)
                        ->get();
            return response()->json(['status' => 'success', 'clients' => $clients]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function acceptUsers(Request $request)
        {
            try {
                $userIds = $request->input('userIds');
                User::whereIn('id', $userIds)->update(['status' => 1]);
                foreach ($userIds as $id) {
                    $user = User::find($id);
                    if ($user) {
                        dispatch(function() use ($user) {
                            $sendEmail = new SendEmailController();
                            $sendEmail->accepter($user);
                        });
                    }
                }

                return response()->json(['success' => "Utilisateurs acceptés avec succès"], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

    public function supprUsers(Request $request){
        try {
            $userIds = $request->input('userIds');
            User::whereIn('id', $userIds)->update(['status' => 1]);
            foreach ($userIds as $id) {
                $user = User::findOrFail($id);
                $user->delete();
            }

            return response()->json(['success' => "Utilisateurs supprimer avec succès"], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateInfo(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);

            $user->fill($request->only(['first_name',
            'last_name','email','is_admin',"level_id","association_id",'is_valid','status','profil'
            ]));
            $user->save();

            return response()->json(['status' => 'success', 'message' => 'Utilisateur mis a jour avec succès', 'user' => $user]);
        } catch (\Illuminate\Validation\ValidationException $exception) {
            $firstError = $exception->validator->getMessageBag()->first();
            return response()->json(['error' => $firstError], 422);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'Utilisateur supprimé avec succès']);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

}
