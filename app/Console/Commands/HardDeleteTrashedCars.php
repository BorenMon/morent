<?php

namespace App\Console\Commands;

use App\Models\Car;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class HardDeleteTrashedCars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cars:hard-delete-trashed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Permanently delete soft-deleted cars';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cars = Car::onlyTrashed()->get();

        if ($cars->isEmpty()) {
            $this->info('No soft-deleted cars found.');
            return;
        }

        $this->info("Deleting " . $cars->count() . " soft-deleted cars...");

        foreach ($cars as $car) {
            try {
                // MinIO disk name (change 's3' to whatever disk you're using)
                $disk = Storage::disk('s3');

                if ($car->card_image) {
                    $disk->delete($car->card_image);
                    $this->info("Deleted file: {$car->card_image}");
                }

                foreach ($car->images as $file) {
                    $disk->delete($file);
                    $this->info("Deleted file: {$file}");
                }

                // Hard delete the car
                $car->forceDelete();
                $this->info("Deleted car ID: {$car->id}");
            } catch (\Exception $e) {
                $this->error("Failed to delete car ID: {$car->id}. Error: " . $e->getMessage());
            }
        }

        $this->info("All soft-deleted cars and their files have been removed.");
    }
}
