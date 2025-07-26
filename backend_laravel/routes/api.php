<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\PostController;

use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('projects', ProjectController::class);

// Route::get('users', [UserController::class, 'index']);
// Route::post('users/data', [UserController::class, 'disable']);
// Route::post('users/email/{id}', [UserController::class, 'updateEmail']);
// Route::post('users/password/{id}', [UserController::class, 'updatePassword']);
// Route::get('clients', [UserController::class, 'findAllClients']);
// Route::get('clientInfo/{id}', [UserController::class, 'getDetailsClient']);
// Route::post('userNotif', [UserController::class, 'sendNotification']);
// Route::get('send-email', [SendEmailController::class, 'index']);
// Route::post('sendemail', [SendEmailController::class, 'sendEmail']);
// Route::post('facturation', [SendEmailController::class, 'facturation']);
// Route::post('documents', [DocumentController::class, 'store']);
// Route::post('uploadMobile', [DocumentController::class, 'uploadMobile']);
// Route::post('fileNotif', [DocumentController::class, 'sendNotification']);
// Route::delete('documents/{id}', [DocumentController::class, 'destroy']);
// Route::get('documents/{id}', [DocumentController::class, 'getByContrat']);
// Route::post('registerClient', [AuthController::class, 'registerClientBO']);
// Route::post('refresh', [AuthController::class,'refresh']);
// Route::post('checkToken', [AuthController::class,'checkToken']);
// Route::post('logCli', [AuthController::class,'loginClient']);
// Route::post('validateLog', [AuthController::class,'validateLogin']);
// Route::post('registerCli', [AuthController::class,'registerClient']);
// Route::post('validateReg', [AuthController::class,'validateRegister']);
// Route::post('regisPterInAssciation', [AuthController::class, 'registerInAssciation']);
// Route::post('upload_file', [FileUploadController::class, 'upload']);
// Route::post('upload_files', [FileUploadController::class, 'uploadFiles']);
// Route::post('optCode', [OtpController::class,'sendOtpCode']);
// Route::post('verifyCode', [OtpController::class,'verifyOTP']);
// Route::get('orders', [UserController::class, 'findAllOrder']);
// Route::get('users', [UserController::class, 'findAllUser']);

Route::post('logout', [AuthController::class,'logout']);
Route::post('login_admin', [AuthController::class,'login_Admin']);
Route::post('login_client', [AuthController::class,'login_Client']);
Route::post('register', [AuthController::class, 'register']);
Route::post('searchUser', [UserController::class, 'searchUser']);
Route::post('searchOrder', [UserController::class, 'searchOrder']);
Route::post('supprimer', [UserController::class, 'supprUsers']);
Route::get('users/{id}', [UserController::class, 'getDetailsClient']);
Route::delete('users/{id}', [UserController::class, 'destroy']);
Route::post('accepter', [UserController::class, 'acceptUsers']);
Route::post('users/info', [UserController::class, 'updateInfo']);
Route::get('level', [LevelController::class, 'findAll']);
Route::post('level', [LevelController::class, 'store']);
Route::put('level/{id}', [LevelController::class, 'update']);
Route::delete('level/{id}', [LevelController::class, 'destroy']);
Route::post('association', [AssociationController::class, 'store']);
Route::get('associations', [AssociationController::class, 'findAll']);
Route::post('findAssociation', [AssociationController::class, 'findAssociation']);
Route::post('upload', [AssociationController::class, 'upload']);
Route::post('association/{id}', [AssociationController::class, 'findById']);
Route::post('updateAssoc', [AssociationController::class, 'update']);
Route::delete('association/{id}', [AssociationController::class, 'destroy']);
Route::post('posts', [PostController::class, 'store']);
Route::get('posts', [PostController::class, 'findAll']);
Route::post('upload_post', [PostController::class, 'upload_post']);
Route::post('update_profil', [PostController::class, 'update_profil']);
Route::post('demande', [SendEmailController::class, 'demande']);
Route::post('upload_logo', [FileUploadController::class, 'upload_logo']);