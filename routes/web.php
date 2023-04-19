<?php

use App\Http\Controllers\Dashboard\Employees;
use App\Http\Controllers\Dashboard\Leaves;
use App\Http\Controllers\AddUser;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveApplicationsController;
use App\Http\Controllers\HolidayController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['admin']], function () {
    // employees
    Route::get('/add-user', [AddUser::class, 'create'])->middleware(['auth'])->name('add-user');
    Route::post('add-user', [AddUser::class, 'store']);

    Route::get('/employees', [Employees::class, 'index'])->middleware(['auth'])->name('employees');
    Route::get('/employees/index', [Employees::class, 'index'])->name('employees.index');
    Route::delete('employees/{id}', [Employees::class, 'destroy'])->name('employees.destroy');
    Route::get('employees/restore/one/{id}', [Employees::class, 'restore'])->name('employees.restore');
    Route::get('employees/restore-all', [Employees::class, 'restoreAll'])->name('employees.restoreAll');
    Route::get('edit-user/{user}', [Employees::class, 'edit'])->name('edit-user');
    Route::put('employees/update/{user}', [Employees::class, 'update'])->name('employees.update');

    // reports
    Route::get('/reports', function () {
        return view('dashboard.reports');
    })->middleware(['auth'])->name('reports');

    //leaves
    Route::get('/leaves-to-approve', [Leaves::class, 'leavesToApprove'])->middleware(['auth'])->name('leaves-to-approve');
    Route::post('leaves-to-approve/approve/{id}', [Leaves::class, 'approveLeave'])->name('leaves-to-approve.approveLeave');
    Route::post('leaves-to-approve/decline/{id}', [Leaves::class, 'declineLeave'])->name('leaves-to-approve.declineLeave');

    // holidays
    Route::get('/holidays', [HolidayController::class, 'create'])->middleware(['auth'])->name('holidays');
    Route::post('holidays', [HolidayController::class, 'store']);
    Route::get('/holidays-crud', [HolidayController::class, 'index'])->middleware(['auth'])->name('holidays-crud');
    Route::get('/holidays-crud/index', [HolidayController::class, 'index'])->name('holidays-crud.index');
    Route::delete('holidays-crud/{id}', [HolidayController::class, 'destroy'])->name('holidays-crud.destroy');
    Route::get('holidays-crud/restore/one/{id}', [HolidayController::class, 'restore'])->name('holidays-crud.restore');
    Route::get('holidays-crud/restore-all', [HolidayController::class, 'restoreAll'])->name('holidays-crud.restoreAll');
    Route::get('edit-holiday/{holiday}', [HolidayController::class, 'edit'])->name('edit-holiday');
    Route::put('holidays-crud/update/{holiday}', [HolidayController::class, 'update'])->name('holidays-crud.update');
});


Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [LeaveApplicationsController::class, 'show'])->name('dashboard');
Route::post('/leave-application', [LeaveApplicationsController::class, 'store'])->name('leave_application.store');
// Route::get('/calendar', function () {
//     return view('dashboard.calendar');
// })->middleware(['auth'])->name('calendar');

Route::get('/calendar', [CalendarController::class, 'index'])->middleware(['auth'])->name('calendar');
Route::get('/calendar-user', [CalendarController::class, 'show'])->middleware(['auth'])->name('calendar-user');

Route::get('/my-leaves', [Leaves::class, 'index'])->middleware(['auth'])->name('my-leaves');

Route::get('/my-account', function () {
    return view('dashboard.my-account');
})->middleware(['auth'])->name('my-account');


require __DIR__ . '/auth.php';
