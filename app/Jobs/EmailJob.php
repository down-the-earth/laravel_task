<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class EmailJob implements ShouldQueue
{
    use Queueable;
    public $filename;

    /**
     * Create a new job instance.
     */
    public function __construct($file)
    {
        $this->filename = $file;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('gaonkars193@gmail.com')->send(new WelcomeEmail('Your post has been updated successfully!', $this->filename));
    }
}
