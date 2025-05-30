<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeyesWordExportController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('Calculadora'); // o cualquier vista protegida
    }
    return redirect()->route('login.form');
})->name('Inicio');

Route::get('/Inicio', [AuthController::class, 'showInicio'])->name('InicioSinSesion');

Route::get('/InicioDeSesion', [AuthController::class, 'showInicioDeSesion'])->name('InicioDeSesion');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
        Route::get('Calculadora', function () {
        return view('components.CalculadoraNewton');
        })->name('Calculadora');
        Route::get('/perfil', [ProfileController::class, 'edit'])->name('perfil.edit');
        Route::post('/perfil', [ProfileController::class, 'update'])->name('perfil.update');
        Route::get('/export-word', [LeyesWordExportController::class, 'export'])->name('export.word');

});
//require __DIR__.'/auth.php';
