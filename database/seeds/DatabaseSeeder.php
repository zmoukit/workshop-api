<?php

use Illuminate\Database\Seeder;

use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        User::factory(10)->create();
        $this->call([
            ContactsSeeder::class,
            CarsSeeder::class,
            WorkshopsSeeder::class,
            AppointmentSeeder::class
        ]);
    }
}
