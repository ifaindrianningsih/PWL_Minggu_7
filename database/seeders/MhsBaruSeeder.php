<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MhsBaruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mahasiswa')->insert([
            'email' => 'novita@gmail.com',
            'nim' => '2021920045',
            'nama' => 'Novita Dwi Ananta',
            'tgl_lahir' => '09 November 2002',
            'alamat' => 'Jombang',
            'kelas' => 'TK-4F',
            'jurusan' => 'Teknik Kimia'
        ]);
    }
}
