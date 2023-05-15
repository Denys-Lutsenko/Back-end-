<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestbookController;

Route::get('/', [GuestbookController::class, 'execute'])->name('guestbook.execute');
Route::post('/', [GuestbookController::class, 'store'])->name('guestbook.execute.post');

?>
