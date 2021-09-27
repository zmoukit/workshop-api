<?php

namespace Database\Seeders;
use App\Models\Contact;
use App\Models\Car;
use Illuminate\Database\Seeder;

class CarsSeeder extends Seeder
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
              'make' => 'Honda',
              'model' => 'Accord',
              'engine_number' => 'R94LKGYL36TE8ARFJWSPAQSW',
              'chassis_number' => 'N9DAPCDVGBGHVKTKZF44CVPB',
              'contact_phone' => '+6588881111',
              'latitude' => '1.3336024',
              'longitude' => '103.7411853',
            ),
            1 => 
            array (
              'make' => 'Toyota',
              'model' => 'Corolla',
              'engine_number' => 'T8ZSLDPD3G8NRVPVUKSBPSZQ',
              'chassis_number' => 'YT243UHRN4CAVCYNBT2FL63E',
              'contact_phone' => '+6581234567',
              'latitude' => '1.3006074',
              'longitude' => '103.9091933',
            ),
            2 => 
            array (
              'make' => 'BMW',
              'model' => '730i',
              'engine_number' => 'MR98B7E57BVUPTUYP5W9FNZ2',
              'chassis_number' => '2J4D7BEQJ4RVC5YXWX8Q3AQW',
              'contact_phone' => '+6589000011',
              'latitude' => '1.3703204',
              'longitude' => '103.8474203',
            ),
        );
        foreach($records as $record) {
            $contact = Contact::where([
                'phone' => $record['contact_phone']
            ])->first();

            if(!$contact) {
                throw new Exception("Contact no found");
            }

            Car::firstOrCreate(
                [
                    'engine_number' => $record['engine_number'],
                    'chassis_number' => $record['chassis_number'],
                ],
                [
                    'contact_id' => $contact->id,
                    'make' => $record['make'],
                    'model' => $record['model'],
                    'engine_number' => $record['engine_number'],
                    'chassis_number' => $record['chassis_number'],
                    'latitude' => $record['latitude'],
                    'longitude' => $record['longitude'],
                ]
            );
        }
    }
}
