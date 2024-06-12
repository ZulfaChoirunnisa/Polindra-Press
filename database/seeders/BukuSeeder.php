<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Pengaju;
use App\Models\Penulis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penulis = Penulis::create([
            'nama' => 'Asep',
            'noTelepon' => '0987654321',
            'alamat' => 'indramayu',
        ]);
        $faker = \Faker\Factory::create();
        $pengaju = Pengaju::pluck('id')->first();

        for ($i = 0; $i < 10; $i++) {
            Buku::create([
                'penulis_id' => $penulis->id,
                'pengaju_id' => $pengaju,
                'judul' => $faker->sentence,
                'jumlahHalaman' => $faker->numberBetween(50, 500),
                'daftarPustaka' => $faker->sentence,
                'resensi' => $faker->sentence,
                'suratKeaslian' => $faker->sentence,
                'coverBuku' => $faker->imageUrl(),
                'tahunTerbit' => $faker->year,
                'harga' => $faker->randomNumber(5),
                'noProduk' => $faker->optional()->numerify('N#####'),
                'isbn' => $faker->optional()->isbn10,
                'status' => $faker->randomElement(['pending', 'accept', 'revisi', 'tolak']),
                'statusUpload' => $faker->randomElement(['belum upload', 'sudah upload']),
                'publish' => 'non_publish',
                'adminComment' => null,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }
    }
}
