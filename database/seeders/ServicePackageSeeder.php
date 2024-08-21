<?php

namespace Database\Seeders;

use App\Models\ServicePackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicePackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =
            [
                [
                    "name" => "Paket Nelpon Tiga Harian x d'Masiv",
                    "description" => "1. 310 min onnet,2. 25 min all opr,3. Benefit NSP Artis 6 (Noah)",
                    "price" => 20500,
                ],
                [
                    "name" => "Add On Nonton",
                    "description" => "Kuota Nonton 10GB berlaku 30 hari,Kuota Nonton dapat digunakan saat mengakses aplikasi YouTube, MAXstream, TikTok, Disney+ Hotstar, Prime Video, CATCHPLAY+, Lionsgate Play, Netflix, Genflix, HBO GO, Sushiroll, Snack Video, TrueID, IndiHome TV, Vidio, Vision+, VIU, WETV (tidak termasuk langganan)",
                    "price" => 32000,
                ],
                [
                    "name" => "Youtube Premium Promo",
                    "description" => "Pelanggan dapat berhenti langganan paket YouTube Premium kapanpun dengan mengakses pengaturan langganan di MyTelkomsel pada Menu Paket dan Berlangganan pada bagian Layanan Digital atau melalui halaman pengaturan di https://tsel.id/ytcancel",
                    "price" => 25000,
                ],
            ];

        foreach ($data as $dt) {
            ServicePackage::create($dt);
        }
    }
}
