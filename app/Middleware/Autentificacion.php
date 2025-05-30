use App\Http\Controllers\DashBoards\Controller;

Route::get('/', function () {
    return view('welcome');
});

// Rutas protegidas para Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Controller::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';