<?php

namespace Database\Seeders;

use App\Models\PaketLayanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaketlayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =
            [
                [
                    "nama_paket" => "Paket Nelpon Tiga Harian x d'Masiv",
                    "deskripsi" => "1. 310 min onnet,2. 25 min all opr,3. Benefit NSP Artis 6 (Noah)",
                    "harga" => 20500,
                ],
                [
                    "nama_paket" => "Add On Nonton",
                    "deskripsi" => "Kuota Nonton 10GB berlaku 30 hari,Kuota Nonton dapat digunakan saat mengakses aplikasi YouTube, MAXstream, TikTok, Disney+ Hotstar, Prime Video, CATCHPLAY+, Lionsgate Play, Netflix, Genflix, HBO GO, Sushiroll, Snack Video, TrueID, IndiHome TV, Vidio, Vision+, VIU, WETV (tidak termasuk langganan)",
                    "harga" => 32000,
                ],
                [
                    "nama_paket" => "Youtube Premium Promo",
                    "deskripsi" => "Pelanggan dapat berhenti langganan paket YouTube Premium kapanpun dengan mengakses pengaturan langganan di MyTelkomsel pada Menu Paket dan Berlangganan pada bagian Layanan Digital atau melalui halaman pengaturan di https://tsel.id/ytcancel",
                    "harga" => 25000,
                ],
            ];

        foreach ($data as $dt) {
            PaketLayanan::create($dt);
        }
    }
}
