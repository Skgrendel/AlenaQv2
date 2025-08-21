<?php

namespace App\Services\reporte;

use App\Mail\Notification_Alertas_cau;
use App\Mail\Notification_anomalia;
use App\Mail\Notification_exceso_capacidad;
use App\Mail\Notification_fuga;
use Illuminate\Support\Facades\Mail;

class AlertasService
{
    public function getAlertasAnomalia($request)
    {
        $enviarCorreo = false;

        // Obtener anomalías del request (ya vienen por nombre)
        $anomalias = $request->input('anomalia', []); // Ej: ["Bypass", "Medidor con sellos manipulados"]

        // Filtrar cualquier entrada que diga "Sin Anomalias"
        $anomaliasFiltradas = array_filter($anomalias, function ($nombre) {
            return $nombre !== 'Sin Anomalias';
        });

        if (!empty($anomaliasFiltradas)) {
            $enviarCorreo = true;
            $anomaliasNombres = $anomaliasFiltradas;
        }

        // Construir el array `$data` desde los inputs ocultos
        $data = [
            'info' => [
                'db_Surtigas' => [
                    'cliente' => $request->input('nombre_cliente', 'sin datos'),
                    'contrato' => $request->input('numero_contrato', 'sin datos'),
                    'medidor' => $request->input('numero_medidor', 'sin datos'),
                    'direccion' => $request->input('direccion', 'sin datos'),
                    'ciclo' => $request->input('ciclo', 'sin datos'),
                    'barrio' => $request->input('barrio', 'sin datos'),
                    'estado_servicio' => $request->input('estado_servicio', 'sin datos'),
                    'cau' => $request->input('cau', 'sin datos'),
                ]
            ]
        ];

        // Correos
        $destinatarios = [
            'principal' => 'william.castano@surtigas.co',
            'cc' => [
                'brayan.mogollon@surtigas.co',
                'brayhan.suarez@surtigas.co'
            ]
        ];
        // Enviar correo
        if ($enviarCorreo) {
            Mail::to($destinatarios['principal'])
                ->cc($destinatarios['cc'])
                ->queue(new Notification_anomalia($data, $anomaliasNombres));
        }
    }
    public function getAlertaFuga($request)
    {
        $enviarCorreo = false;
        // Construir el array `$data` desde los inputs ocultos

        $data = [
            'info' => [
                'db_Surtigas' => [
                    'cliente' => $request->input('nombre_cliente', 'sin datos'),
                    'contrato' => $request->input('numero_contrato', 'sin datos'),
                    'medidor' => $request->input('numero_medidor', 'sin datos'),
                    'direccion' => $request->input('direccion', 'sin datos'),
                    'ciclo' => $request->input('ciclo', 'sin datos'),
                    'barrio' => $request->input('barrio', 'sin datos'),
                    'estado_servicio' => $request->input('estado_servicio', 'sin datos'),
                ]
            ]
        ];

        // Obtener las anomalías seleccionadas (vienen como array)
        $anomalias = $request->input('fuga_gas'); // Ej: [1, 3, 5]

        if (!empty($anomalias) && $anomalias == true) {
            $enviarCorreo = true;
        }
        // Correos
        $destinatarios = [
            'principal' => 'william.castano@surtigas.co',
            'cc' => [
                'brayan.mogollon@surtigas.co',
                'brayhan.suarez@surtigas.co'
            ]
        ];
        if ($enviarCorreo) {
            Mail::to($destinatarios['principal'])
                ->cc($destinatarios['cc'])
                ->queue(new Notification_fuga($data));
        }
    }

    public function getAlertaExcesoCapacidad($request)
    {
        $enviarCorreo = false;
        // Construir el array `$data` desde los inputs ocultos

        $data = [
            'info' => [
                'db_Surtigas' => [
                    'cliente' => $request->input('nombre_cliente', 'sin datos'),
                    'contrato' => $request->input('numero_contrato', 'sin datos'),
                    'medidor' => $request->input('numero_medidor', 'sin datos'),
                    'direccion' => $request->input('direccion', 'sin datos'),
                    'ciclo' => $request->input('ciclo', 'sin datos'),
                    'barrio' => $request->input('barrio', 'sin datos'),
                    'estado_servicio' => $request->input('estado_servicio', 'sin datos'),
                ]
            ]
        ];

        // Obtener las anomalías seleccionadas (vienen como array)
        $anomalias = $request->input('ex_capacidad'); // Ej: [1, 3, 5]

        if (!empty($anomalias) && $anomalias == true) {
            $enviarCorreo = true;
        }
        $destinatarios = [
            'principal' => 'william.castano@surtigas.co',
            'cc' => [
                'brayan.mogollon@surtigas.co',
                'brayhan.suarez@surtigas.co'
            ]
        ];
        if ($enviarCorreo) {
            Mail::to($destinatarios['principal'])
                ->cc($destinatarios['cc'])
                ->queue(new Notification_exceso_capacidad($data));
        }
    }
    public function getAlertaCau($request)
    {
        $enviarCorreo = false;
        // Construir el array `$data` desde los inputs ocultos

        $data = [
            'info' => [
                'db_Surtigas' => [
                    'cliente' => $request->input('nombre_cliente', 'sin datos'),
                    'contrato' => $request->input('numero_contrato', 'sin datos'),
                    'medidor' => $request->input('numero_medidor', 'sin datos'),
                    'direccion' => $request->input('direccion', 'sin datos'),
                    'ciclo' => $request->input('ciclo', 'sin datos'),
                    'barrio' => $request->input('barrio', 'sin datos'),
                    'estado_servicio' => $request->input('estado_servicio', 'sin datos'),
                    'cau' => $request->input('cau', 'sin datos'),
                ]
            ]
        ];

        // Obtener las anomalías seleccionadas (vienen como array)
        $anomalias = $request->input('cau');

        if (!empty($anomalias) && $anomalias !== 'Sin Alertas') {
            $enviarCorreo = true;
        }
        $destinatarios = [
            'principal' => 'william.castano@surtigas.co',
            'cc' => [
                'brayan.mogollon@surtigas.co',
                'brayhan.suarez@surtigas.co'

            ]
        ];
        if ($enviarCorreo) {
            Mail::to($destinatarios['principal'])
                ->cc($destinatarios['cc'])
                ->queue(new Notification_Alertas_cau($data));
        }
    }
}
