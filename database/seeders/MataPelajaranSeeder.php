<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1, 10) as $index) {
            DB::table('mata_pelajaran')->insert([
                'nama' => $faker->word,  // Nama mata pelajaran
                'guru_kelas_id' => $faker->randomElement([1, 2, 3, 4, null]), // Pilih id guru kelas yang ada, atau null jika tidak ada
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
