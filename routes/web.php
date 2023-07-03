<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\TicketList;
use App\Http\Livewire\TicketForm;
use App\Http\Livewire\SupplierList;
use App\Http\Livewire\SupplierForm;

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
    return view('layouts.app');
});

Route::get('tickets', TicketList::class)->name('tickets.index');
Route::get('tickets/create', TicketForm::class)->name('tickets.create');
Route::get('tickets/{ticket}', TicketForm::class)->name('tickets.edit');

Route::get('suppliers', SupplierList::class)->name('suppliers.index');
Route::get('suppliers/create', SupplierForm::class)->name('suppliers.create');
Route::get('suppliers/{supplier}', SupplierForm::class)->name('suppliers.edit');

