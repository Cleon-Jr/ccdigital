<?php

use App\Http\Controllers\adminDashController;
use App\Http\Controllers\adminLoginController;
use App\Http\Controllers\adminLogoutController;
use App\Http\Controllers\adminUserController;
use App\Http\Controllers\configController;
use App\Http\Controllers\institutionController;
use App\Http\Controllers\mainController;
use App\Http\Controllers\uploadsController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('admin.login');
// });

//Rota para configurações iniciais do app
// Route::get('/admin/config-init', [configController::class, 'configInit']);

// Exibir tela de login
Route::get('/admin', [adminLoginController::class, 'viewLogin']);
// Login
Route::post('/admin/login', [adminLoginController::class, 'login']);



//Route middleware
Route::middleware(['sessionUser'])->group(function(){

// Adicionar usuário
Route::post('/admin/adduser', [adminUserController::class, 'addUser']);
// Exibe a grid de usuários admins cadastrados
Route::get('/admin/userlist', [adminUserController::class, 'viewUserList']);
// Exibe o form de cadastro de administradores
Route::get('/admin/administrator', [adminUserController::class, 'viewFormAdmin']);

//exibe a tela principal (main)
Route::get('/admin/main', [mainController::class, 'viewMain']);
// exibe a tela de dashboard
Route::get('/admin/dash', [adminDashController::class, 'viewDash']);

//Exibe a tela de uploads de arquivos json
Route::get('/admin/uploads', [uploadsController::class, 'viewUploads']);
// executa o envio e inserção de dados via arquivos json
Route::post('/admin/send', [uploadsController::class, 'sendFiles']);

// Exibe a tela de cadastro da instituição
Route::get('/admin/institution', [institutionController::class, 'viewInstitution']);
// realiza a inserção das informações da instituição gestora via formulário
Route::post('/admin/saveinst', [institutionController::class, 'saveInstitution']);
// realiza a inserção das informações da instituição gestora via arquivo json
Route::post('/admin/addinstjson', [institutionController::class, 'addInstitutionJson']);


//realiza o logout do usuário
Route::get('/admin/logout', [adminLogoutController::class, 'adminLogout']);

});



//Public Routes
Route::get('/', function(){
    return view('public.login');
});
