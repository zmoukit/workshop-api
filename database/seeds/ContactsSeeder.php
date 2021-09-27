<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
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
              'name' => 'John Wick',
              'phone' => '+6588881111',
              'email' => 'john.wick@thecarsolutions.co',
            ),
            1 => 
            array (
              'name' => 'Ted',
              'phone' => '+6581234567',
              'email' => 'ted@thecarsolutions.co',
            ),
            2 => 
            array (
              'name' => 'Duke Kaboom',
              'phone' => '+6589000011',
              'email' => 'duke.kaboom@thecarsolutions.co',
            ),
          );

        foreach($records as $record) {
            Contact::firstOrCreate(
                [
                    'phone' => $record['phone'],
                ],
                [
                    'name' => $record['name'],
                    'phone' => $record['phone'],
                    'email' => $record['email'],
                ]
            );
        }
    }
}
