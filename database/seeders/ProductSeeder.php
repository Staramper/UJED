<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'prd_business'=> 1,
            'prd_picture' => '001001.png',
            'prd_title'   => 'Mochila',
            'prd_desc'    => 'Mochila con logotipo de la UJED',
            'prd_details' => 'Hecha de tela y color azul claro',
            'prd_price'   => '175.00',
            'prd_status'  => '01',
            'prd_type'    => '5',
        ]);

        \App\Models\Product::create([
            'prd_business'=> 1,
            'prd_picture' => '001002.png',
            'prd_title'   => 'Chamarra',
            'prd_desc'    => 'Chamara universitaria con logotipo de la UJED',
            'prd_details' => 'Hecha de algodon y color rojo con blanco',
            'prd_price'   => '320.00',
            'prd_status'  => '01',
            'prd_type'    => '2',
        ]);

        \App\Models\Product::create([
            'prd_business'=> 1,
            'prd_picture' => '002003.png',
            'prd_title'   => 'Termo',
            'prd_desc'    => 'Termo con logotipo de la UJED',
            'prd_details' => 'Termo metalico termico tipo vaso',
            'prd_price'   => '225',
            'prd_status'  => '01',
            'prd_type'    => '3',
        ]);

        \App\Models\Product::create([
            'prd_business'=> 1,
            'prd_picture' => '002004.png',
            'prd_title'   => 'Playera',
            'prd_desc'    => 'Playera tipo polo con logotipo de la UJED',
            'prd_details' => 'Hecha de algodon y color rojo',
            'prd_price'   => '180.00',
            'prd_status'  => '01',
            'prd_type'    => '2',
        ]);
    }
}
