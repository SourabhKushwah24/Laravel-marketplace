<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $country = Country::create([
            'name' => 'India',
            'code' => 'IN',
            'slug' => 'india',
            'status' => true,
        ]);

        $delhi = $country->states()->create([
            'name' => 'Delhi',
            'slug' => 'delhi',
            'status' => true,
        ]);

        $newDelhi = $delhi->cities()->create([
            'name' => 'New Delhi',
            'slug' => 'new-delhi',
            'status' => true,
        ]);

        $areas = [
            'Rohini',
            'Dwarka',
            'Saket',
            'Laxmi Nagar',
            'Karol Bagh',
            'Pitampura',
        ];

        foreach ($areas as $area) {
            $newDelhi->areas()->create([
                'name' => $area,
                'slug' => Str::slug($area),
                'status' => true,
            ]);
        }

        $maharashtra = $country->states()->create([
            'name' => 'Maharashtra',
            'slug' => 'maharashtra',
            'status' => true,
        ]);

        $mumbai = $maharashtra->cities()->create([
            'name' => 'Mumbai',
            'slug' => 'mumbai',
            'status' => true,
        ]);

        $mumbaiAreas = [
            'Andheri',
            'Bandra',
            'Powai',
            'Borivali',
            'Dadar',
        ];

        foreach ($mumbaiAreas as $area) {
            $mumbai->areas()->create([
                'name' => $area,
                'slug' => Str::slug($area),
                'status' => true,
            ]);
        }
    }
}
