<?php

use App\Http\Controllers\Admincontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\MdiIcons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\Menu_agendaController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SesiController;

// Main Page Route
Route::get('/', [Analytics::class, 'index'])->name('dashboard-analytics');

Route::middleware(['guest'])->group(function () {
  Route::get('/', [SesiController::class, 'index'])->name('login');
  Route::post('/', [SesiController::class, 'login']);
});
Route::get('/home', function () {
  return redirect('/admin');
});

Route::middleware(['auth'])->group(function () {
  Route::get('/admin', [Admincontroller::class, 'index']);
  Route::get('/admin/pengguna', [Admincontroller::class, 'pengguna'])->middleware('userAkses:pengguna');
  Route::get('/admin/sekretaris', [Admincontroller::class, 'sekretaris'])->middleware('userAkses:sekretaris');
  Route::get('/logout', [SesiController::class, 'logout']);
});

// Tambahkan rute user lainnya di sini

// Route::get('/', function() {
//   return view('content.dashboard.dashboards-analytics');
// });

// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name(
  'pages-account-settings-account'
);
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name(
  'pages-account-settings-notifications'
);
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name(
  'pages-account-settings-connections'
);
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name(
  'pages-misc-under-maintenance'
);

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/icons-mdi', [MdiIcons::class, 'index'])->name('icons-mdi');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');

// Route::get('/user', function () {
//   $user = [
//     ['id' => '1', 'username' => 'Dimitri'],
//     ['id' => '2', 'username' => 'Vincent'],
//     ['id' => '3', 'username' => 'Harringtin'],
//     ['id' => '4', 'username' => 'DI'],
//     ['id' => '5', 'username' => 'beer'],
//   ];
//   return view('user', compact('users'));
// })->name('user');

// Sub menu departemen without conttroller
// Route::gett('/Departemen' . [Departemen::class, 'index']) ->name('Departemen');
Route::get('/Departemen', function () {
  $users = [
    ['id' => '1', 'username' => 'Dimitri'],
    ['id' => '2', 'username' => 'Vincent'],
    ['id' => '3', 'username' => 'Harringtin'],
    ['id' => '4', 'username' => 'DI'],
    ['id' => '5', 'username' => 'beer'],
  ];
  $departments = [
    ['id' => '1', 'Departemen' => 'Dimitri'],
    ['id' => '2', 'Departemen' => 'Vincent'],
    ['id' => '3', 'Departemen' => 'Harringtin'],
    ['id' => '4', 'Departemen' => 'DI'],
    ['id' => '5', 'Departemen' => 'beer'],
  ];
  return view('Departemen', compact('departments', 'users'));
  // dd($departments);
})->name('Departemen');

Route::get('/MenuAgenda', [Menu_agendaController::class, 'index'])->name('menuagenda.index');
Route::post('/MenuAgenda', [Menu_agendaController::class, 'store'])->name('menuagenda.store');
Route::put('/menu_agenda/{id}', [Menu_agendaController::class, 'update'])->name('menu_agenda.update');
Route::delete('/menu_agenda/{id}', [Menu_agendaController::class, 'destroy'])->name('menu_agenda.destroy');
// Route::resource('menuagenda', Menu_agendaController::class)->middleware('auth');
// Route::get('menuagenda/{menu_agenda}', [Menu_agendaController::class, 'show'])->middleware('CheckAgendaAccess');


Route::get('/manage-user', [UserController::class, 'index'])->name('user.index');
Route::post('/manage-user', [UserController::class, 'store'])->name('user.store');
Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
Route::put('/schedule/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
Route::get('/status', [StatusController::class, 'index'])->name('status.index');
Route::post('/status', [StatusController::class, 'store'])->name('status.store');
Route::put('/status/update', [StatusController::class, 'update'])->name('status.update');
Route::delete('/status/{id}', [StatusController::class, 'destroy'])->name('status.destroy');
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::get('/Departemen', [DepartemenController::class, 'index'])->name('departemen.index');
Route::post('/Departemen', [DepartemenController::class, 'store'])->name('departemen.store');
Route::put('/departemen/{id}', [DepartemenController::class, 'update'])->name('departemen.update');
Route::delete('/departemen/{id}', [DepartemenController::class, 'destroy'])->name('departemen.destroy');
Route::get('/list-agenda/{id_schedule}', [ScheduleController::class, 'list_agenda'])->name('list_agenda_schedule');
