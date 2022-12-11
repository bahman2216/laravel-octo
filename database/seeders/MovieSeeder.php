<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* DB::table('movie')->delete();

        Movie::create( array(
            'all'           =>  'all',
            'your'          =>  'your',
            'stuff'         =>  'stuff',
        ) )->genre()->attach( $idOfYourBeta ); */
    }
}
