<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeFirstAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-first-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make the first registered user an admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $firstUser = \App\Models\User::orderBy('created_at', 'asc')->first();
        
        if (!$firstUser) {
            $this->error('No users found in the system.');
            return;
        }

        if ($firstUser->is_admin) {
            $this->info("User {$firstUser->name} is already an admin.");
            return;
        }

        $firstUser->is_admin = true;
        $firstUser->save();

        $this->info("User {$firstUser->name} ({$firstUser->email}) is now an admin.");
    }
}
