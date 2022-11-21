<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{

    /*
     *
     * $table->id();
            $table->integer('book_id');
            $table->integer('user_id');
            $table->string('status', 1)->default("T");
            $table->dateTime('extended_date')->nullable();
            $table->dateTime('returned_date')->nullable();
            $table->timestamps();*/
    public function run()
    {
        Reservation::factory()->create([
            'book_id' => 1,
            'user_id' => 3,
            'status' => 'T',
            'created_at' => '2022-11-21'
        ]);
        Reservation::factory()->create([
            'book_id' => 2,
            'user_id' => 7,
            'status' => 'T',
            'created_at' => '2022-11-23'
        ]);
        Reservation::factory()->create([
            'book_id' => 3,
            'user_id' => 3,
            'status' => 'T',
            'created_at' => '2022-11-22'
        ]);

        Reservation::factory()->create([
            'book_id' => 3,
            'user_id' => 4,
            'status' => 'E',
            'created_at' => '2022-10-30',
            'extended_date' => '2022-11-22'
        ]);
        Reservation::factory()->create([
            'book_id' => 2,
            'user_id' => 6,
            'status' => 'E',
            'created_at' => '2022-10-15',
            'extended_date' => '2022-11-14'
        ]);
        Reservation::factory()->create([
            'book_id' => 1,
            'user_id' => 5,
            'status' => 'E',
            'created_at' => '2022-10-22',
            'extended_date' => '2022-11-20'
        ]);

        Reservation::factory()->create([
            'book_id' => 2,
            'user_id' => 3,
            'status' => 'R',
            'created_at' => '2022-08-15',
            'extended_date' => '2022-09-10',
            'returned_date' => '2022-10-02',

        ]);
        Reservation::factory()->create([
            'book_id' => 1,
            'user_id' => 4,
            'status' => 'R',
            'created_at' => '2022-09-12',
            'returned_date' => '2022-10-02',
        ]);
        Reservation::factory()->create([
            'book_id' => 3,
            'user_id' => 5,
            'status' => 'R',
            'created_at' => '2022-09-01',
            'extended_date' => '2022-09-30',
            'returned_date' => '2022-10-10',
        ]);
        Reservation::factory()->create([
            'book_id' => 1,
            'user_id' => 6,
            'status' => 'R',
            'created_at' => '2022-08-11',
            'returned_date' => '2022-09-05',
        ]);
        Reservation::factory()->create([
            'book_id' => 3,
            'user_id' => 7,
            'status' => 'R',
            'created_at' => '2022-01-03',
            'extended_date' => '2022-02-01',
            'returned_date' => '2022-03-02',
        ]);

    }
}
