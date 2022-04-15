<?php

namespace Database\Seeders;

use App\Models\Taxa;
use App\Models\Tipo_qr;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
     
         \App\Models\User::factory(1)->create();

         $taxa = Taxa::count();
         $tipo_qr = Tipo_qr::count();
         if($taxa == 0) {
             Taxa::create([
                 'vc_taxa'=> 'Artigo 24',
                 'fl_valor'=> 3,
                 'it_estado'=> 1,
             ]);
             Taxa::create([
                 'vc_taxa'=> 'D.L',
                 'fl_valor'=> 0.10,
                 'it_estado'=> 1,
             ]);
             Taxa::create([
                 'vc_taxa'=> 'Artigo 4',
                 'fl_valor'=> 0.055,
                 'it_estado'=> 1,
             ]);
             Taxa::create([
                 'vc_taxa'=> 'Selo',
                 'fl_valor'=> 0.03465,
                 'it_estado'=> 1,
             ]);
             Taxa::create([
                 'vc_taxa'=> 'Taxa de Vistoria',
                 'fl_valor'=> 2024,
                 'it_estado'=> 1,
             ]);
         }
         if($tipo_qr == 0) {
             Tipo_qr::create([
                 'vc_tipo'=> 'Estabelecimentos',
                 'fl_valor'=> 4638.56,
                 'it_estado'=> 1,
             ]);
             Tipo_qr::create([
                 'vc_tipo'=> 'Outdoors',
                 'fl_valor'=> 7454.78,
                 'it_estado'=> 1,
             ]);
         }
    }
}


 

