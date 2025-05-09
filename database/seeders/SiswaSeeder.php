<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        foreach (range(1, 10) as $index) {
            DB::table('siswa')->insert([
                'nama' => $faker->name,
                'nis' => 'NIS' . $faker->unique()->numerify('####'),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2010-12-31'),
                'alamat' => $faker->address,
                'no_telepon' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'guru_kelas_id' => null, // atau isi manual jika relasi tersedia
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
