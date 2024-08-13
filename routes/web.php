<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
   return redirect()->route('login');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role_id == 1) {
        return redirect()->route('admin.dashboard');
    }elseif (auth()->user()->role_id == 2) {
        return redirect()->route('business-office.dashboard');
    }else{
        return redirect()->route('teacher.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

//business_office
Route::prefix('business-office')->middleware(['auth', 'verified'])->group(
    function(){
        Route::get('/dashboard', function(){
            return view('business-office.index');
        })->name('business-office.dashboard');
        Route::get('/enrollee', function(){
            return view('business-office.enrollee');
        })->name('business-office.enrollee');
        Route::get('/enrollee/{id}', function(){
            return view('business-office.enroll-student');
        })->name('business-office.enroll-student');
        Route::get('/students', function(){
            return view('business-office.students');
        })->name('business-office.students');
        Route::get('/statement-of-account', function(){
            return view('business-office.soa');
        })->name('business-office.soa');
        Route::get('/sales/transaction', function(){
            return view('business-office.sales-transaction');
        })->name('business-office.sales-transaction');
        Route::get('/sales/category', function(){
            return view('business-office.sales-category');
        })->name('business-office.sales-category');
        Route::get('/expense/transaction', function(){
            return view('business-office.expense-transaction');
        })->name('business-office.expense-transaction');
        Route::get('/expense/category', function(){
            return view('business-office.expense-category');
        })->name('business-office.expense-category');
        Route::get('/reports', function(){
            return view('business-office.reports');
        })->name('business-office.reports');
        Route::get('/sections', function(){
            return view('business-office.sections');
        })->name('business-office.sections');

        Route::get('/sections/{id}', function() {
            return view('business-office.section-manage');
        })->name('business-office.sections.manage');

    }
);



//teacher routes
Route::prefix('teacher')->middleware(['auth', 'verified'])->group(
    function(){
        Route::get('/enrollment', function(){
            return view('teacher.index');
        })->name('teacher.dashboard');
        Route::get('/enrollment/add', function(){
            return view('teacher.enrollment');
        })->name('teacher.enrollment');
        Route::get('/enrollment/record/{id}', function(){
            return view('teacher.record');
        })->name('teacher.record');
        Route::get('/enrolled-student', function(){
            return view('teacher.enrolled-student');
        })->name('teacher.enrolled-student');
    }
);



//admin routes
Route::prefix('administrator')->middleware('check_session')->group(
    function(){
        Route::get('/dashboard', function() {
            return view('admin.index');
        })->name('admin.dashboard');
        Route::get('/enrollee', function() {
            return view('admin.enrollee');
        })->name('admin.enrollee');
        Route::get('/students', function() {
            return view('admin.students');
        })->name('admin.students');
        Route::get('/students/{id}', function() {
            return view('admin.students-record');
        })->name('admin.students.record');

        Route::get('/enrollee/add', function() {
            return view('admin.enrollee-add');
        })->name('admin.enrollee-add');

        Route::get('/school-fee/other-payments', function() {
            return view('admin.other-payments');
        })->name('admin.other-payments');

        Route::get('/other-payments/{id}', function() {
            return view('admin.other-payment-students');
        })->name('admin.other-payment-students');

        Route::get('/enrollee/{id}', function() {
            return view('admin.enrollee.enroll');
        })->name('admin.enrollee.enroll');
        Route::get('/enrollee/shs/{id}', function() {
            return view('admin.enrollee.enroll-shs');
        })->name('admin.enrollee.enroll-shs');
        Route::get('/grade-level', function() {
            return view('admin.grade_level');
        })->name('admin.grade_level');
        Route::get('/school-fees', function() {
            return view('admin.school_fees');
        })->name('admin.school_fees');
        Route::get('/active-semester', function() {
            return view('admin.active-semester');
        })->name('admin.active-semester');
        Route::get('/subsidies', function() {
            return view('admin.subsidies');
        })->name('admin.subsidies');

        Route::get('/sections', function() {
            return view('admin.sections');
        })->name('admin.sections');
        Route::get('/sections/{id}', function() {
            return view('admin.section-manage');
        })->name('admin.sections.manage');

        //SOA
        Route::get('/SOA', function() {
            return view('admin.soa');
        })->name('admin.soa');

        //SALES && EXPENSES
        Route::get('/sales-transaction', function() {
            return view('admin.other.sales-transaction');
        })->name('admin.sales-transaction');
        Route::get('/expenses-transaction', function() {
            return view('admin.other.expenses-transaction');
        })->name('admin.expenses-transaction');

        //OTHERS
        Route::get('/sale-category', function() {
            return view('admin.other.sale-category');
        })->name('admin.sale-category');
        Route::get('/expenses-category', function() {
            return view('admin.other.expenses-category');
        })->name('admin.expenses-category');



        //SETTINGS
        Route::get('/settings/users', function() {
            return view('admin.settings.users');
        })->name('admin.settings.users');
        Route::get('/settings/school-year', function() {
            return view('admin.settings.school-year');
        })->name('admin.settings.school-year');

        //REPORTS
        Route::get('/reports', function() {
            return view('admin.reports');
        })->name('admin.reports');
    }
);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
