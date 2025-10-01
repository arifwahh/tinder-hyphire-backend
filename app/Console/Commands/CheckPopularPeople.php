<?php
// app/Console/Commands/CheckPopularPeople.php

namespace App\Console\Commands;

use App\Models\Person;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckPopularPeople extends Command
{
    protected $signature = 'check:popular-people';
    protected $description = 'Check for people with more than 50 likes and send email to admin';

    public function handle(): void
    {
        $popularPeople = Person::where('like_count', '>', 50)->get();

        if ($popularPeople->isEmpty()) {
            $this->info('No popular people found with more than 50 likes.');
            return;
        }

        foreach ($popularPeople as $person) {
            try {
                Mail::send('emails.popular_person', ['person' => $person], function ($message) use ($person) {
                    $message->to('admin@tinderapp.com')
                            ->subject("Popular Person Alert: {$person->name} has {$person->like_count} likes!");
                });
                
                $this->info("Email sent for {$person->name} with {$person->like_count} likes");
            } catch (\Exception $e) {
                $this->error("Failed to send email for {$person->name}: {$e->getMessage()}");
            }
        }
    }
}