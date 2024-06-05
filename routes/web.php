<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\CategoryController;
use App\Models\Project;
use App\Functions\Helpers as Help;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class);
    Route::resource('categories', CategoryController::class);
    //altre rotte...
});

/*
L'utente non autenticato richiede /dashboard.
Laravel applica il prefisso e cerca /admin.
Il middleware auth verifica che l'utente non è autenticato. 
Il middleware auth redirige l'utente alla pagina di login (vedi app/Http/middleware/Authenticate).
L'utente viene inviato all'URL /login disponibile grazie a ' require __DIR__ . '/auth.php';'.
*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/projects', function () {

        $projects = Project::paginate(15);
        foreach ($projects as $project) {
            $project->programming_languages = Help::getFormattedWordsWithComma($project->programming_languages);
            $project->frameworks = Help::getFormattedWordsWithComma($project->frameworks);
        }
        return view("projects.index", compact("projects"));
    })->name('projects.index');
    Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
});

/*
A differenza delle rotte sopra, queste non hanno il prefisso /admin.
La rotta relativa ai projects è quindi raggiungibile solo se si è loggati.
Laravel applica il middleware auth per verificare che l'utente sia loggato.

*/



require __DIR__ . '/auth.php';

Route::fallback(function () {
    return redirect()->route('admin.dashboard');
});
