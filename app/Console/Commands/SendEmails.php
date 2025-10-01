<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to users';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // logic kirim email
        $this->info('Emails have been sent successfully!');
    }
}
