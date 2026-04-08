<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\ApartmentImage;

class ApartmentImageSeeder extends Seeder
{
    public function run(): void
    {
        $apartments = Apartment::all();

        foreach ($apartments as $apartment) {

            $sourceFolder = database_path("seeders/images/apartments/{$apartment->id}");

            if (!is_dir($sourceFolder)) {
                continue;
            }

            $destinationFolder = storage_path("app/public/apartments/{$apartment->id}");

            if (file_exists($destinationFolder)) {
                array_map('unlink', glob($destinationFolder . '/*'));
            } else {
                mkdir($destinationFolder, 0777, true);
            }

            ApartmentImage::where('apartment_id', $apartment->id)->delete();

            $files = array_values(array_diff(scandir($sourceFolder), ['.', '..']));
            sort($files);

            $position = 1;

            foreach ($files as $file) {

                $sourcePath = $sourceFolder . '/' . $file;

                if (!is_file($sourcePath)) {
                    continue;
                }

                copy($sourcePath, $destinationFolder . '/' . $file);

                ApartmentImage::create([
                    'apartment_id' => $apartment->id,
                    'path' => "apartments/{$apartment->id}/{$file}",
                    'position' => $position,
                    'is_cover' => $position === 1,
                ]);

                $position++;
            }
        }
    }
}
