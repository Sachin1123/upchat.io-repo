<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\ChatController;

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceTicketController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\CompanyController;



use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerLeadController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\Customer\CustomerContactController;
use App\Http\Controllers\Customer\CustomerServiceTicketController;
use App\Http\Controllers\Customer\CustomerReportController;






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
Route::get('logout', function ()
{
    Auth::logout();
    return redirect('/admin');
 
});

Route::get('home', function ()
{
    Auth::logout();
   return redirect('/admin');
});


Route::any('admin/change-password', [ProfileController::class, 'passwordChange'])->name('passwordChange');
Route::prefix('admin')->group(function ()
{
    Route::get('/', function ()
    {
        return view('admin.login');
    })->middleware(['guest']);
    ;
    Route::get('/forgotPassword', function ()
    {
        return view('admin.forgotPassword');
    })->middleware(['guest']);

    Route::group(['middleware' => ['role:Staff' ]], function ()
    {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::get('/apex-detail/{id}', [UserController::class, 'apexDetails']);
        Route::any('/apex-detail-update/{id}', [UserController::class, 'apexUpdate'])->name('apexUpdate');
        Route::resource('leads', LeadController::class);
        Route::resource('chats', ChatController::class);

        Route::resource('contacts', ContactController::class);
        Route::resource('settings', SettingController::class);
        Route::resource('profile', ProfileController::class);
        Route::resource('service-tickets', ServiceTicketController::class);
        Route::resource('reports', ReportController::class);
        Route::any('/pdfDownload', [ReportController::class, 'pdfDownload'])->name('pdfDownload');
        Route::any('ajaxDashboard', [DashboardController::class, 'ajaxDashboard'])->name('ajaxDashboard');
        Route::any('changeStatus', [LeadController::class, 'changeStatus'])->name('changeStatus');
        Route::get('ajaxEdit', [LeadController::class, 'ajaxEdit'])->name('ajaxEdit');
        Route::any('invalidStatus', [LeadController::class, 'invalidStatus'])->name('invalidStatus');
        Route::any('ajaxBar', [DashboardController::class, 'ajaxBar'])->name('ajaxBar');
        Route::resource('company', CompanyController::class);
        Route::resource('email-templates', EmailTemplateController::class);






    
    });
    Route::group(['middleware' => ['role:Admin' ]], function ()
    {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::get('/apex-detail/{id}', [UserController::class, 'apexDetails']);
        Route::any('/apex-detail-update/{id}', [UserController::class, 'apexUpdate'])->name('apexUpdate');
        Route::resource('leads', LeadController::class);
        Route::resource('chats', ChatController::class);

        Route::resource('contacts', ContactController::class);
        Route::resource('settings', SettingController::class);
        Route::resource('profile', ProfileController::class);
        Route::resource('service-tickets', ServiceTicketController::class);
        Route::resource('email-templates', EmailTemplateController::class);
        Route::resource('company', CompanyController::class);

        Route::resource('reports', ReportController::class);
        Route::any('/pdfDownload', [ReportController::class, 'pdfDownload'])->name('pdfDownload');
        Route::any('ajaxDashboard', [DashboardController::class, 'ajaxDashboard'])->name('ajaxDashboard');
        Route::any('changeStatus', [LeadController::class, 'changeStatus'])->name('changeStatus');
        Route::get('ajaxEdit', [LeadController::class, 'ajaxEdit'])->name('ajaxEdit');
        Route::any('invalidStatus', [LeadController::class, 'invalidStatus'])->name('invalidStatus');
        Route::any('ajaxBar', [DashboardController::class, 'ajaxBar'])->name('ajaxBar');
       


    });
 
});

Route::prefix('customer')->group(function ()
{
    Route::get('/', function ()
    {
        return view('customer.login');
    })->middleware(['guest']);
    ;
    Route::get('/forgotPassword', function ()
    {
        return view('customer.forgotPassword');
    })->middleware(['guest']);

    Route::group(['middleware' => ['role:Customer' ]], function ()
    {
        Route::get('dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
        Route::resource('customer-leads', CustomerLeadController::class);
        Route::resource('customer-profile', CustomerProfileController::class);
        Route::resource('customer-contacts', CustomerContactController::class);
        Route::resource('customer-service-tickets', CustomerServiceTicketController::class);
        Route::resource('customer-reports', CustomerReportController::class);
        Route::any('changeStatus', [CustomerLeadController::class, 'changeStatus'])->name('customerChangeStatus');
        Route::get('ajaxEdit', [CustomerLeadController::class, 'ajaxEdit'])->name('customerAjaxEdit');
        Route::any('invalidStatus', [CustomerLeadController::class, 'invalidStatus'])->name('customerInvalidStatus');
        Route::any('ajaxDashboard', [CustomerDashboardController::class, 'ajaxDashboard'])->name('customerAjaxDashboard');
        Route::any('/pdfDownload', [CustomerReportController::class, 'pdfDownload'])->name('customerPdfDownload');
        Route::any('customerAjaxBar', [CustomerDashboardController::class, 'customerAjaxBar'])->name('customerAjaxBar');
        Route::any('company-details', [CustomerProfileController::class, 'companyDetails'])->name('companyDetails');


    });
 
 
});

Route::prefix('')->group(function ()
{
    Route::get('register', function ()
    {
        return redirect('/register');
    });

    Route::get('{any}', function ()
    {
        return redirect('/admin');
    })->where('any', '.*');
});


Auth::routes([
    'register' => true
]);
