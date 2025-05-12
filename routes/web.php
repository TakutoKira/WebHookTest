<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

Route::get('/', [WebhookController::class, 'index'])->name('webhook.index');
Route::post('/webhook/send', [WebhookController::class, 'send'])->name('webhook.send');
