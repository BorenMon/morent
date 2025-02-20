<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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
        $users = User::onlyTrashed()->get();

        if ($users->isEmpty()) {
            $this->info('No soft-deleted users found.');
            return;
        }

        $this->info("Deleting " . $users->count() . " soft-deleted users...");

        foreach ($users as $user) {
            try {
                // MinIO disk name (change 's3' to whatever disk you're using)
                $disk = Storage::disk('s3');

                // List of file fields to delete
                $filesToDelete = [
                    $user->avatar,
                    $user->driving_license,
                    $user->id_card,
                ];

                foreach ($filesToDelete as $file) {
                    if ($file) {
                        $disk->delete($file);
                        $this->info("Deleted file: {$file}");
                    }
                }

                // Hard delete the user
                $user->forceDelete();
                $this->info("Deleted user ID: {$user->id}");
            } catch (\Exception $e) {
                $this->error("Failed to delete user ID: {$user->id}. Error: " . $e->getMessage());
            }
        }

        $this->info("All soft-deleted users and their files have been removed.");
    }
}
