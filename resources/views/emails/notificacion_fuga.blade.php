<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Fuga</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background-color:#f0f0f0;font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding:30px 0;background-color:#f0f0f0;">
  <tr>
    <td align="center">

      <!-- CARD -->
      <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.1);padding:0;">

        <!-- HEADER -->
        <tr>
          <td align="center" style="background-color:#f7f7f7;padding:24px 0;">
            <img src="{{ asset('assets/image/LogoAlenaQanalyticData.svg') }}" alt="Logo" style="width:250px;height:50px;" />
          </td>
        </tr>

        <!-- CONTENIDO -->
        <tr>
            <td style="padding:40px 40px 30px 40px;">
                <h2 style="margin:0 0 20px 0;font-size:20px;color:#003366;font-weight:bold;text-align:center;">Reporte de FUGA Detectada</h2>

                <p style="margin:0 0 16px 0;font-size:16px;line-height:1.6;color:#333333;">
                    Se ha detectado una Fuga de Gas en el siguiente registro:
                </p>

                <table style="width:100%;margin:20px 0;border-collapse:collapse;font-size:16px;">
                    <tr style="background-color:#f8f9fa;">
                        <td style="padding:12px;border:1px solid #ddd;font-weight:bold;">Número de Contrato</td>
                        <td style="padding:12px;border:1px solid #ddd;">{{$data->contrato}}</td>
                    </tr>
                    <tr>
                        <td style="padding:12px;border:1px solid #ddd;font-weight:bold;">Usuario</td>
                        <td style="padding:12px;border:1px solid #ddd;">{{$data->cliente}}</td>
                    </tr>
                    <tr style="background-color:#f8f9fa;">
                        <td style="padding:12px;border:1px solid #ddd;font-weight:bold;">Dirección</td>
                        <td style="padding:12px;border:1px solid #ddd;">{{$data->direccion}}</td>
                    </tr>
                    <tr>
                        <td style="padding:12px;border:1px solid #ddd;font-weight:bold;">Barrio</td>
                        <td style="padding:12px;border:1px solid #ddd;">{{$data->barrio}}</td>
                    </tr>
                    <tr style="background-color:#f8f9fa;">
                        <td style="padding:12px;border:1px solid #ddd;font-weight:bold;">Número de Medidor</td>
                        <td style="padding:12px;border:1px solid #ddd;">{{$data->medidor}}</td>
                    </tr>
                </table>

                <!-- Sección de Fuga Detectadas -->
                <div style="margin:30px 0;border:1px solid #ddd;border-radius:4px;overflow:hidden;">
                    <div style="background-color:#dc3545;padding:12px;color:white;font-weight:bold;font-size:16px;">
                        🚨 ALERTA CRÍTICA: Fuga de gas confirmada
                    </div>
                    <ul style="margin:0;padding:20px;list-style-type:none;font-size:16px;">
                        <li style="padding:8px 0;border-bottom:1px solid #eee;display:flex;align-items:center;">
                            <span style="color:#dc3545;font-weight:bold;margin-right:8px;">•</span>
                            <strong>Nivel de riesgo:</strong> ALTO (Posible explosión o intoxicación)
                        </li>
                        <li style="padding:8px 0;border-bottom:1px solid #eee;display:flex;align-items:center;">
                            <span style="color:#dc3545;font-weight:bold;margin-right:8px;">•</span>
                            <strong>Acción requerida:</strong> Evacuación inmediata y cierre de válvulas
                        </li>
                        <li style="padding:8px 0;display:flex;align-items:center;">
                            <span style="color:#dc3545;font-weight:bold;margin-right:8px;">•</span>
                            <strong>Protocolo de emergencia:</strong> Activar equipo de respuesta en menos de 30 minutos
                        </li>
                    </ul>
                </div>

                <p style="margin:30px 0 30px 0;font-size:18px;line-height:1.6;color:#dc3545;text-align:center;font-weight:bold;">
                    ¡Se requiere atención inmediata a esta EMERGENCIA!!!
                    <p style="text-align:center">Fecha del reporte: {{ now()->format('d/m/Y h:i A') }}</p>
                </p>
                <p style="margin:0 0 16px 0;font-size:16px;line-height:1.6;color:#333333;text-align:center">
                    Por favor, tome las acciones necesarias y notifique al equipo técnico correspondiente.
                </p>
            </td>
        </tr>

        <!-- FOOTER -->
        <tr>
          <td align="center" style="background-color:#f8f8f8;padding:20px;border-top:1px solid #dddddd;">
            <p style="margin:0;font-size:12px;color:#999999;line-height:1.5;">
              © 2024 Todos los derechos reservados.
            </p>
            <p style="margin:10px 0 0 0;font-size:12px;color:#999999;line-height:1.5;">
              Este mensaje ha sido generado automáticamente, por favor no responda a este correo.
            </p>
          </td>
        </tr>

      </table>
      <!-- FIN CARD -->

    </td>
  </tr>
</table>

</body>
</html>

