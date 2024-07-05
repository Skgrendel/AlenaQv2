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
        $data = [
            ['encabezados_id' => '1', 'nombre' => 'Cedula de Ciudadania', 'nomenclatura' => 'CC'],
            ['encabezados_id' => '1', 'nombre' => 'Permiso de Permanencia', 'nomenclatura' => 'PPT'],
            ['encabezados_id' => '2', 'nombre' => 'Activo', 'nomenclatura' => 'AC'],
            ['encabezados_id' => '2', 'nombre' => 'Inactivo', 'nomenclatura' => 'IN'],
            ['encabezados_id' => '2', 'nombre' => 'Pendiente', 'nomenclatura' => 'PD'],
            ['encabezados_id' => '2', 'nombre' => 'Revisado', 'nomenclatura' => 'RV'],
            ['encabezados_id' => '2', 'nombre' => 'Rechazado', 'nomenclatura' => 'RC'],
            ['encabezados_id' => '3', 'nombre' => 'Sin Anomalias', 'nomenclatura' => 'NA'],
            ['encabezados_id' => '3', 'nombre' => 'Bypass', 'nomenclatura' => 'BY'],
            ['encabezados_id' => '3', 'nombre' => 'Medidor con sellos manipulados', 'nomenclatura' => 'MCSM'],
            ['encabezados_id' => '3', 'nombre' => 'Medidor con digitos desalineados', 'nomenclatura' => 'MCDD'],
            ['encabezados_id' => '3', 'nombre' => 'Medidor sin talco', 'nomenclatura' => 'MST'],
            ['encabezados_id' => '3', 'nombre' => 'Medidor enterrado', 'nomenclatura' => 'ME'],
            ['encabezados_id' => '3', 'nombre' => 'Conexión directa', 'nomenclatura' => 'CD'],
            ['encabezados_id' => '3', 'nombre' => 'Medidor frenado', 'nomenclatura' => 'MF'],
            ['encabezados_id' => '3', 'nombre' => 'Medidor gira hacia atrás', 'nomenclatura' => 'MGHA'],
            ['encabezados_id' => '3', 'nombre' => 'Medidor No encontrado', 'nomenclatura' => 'MFR'],
            ['encabezados_id' => '3', 'nombre' => 'Medidor No Concuerda con el contrato', 'nomenclatura' => 'MFR'],
            ['encabezados_id' => '3', 'nombre' => 'Medidor trocado', 'nomenclatura' => 'MT'],
            ['encabezados_id' => '3', 'nombre' => 'Inactivo y en Consumo', 'nomenclatura' => 'IC'],
            ['encabezados_id' => '3', 'nombre' => 'Inspecion y revision', 'nomenclatura' => 'IC'],
            ['encabezados_id' => '3', 'nombre' => 'Posible fuga', 'nomenclatura' => 'IC'],
            ['encabezados_id' => '3', 'nombre' => 'pendiente de Retiro / Revision', 'nomenclatura' => 'IC'],
            ['encabezados_id' => '3', 'nombre' => 'Medidor con doble local Comercial', 'nomenclatura' => 'IC'],
            ['encabezados_id' => '4', 'nombre' => 'Restaurante', 'nomenclatura' => 'RE'],
            ['encabezados_id' => '4', 'nombre' => 'Venta de Comidas Rapidas', 'nomenclatura' => 'VCR'],
            ['encabezados_id' => '4', 'nombre' => 'Panaderia', 'nomenclatura' => 'PA'],
            ['encabezados_id' => '4', 'nombre' => 'Cafeteria', 'nomenclatura' => 'CA'],
            ['encabezados_id' => '4', 'nombre' => 'Bar / Discoteca', 'nomenclatura' => 'BA'],
            ['encabezados_id' => '4', 'nombre' => 'Lavanderia', 'nomenclatura' => 'LA'],
            ['encabezados_id' => '4', 'nombre' => 'Venta de Fritos', 'nomenclatura' => 'VF'],
            ['encabezados_id' => '4', 'nombre' => 'Asadero de Pollos', 'nomenclatura' => 'AP'],
            ['encabezados_id' => '4', 'nombre' => 'Industria', 'nomenclatura' => 'IN'],
            ['encabezados_id' => '4', 'nombre' => 'Productor de Quesos / leche', 'nomenclatura' => 'PQL'],
            ['encabezados_id' => '4', 'nombre' => 'Hotel/Motel', 'nomenclatura' => 'HM'],
            ['encabezados_id' => '4', 'nombre' => 'Centro recreacional', 'nomenclatura' => 'CR'],
            ['encabezados_id' => '4', 'nombre' => 'Institucion educativa', 'nomenclatura' => 'IE'],
            ['encabezados_id' => '4', 'nombre' => 'Centro Comercial', 'nomenclatura' => 'FD'],
            ['encabezados_id' => '4', 'nombre' => 'Heladeria', 'nomenclatura' => 'HE'],
            ['encabezados_id' => '4', 'nombre' => 'Bodegas', 'nomenclatura' => 'BO'],
            ['encabezados_id' => '4', 'nombre' => 'Inmueble Desocupado / En Arriendo', 'nomenclatura' => 'IM'],
            ['encabezados_id' => '4', 'nombre' => 'Tienda de Abarrotes', 'nomenclatura' => 'TA'],
            ['encabezados_id' => '4', 'nombre' => 'Ferreteria', 'nomenclatura' => 'TF'],
            ['encabezados_id' => '4', 'nombre' => 'Papeleria y Micelaneas', 'nomenclatura' => 'TP'],
            ['encabezados_id' => '4', 'nombre' => 'Tienda de Juguetes', 'nomenclatura' => 'TJ'],
            ['encabezados_id' => '4', 'nombre' => 'Veterinaria', 'nomenclatura' => 'TM'],
            ['encabezados_id' => '4', 'nombre' => 'Taller de Motos', 'nomenclatura' => 'TB'],
            ['encabezados_id' => '4', 'nombre' => 'Estacion de Servicio', 'nomenclatura' => 'TA'],
            ['encabezados_id' => '4', 'nombre' => 'Hospital / Clinica/ ips / Consultorio', 'nomenclatura' => 'TP'],
            ['encabezados_id' => '4', 'nombre' => 'Terreno Valdio', 'nomenclatura' => 'TV'],
            ['encabezados_id' => '4', 'nombre' => 'Locales Comerciales', 'nomenclatura' => 'TV'],
            ['encabezados_id' => '4', 'nombre' => 'Drogueria', 'nomenclatura' => 'TV'],
            ['encabezados_id' => '4', 'nombre' => 'Edificio / En construccion', 'nomenclatura' => 'TV'],
            ['encabezados_id' => '4', 'nombre' => 'Base Naval / Base Militar', 'nomenclatura' => 'TV'],
            ['encabezados_id' => '4', 'nombre' => 'Comercio no encontrado', 'nomenclatura' => 'TV'],
            ['encabezados_id' => '5', 'nombre' => 'Ninguna', 'nomenclatura' => 'OB'],
            ['encabezados_id' => '5', 'nombre' => 'Obstaculos (Poca Visibilidad)', 'nomenclatura' => 'OB'],
            ['encabezados_id' => '5', 'nombre' => 'Falta de Acceso (Rejas, Cerraduras, Etc)', 'nomenclatura' => 'FA'],
            ['encabezados_id' => '5', 'nombre' => 'Falta de Medidor', 'nomenclatura' => 'FD'],
            ['encabezados_id' => '5', 'nombre' => 'Usuario No Permite Lectura', 'nomenclatura' => 'UNP'],
            ['encabezados_id' => '5', 'nombre' => 'Lugar Deshabitado', 'nomenclatura' => 'LD'],
        ];

        foreach ($data as $item) {
            encabezados_dets::create($item);
        }

    }
}
