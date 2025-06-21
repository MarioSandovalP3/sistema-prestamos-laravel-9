<?php
use App\Http\Livewire\Home;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Users;
use App\Http\Livewire\Asignar;
use App\Http\Livewire\Partners;
use App\Http\Livewire\Loans;
use App\Http\Livewire\Payments;
use App\Http\Livewire\Permisos;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Companies;

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


Route::get('/', function () {
    return redirect('/login');
});
Route::get('/404', function () {
return view('errors.404');
});
Auth::routes();

Route::middleware(['auth'])->group(function(){
Route::post('image/upload', [ImageController::class,'upload'])->name('image.upload');
		Route::group(['middleware' => ['role:Admin']], function () {
			Route::get('sys-admin/roles', Roles::class);
			Route::get('sys-admin/permisos', Permisos::class);
			Route::get('sys-admin/asignar', Asignar::class);
			
		});
	Route::get('sys-admin/company', Companies::class);	
	Route::get('receipt-loan/pdf/{id}', [Loans::class, 'receiptPDF']);
	Route::get('receipt-loan/email-pdf/{id}', [Loans::class, 'emailPDF']);
	Route::get('voucher/pdf/{id}', [Payments::class, 'voucherPDF']);
	Route::get('voucher/email-voucher/{id}', [Payments::class, 'emailVoucher']);
	Route::get('sys-admin/users', Users::class)->name('users');
	Route::get('sys-admin/home', Home::class);
	Route::get('sys-admin/partners', Partners::class)->name('partners');
	Route::get('sys-admin/loans', Loans::class)->name('loans');
	Route::get('sys-admin/payments', Payments::class)->name('payments');
	
});
