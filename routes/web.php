 <?php


use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;

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

Route::get('/', function () {
    return view('home');
})->name('login');;


// User Related routes
Route::post('/register',[UserController::class,'register'])->middleware('guest');;
Route::post('/login',[UserController::class,'login'])->middleware('guest');;
Route::post('/logout',[UserController::class,'logout'])->middleware('must.be.logged.in');;
Route::post('/show-header',[UserController::class,'showHeader']);



// Blogpost Related Routes
Route::get('/create-post',[PostController::class,'showCreateForm'])->middleware('must.be.logged.in');
Route::post('/create-post',[PostController::class,'storeNewPost'])->middleware('must.be.logged.in');;
Route::get('/post/{post}',[PostController::class,'showSinglePost'])->middleware('must.be.logged.in');;
// Profile related routes
Route::get('/profile/{user:username}', [UserController::class, 'profile']);