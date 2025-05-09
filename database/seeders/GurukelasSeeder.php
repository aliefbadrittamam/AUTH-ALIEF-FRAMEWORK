<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GurukelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Ahmad Fauzi', 'nip' => '198001011001', 'kelas' => '1A'],
            ['nama' => 'Siti Nurhaliza', 'nip' => '198002021002', 'kelas' => '1B'],
            ['nama' => 'Budi Santoso', 'nip' => '198103031003', 'kelas' => '2A'],
            ['nama' => 'Dewi Lestari', 'nip' => '198104041004', 'kelas' => '2B'],
            ['nama' => 'Yanto Prasetyo', 'nip' => '198105051005', 'kelas' => '3A'],
            ['nama' => 'Rina Melati', 'nip' => '198106061006', 'kelas' => '3B'],
            ['nama' => 'Agus Salim', 'nip' => '198107071007', 'kelas' => '4A'],
            ['nama' => 'Lina Marlina', 'nip' => '198108081008', 'kelas' => '4B'],
            ['nama' => 'Tono Subekti', 'nip' => '198109091009', 'kelas' => '5A'],
            ['nama' => 'Sulastri', 'nip' => '198110101010', 'kelas' => '5B'],
        ];

        DB::table('guru_kelas')->insert($data);
    }
}
