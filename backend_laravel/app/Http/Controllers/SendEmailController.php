<?php
namespace App\Http\Controllers;

use App\Mail\DemandeFormMail;
use App\Mail\AcceptFormMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;


use Illuminate\Http\Request;

class SendEmailController extends Controller
{

    public function demande(Request $request)
    {
        $mailToAddress = env('MAIL_FROM_ADDRESS');
        $request->validate([
            'email' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
        ]);

        $emailData = [
            'email' => $request->email,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
        ];

        Mail::to($mailToAddress)->send(new DemandeFormMail($emailData));
        $Auth = new AuthController;
        if($Auth->registerInAssciation($request)){
            return response()->json(['status' => 'success', 'message' => 'Email reçu'], 200);
        }
    }
}
