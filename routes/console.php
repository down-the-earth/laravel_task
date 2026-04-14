<?php

use App\Console\Commands\SendEmails;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(SendEmails::class)->EveryFiveSeconds();

// Artisan::command(SendEmails::class, function () {
//     $this->comment('Sending emails to users...');
// })->describe('Send emails to users');
// Artisan::command(SendEmails::class)->describe('Send emails to users');