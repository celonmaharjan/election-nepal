<?php

namespace Database\Seeders;

use App\Models\Constituency;
use App\Models\Province;
use Illuminate\Database\Seeder;

class ConstituencySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            1 => [ // Koshi
                'Jhapa' => 5, 'Morang' => 6, 'Sunsari' => 4, 'Ilam' => 2, 'Udayapur' => 2,
                'Taplejung' => 1, 'Panchthar' => 1, 'Sankhuwasabha' => 1, 'Tehrathum' => 1,
                'Bhojpur' => 1, 'Dhankuta' => 1, 'Solukhumbu' => 1, 'Khotang' => 1, 'Okhaldhunga' => 1
            ],
            2 => [ // Madhesh
                'Saptari' => 4, 'Siraha' => 4, 'Dhanusha' => 4, 'Mahottari' => 4,
                'Sarlahi' => 4, 'Rautahat' => 4, 'Bara' => 4, 'Parsa' => 4
            ],
            3 => [ // Bagmati
                'Kathmandu' => 10, 'Lalitpur' => 3, 'Chitwan' => 3, 'Kavrepalanchok' => 2,
                'Sindhupalchok' => 2, 'Nuwakot' => 2, 'Dhading' => 2, 'Bhaktapur' => 2,
                'Makwanpur' => 2, 'Sindhuli' => 2, 'Dolakha' => 1, 'Ramechhap' => 1, 'Rasuwa' => 1
            ],
            4 => [ // Gandaki
                'Kaski' => 3, 'Gorkha' => 2, 'Tanahun' => 2, 'Syangja' => 2, 'Baglung' => 2,
                'Nawalpur' => 2, 'Manang' => 1, 'Lamjung' => 1, 'Parbat' => 1, 'Mustang' => 1, 'Myagdi' => 1
            ],
            5 => [ // Lumbini
                'Rupandehi' => 5, 'Kapilvastu' => 3, 'Dang' => 3, 'Banke' => 3, 'Palpa' => 2,
                'Gulmi' => 2, 'Bardiya' => 2, 'Parasi' => 2, 'Arghakhanchi' => 1, 'Pyuthan' => 1,
                'Rolpa' => 1, 'Rukum East' => 1
            ],
            6 => [ // Karnali
                'Surkhet' => 2, 'Dailekh' => 2, 'Dolpa' => 1, 'Mugu' => 1, 'Humla' => 1,
                'Jumla' => 1, 'Kalikot' => 1, 'Jajarkot' => 1, 'Rukum West' => 1, 'Salyan' => 1
            ],
            7 => [ // Sudurpashchim
                'Kailali' => 5, 'Kanchanpur' => 3, 'Achham' => 2, 'Bajura' => 1, 'Bajhang' => 1,
                'Darchula' => 1, 'Baitadi' => 1, 'Dadeldhura' => 1, 'Doti' => 1
            ]
        ];

        foreach ($data as $provinceNumber => $districts) {
            $province = Province::where('number', $provinceNumber)->first();
            foreach ($districts as $districtName => $count) {
                for ($i = 1; $i <= $count; $i++) {
                    Constituency::updateOrCreate(
                        ['name' => "$districtName $i"],
                        [
                            'number' => $i,
                            'province_id' => $province->id,
                            'district' => $districtName,
                            'total_voters' => rand(40000, 160000),
                            'type' => 'FPTP'
                        ]
                    );
                }
            }
        }
    }
}
