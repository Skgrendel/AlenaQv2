<?php

namespace Database\Seeders;

use App\Models\encabezados_dets;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Encabezados_DetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Campos a seleccionar en las diferentes opciones de registro
        encabezados_dets::create([
            'encabezados_id' => '1',
            'nombre' => 'Cedula de Ciudadania',
            'nomenclatura'=>'CC'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '1',
            'nombre' => 'Permiso de Permanencia',
            'nomenclatura'=>'PPT'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '2',
            'nombre' => 'Activo',
            'nomenclatura'=>'AC'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '2',
            'nombre' => 'Inactivo',
            'nomenclatura'=>'IN'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '2',
            'nombre' => 'Pendiente',
            'nomenclatura'=>'PD'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '2',
            'nombre' => 'Revisado',
            'nomenclatura'=>'RV'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '2',
            'nombre' => 'Rechazado',
            'nomenclatura'=>'RC'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Sin Anomalias',
            'nomenclatura'=>'NA'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Bypass',
            'nomenclatura'=>'BY'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor con sellos manipulados',
            'nomenclatura'=>'MCSM'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor con digitos desalineados',
            'nomenclatura'=>'MCDD'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor sin talco',
            'nomenclatura'=>'MST'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor enterrado',
            'nomenclatura'=>'ME'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Conexión directa',
            'nomenclatura'=>'CD'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor frenado',
            'nomenclatura'=>'MF'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor gira hacia atrás',
            'nomenclatura'=>'MGHA'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor fuera de ruta',
            'nomenclatura'=>'MFR'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Medidor trocado',
            'nomenclatura'=>'MT'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '3',
            'nombre' => 'Inactivo y en Consumo',
            'nomenclatura'=>'IC'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Otros',
            'nomenclatura'=>'OT'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Restaurante',
            'nomenclatura'=>'RE'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Venta de Comidas Rapidas',
            'nomenclatura'=>'VCR'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Panaderia',
            'nomenclatura'=>'PA'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Cafeteria',
            'nomenclatura'=>'CA'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Bar',
            'nomenclatura'=>'BA'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Lavanderia',
            'nomenclatura'=>'LA'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Venta de Fritos',
            'nomenclatura'=>'VF'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Asadero de Pollos',
            'nomenclatura'=>'AP'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Industria',
            'nomenclatura'=>'IN'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Productor de Quesos / leche',
            'nomenclatura'=>'PQL'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Hotel/Motel',
            'nomenclatura'=>'HM'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Centro recreacional',
            'nomenclatura'=>'CR'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Institucion educativa',
            'nomenclatura'=>'IE'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Hospital /Clinica',
            'nomenclatura'=>'HC'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Fabrica de dulces',
            'nomenclatura'=>'FD'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Heladeria',
            'nomenclatura'=>'HE'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Bodegas',
            'nomenclatura'=>'BO'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Abarrotes',
            'nomenclatura'=>'TA'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Licores',
            'nomenclatura'=>'TL'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Carnes',
            'nomenclatura'=>'TC'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Frutas y Verduras',
            'nomenclatura'=>'TFV'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Ropa',
            'nomenclatura'=>'TR'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Calzado',
            'nomenclatura'=>'TC'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Accesorios',
            'nomenclatura'=>'TA'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Tecnologia y Celulares',
            'nomenclatura'=>'TT'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Electrodomesticos',
            'nomenclatura'=>'TE'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Muebles',
            'nomenclatura'=>'TM'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Ferreteria',
            'nomenclatura'=>'TF'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Papeleria y Micelaneas',
            'nomenclatura'=>'TP'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Juguetes',
            'nomenclatura'=>'TJ'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Mascotas',
            'nomenclatura'=>'TM'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Deportes',
            'nomenclatura'=>'TD'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Bicicletas',
            'nomenclatura'=>'TB'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Artesanias',
            'nomenclatura'=>'TA'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Plantas',
            'nomenclatura'=>'TP'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Terreno Valdio',
            'nomenclatura'=>'TV'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '4',
            'nombre' => 'Tienda de Decoracion',
            'nomenclatura'=>'TD'
        ]);

        encabezados_dets::create([
            'encabezados_id' => '5',
            'nombre' => 'Ninguna',
            'nomenclatura'=>'OB'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '5',
            'nombre' => 'Obstaculos (Poca Visibilidad)',
            'nomenclatura'=>'OB'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '5',
            'nombre' => 'Falta de Acceso (Rejas, Cerraduras, Etc)',
            'nomenclatura'=>'FA'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '5',
            'nombre' => 'Falta de Medidor',
            'nomenclatura'=>'FD'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '5',
            'nombre' => 'Usuario No Permite Lectura',
            'nomenclatura'=>'UNP'
        ]);
        encabezados_dets::create([
            'encabezados_id' => '5',
            'nombre' => 'Lugar Deshabitado',
            'nomenclatura'=>'LD'
        ]);

    }
}
