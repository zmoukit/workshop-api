<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Workshop;
class WorkshopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = array (
            0 => 
            array (
              'name' => 'Fengshan Workshop',
              'phone' => '+6561231234',
              'latitude' => '1.3322664',
              'longitude' => '103.9364883',
              'opening_time' => '09:00',
              'closing_time' => '13:00',
            ),
            1 => 
            array (
              'name' => '724 Ang Mo Kio Workshop',
              'phone' => '+6566668888',
              'latitude' => '1.3721404',
              'longitude' => '103.8445973',
              'opening_time' => '12:00',
              'closing_time' => '16:00',
            ),
            2 => 
            array (
              'name' => 'Bukit Timah Workshop',
              'phone' => '+6561002000',
              'latitude' => '1.3404994',
              'longitude' => '103.7740163',
              'opening_time' => '14:00',
              'closing_time' => '18:00',
            ),
        );
        foreach($records as $record) {
            Workshop::firstOrCreate(
                [
                    'phone' => $record['phone'],
                ],
                [
                    'name' => $record['name'],
                    'phone' => $record['phone'],
                    'latitude' => $record['latitude'],
                    'longitude' => $record['longitude'],
                    'opening_time' => $record['opening_time'],
                    'closing_time' => $record['closing_time'],
                ]
            );
        }
    }
}
