<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PastelesEventosSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $items = [
            ['evento'=>'boda.jpg','nombre'=>'Pastel para Boda'],
            ['evento'=>'evento.jpg','nombre'=>'Pastel para Evento 1'],
            ['evento'=>'evento2.jpg','nombre'=>'Pastel para Evento 2'],
            ['evento'=>'fiesta.jpg','nombre'=>'Pastel de Fiesta'],
            ['evento'=>'fest3.jpg','nombre'=>'Pastel Festivo 3'],
            ['evento'=>'fiesta2.jpg','nombre'=>'Pastel de Fiesta 2'],
            ['evento'=>'aniversario.jpg','nombre'=>'Pastel de Aniversario'],
            ['evento'=>'quequitos.jpg','nombre'=>'Quequitos / Cupcakes'],
            ['evento'=>'evento3.jpg','nombre'=>'Pastel para Evento 3'],
            ['evento'=>'evento4.jpg','nombre'=>'Pastel para Evento 4'],
            ['evento'=>'evento5.jpg','nombre'=>'Pastel para Evento 5'],
            ['evento'=>'evento6.jpg','nombre'=>'Pastel para Evento 6'],
            ['evento'=>'evento7.jpg','nombre'=>'Pastel para Evento 7'],
            ['evento'=>'evento8.jpg','nombre'=>'Pastel para Evento 8'],
            ['evento'=>'evento9.jpg','nombre'=>'Pastel para Evento 9'],
            ['evento'=>'evento10.jpg','nombre'=>'Pastel para Evento 10'],
            ['evento'=>'evento11.jpg','nombre'=>'Pastel para Evento 11'],
            ['evento'=>'evento12.jpg','nombre'=>'Pastel para Evento 12'],
            ['evento'=>'evento13.jpg','nombre'=>'Pastel para Evento 13'],
            ['evento'=>'evento14.jpg','nombre'=>'Pastel para Evento 14'],
            ['evento'=>'evento15.jpg','nombre'=>'Pastel para Evento 15'],
            ['evento'=>'felicidadesalan.jpg','nombre'=>'Pastel Felicidades Alan'],
            ['evento'=>'felicidadesian.jpg','nombre'=>'Pastel Felicidades Ian'],
            ['evento'=>'felizcumplerosasazulles.jpg','nombre'=>'Pastel Feliz Cumple (azul)'],
            ['evento'=>'felizcumple.jpg','nombre'=>'Pastel Feliz Cumpleaños'],
            ['evento'=>'pastel de pony.jpg','nombre'=>'Pastel de Pony'],
            ['evento'=>'pstelbely.jpg','nombre'=>'Pastel Bely'],
            ['evento'=>'quequitos colores.jpg','nombre'=>'Quequitos de Colores'],
            ['evento'=>'pastelfrozen.jpg','nombre'=>'Pastel Frozen'],
            ['evento'=>'pastelmasha_oso.jpg','nombre'=>'Pastel Masha y el Oso'],
        ];

        foreach ($items as $it) {
            DB::table('productos')->insert([
                'id_subcategoria' => 2, // tu subcategoría de eventos
                'nombre'          => $it['nombre'],
                'descripcion'     => null,
                'imagen'          => 'img/pasteles/eventos/' . $it['evento'],
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);
        }
    }
}
