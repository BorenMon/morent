<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class HardDeleteTrashedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:hard-delete-trashed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permanently delete soft-deleted users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deletedUsers = User::onlyTrashed()->get();
        foreach ($deletedUsers as $user) {
            $user->forceDelete();
        }

        $this->info('Trashed users have been permanently deleted.');
    }
}
