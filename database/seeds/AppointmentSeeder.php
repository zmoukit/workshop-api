<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aAppointment = [
            //Workshop 1 appointments
            [
                'workshop_id' => 1,
                'car_id' => 1,
                "start_time" => date('2021-09-19 10:00:00'),
                "end_time" => date('2021-09-19 12:15:00'),
            ],
            [
                'workshop_id' => 1,
                'car_id' => 2,
                "start_time" => date('2021-09-21 11:00:00'),
                "end_time" => date('2021-09-21 12:00:00'),
            ],
            [
                'workshop_id' => 1,
                'car_id' => 3,
                "start_time" => date('2021-09-23 09:00:00'),
                "end_time" => date('2021-09-23 11:15:00'),
            ],

            //Workshop 2 appointments
            [
                'car_id' => 2,
                'workshop_id' => 2,
                "start_time" => date('2021-09-10 13:00:00'),
                "end_time" => date('2021-09-10 14:00:00'),
            ],

            //Workshop 3 appointments
            [
                'car_id' => 3,
                'workshop_id' => 3,
                "start_time" => date('2021-09-10 13:00:00'),
                "end_time" => date('2021-09-10 14:00:00'),
            ],
        ];

        /**
         * Here i'm using the query builder to insert data in DB instead of ORM
         */
        DB::table('appointments')->insert($aAppointment);
    }
}
