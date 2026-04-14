<?php

namespace App\Jobs;

use App\Mail\SendEmail;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class EmailJob implements ShouldQueue
{
    use Queueable;
    public $filename;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        // $this->filename = $file;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            // $this->comment('Sending email to: ' . $user->name);
            Mail::to('shubhamgaonkar@mailinator.com')->send(new SendEmail());

        }
        // Mail::to('shubhamgaonkar@mailinator.com')->send(new SendEmail());
    }
}
