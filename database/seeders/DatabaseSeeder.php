<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AboutSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\FavIconSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\SocialmediaSeeder;
use Database\Seeders\SitesettingSeeder;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\FaqSeeder;
use Database\Seeders\ProvinceSeeder;
use Database\Seeders\DistrictSeeder;
use Database\Seeders\LocalGovernmentSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            SocialmediaSeeder::class,
            SitesettingSeeder::class,
            FavIconSeeder::class,
            CategorySeeder::class,
            AboutSeeder::class,
            FaqSeeder::class,
            ProvinceSeeder::class,
            DistrictSeeder::class,
            LocalGovernmentSeeder::class,

        ]);
    }
}
