<?php

namespace App\Services\coordinador;

use App\Models\surtigas;
use App\Models\reportes;
use App\Services\coordinador\DataGisServicesToken;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class DataGisServices
{
    public function DataGis($id)
    {
        try {
            // Token de acceso para el servicio GIS
            $datagisservice= new DataGisServicesToken();
            $token = $datagisservice->getToken();

            $reportes = reportes::where('id', $id)->first();
            $surtigas = surtigas::where('id', $reportes->surtigas_id)->first();
            // URL de consulta
            $url = "https://arcgisportal.surtigas.com.co/geaserver/rest/services/Ingenieria/FC_PTDIRECCIONES/MapServer/0/query?f=json&where=(SUBSCRIPTION_ID%20IS%20NOT%20NULL)%20AND%20(SUBSCRIPTION_ID%20%3D%20$surtigas->contrato)&returnGeometry=true&spatialRel=esriSpatialRelIntersects&outFields=OBJECTID%2CORDEN%2CRID%2COBJECTID_1%2CDEPARTAMENTO%2CLOCALIDAD%2CNOMBRE%2CADDRESS_ID%2CID_PREMISE%2CNUP%2CDIRECCION%2CTAG%2CANILLADO%2CTIPOPREDIO%2CCICLO%2CDESCRIPCION%2CBARRIO%2CNOMBREBARRIO%2CCATEGORIA%2CDESCATEGORIA%2CESTRATO%2CPRODUCT_ID%2CPRODUCT_STATUS_ID%2CESTADOPRODUCTO%2CSUBSCRIPTION_ID%2CDESCESTADOCORTE%2CCODIDOESTADOCORTE%2CNOMBREUSUARIO%2CAPELLIDO%2CELEMENTOMEDICION%2CORIG_FID&outSR=102100&resultOffset=0&resultRecordCount=1000&token=$token";

            // Verificar si se encontró información del contrato
            // if (!$surtigas) {
            //     return [
            //         'error' => 'No se encontró informacion asociada al contrato proporcionado.'
            //     ];
            // }

            // URL de consulta
            $urlConsulta = Http::withoutVerifying()
                ->withHeaders([
                    "accept" => "*/*",
                    "accept-language" => "es-419,es;q=0.9,en;q=0.8",
                    "priority" => "u=1, i",
                    "referer" => "https://arcgisportal.surtigas.com.co/geaportal/apps/webappviewer/index.html?id=7f01784d858d43f49acd9fd5bd4b3123",
                    "sec-ch-ua" => "\"Chromium\";v=\"136\", \"Google Chrome\";v=\"136\", \"Not.A/Brand\";v=\"99\"",
                    "sec-ch-ua-mobile" => "?0",
                    "sec-ch-ua-platform" => "\"Windows\"",
                    "sec-fetch-dest" => "empty",
                    "sec-fetch-mode" => "cors",
                    "sec-fetch-site" => "same-origin",
                    "user-agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36",
                    "Cookie" => "AGS_ROLES=\"i96c/mmLorHlQpzmSue+ynS01g38XzWRs3bCji9jmlYtQYsgn+362nhRZI6qeQxH43OTAG6QyXzlprHFVVAM/g; esri_aopc=Yi0Y0Adj5UactyJn52KPjIcrLt6jIQo8kjLnkHK0lVIk8glqViOOnXLFuBJirQzjDr9lMeqybLtPgUjYH42uA-tpcJeDEbI8Dzr9n0c1FECF9cDeb--B8PfM7qq0vZKK-T3FrTXkCUCmaGF-VEGTy7w9FJACVF3FLI-CuxymitR_EM_WXLiHbDoFH-s75XfDPmqDEt_kb8mlCfqlvq8-4fnMEHNLXAov617EOI-V49vEt1iE9xBBU4X9i-NOVGFIlGrbdU5FuEwWOHtLE6n6nkUKJS654xnOK6GdguyKQ-Co7n6vcEw1jpMKvTjFZf0jtxCV7qmMiNosa4X8PAhLB_HGvRMHUzY_OrvwD5mmTr1cXwY-9WAIDJMiNnfznRFLTC7arXfscsSnK1SI1e51GuNJieXl7O7Z6EXhkRX6lladx3KoObo032STvsTKg2zV78ajbUMa5wUKGtgV61j3DHDTkIFRIn804ZIPiD8lIVmYiSyw7q-kqyfjQ4zd_mm2sM2mm9fooZmxoWeNhh6wuDRpHbTMxI0t0d0JlrAYMSe0KtUNrsLu5S_orZI6JcwZGXFxa2FVMgjRjCvZ1eXCRnsc7bY_wi8NzI2jFwdtNbSOsQHvqY7uu90T40CUVyHf; esri_auth=%7B%22portalApp%22%3Atrue%2C%22email%22%3A%22riesgosproderi%22%2C%22token%22%3A%22eFfNMlvqhk5_p00rjom9llmSWPkSpkI6AK9cgidnu9a9pM0KZVz98WD7q1B6iC6pyoTFF9YJAwSsJMZ93xoM9DkSn4af6SrVJM0agxyAdhP4b3eQ5QTZgoH1L-zZ10rWhZOesR3VPvBnVgonfKCtxjznT-BCjsHkc-tYLF8Yius0yhFmOVv6nZ3GyvbTkAE1msgOrhbD2kVgob_AGIHMlPCqwKmTlYP5p8dQOBTT6vk.%22%2C%22expires%22%3A1749055327383%2C%22allSSL%22%3Atrue%2C%22persistent%22%3Atrue%2C%22created%22%3A1747845787383%2C%22culture%22%3A%22es-es%22%2C%22region%22%3Anull%2C%22accountId%22%3A%220123456789ABCDEF%22%2C%22role%22%3A%22org_user%22%2C%22customBaseUrl%22%3A%22arcgisportal.surtigas.com.co%2Fgeaportal%22%7D"
                ])
                ->withOptions([
                    'version' => 2.0,
                ])
                ->get($url);

            // Verificar el estado de la respuesta
            if ($urlConsulta->failed()) {
                return [
                    'error' => 'Error al consultar el servicio GIS. Por favor, inténtelo más tarde.'
                ];
            }

            // Decodificar la respuesta JSON
            $data = $urlConsulta->json();

            if (isset($data['error'])) {
                return [
                    'error' => $data['error']['message']
                ];
            }

            if (!$data || !isset($data['features'][0])) {
                return [
                    'error' => 'No se encontraron datos para el contrato proporcionado.'
                ];
            }

            $attributes = $data['features'][0]['attributes'];
            $geometry = $data['features'][0]['geometry'];

            // Convertir coordenadas de Web Mercator a latitud y longitud
            list($lat, $lng) = $this->convertWebMercatorToLatLng($geometry['x'], $geometry['y']);

            return [
                'info' => [
                    'direccion' => $attributes['DIRECCION'],
                    'estado' => $attributes['ESTADOPRODUCTO'],
                    'estadoCorte' => $attributes['DESCESTADOCORTE'],
                    'usuario' => $attributes['NOMBREUSUARIO'],
                    'apellido' => $attributes['APELLIDO'],
                    'cliente' => $attributes['NOMBREUSUARIO'] . ' ' . $attributes['APELLIDO'],
                    'barrio' => $attributes['NOMBREBARRIO'],
                    'categoria' => $attributes['DESCATEGORIA'],
                    'descripcion' => $attributes['DESCRIPCION'],
                    'contrato' => $attributes['SUBSCRIPTION_ID'],
                    'medidor' => $attributes['ELEMENTOMEDICION']
                ],
                'geometry' => [
                    'latitude' => $lat,
                    'longitude' => $lng
                ]
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Se produjo un error al intentar acceder al servicio : '  //. $e->getMessage()
            ];
        }
    }

    public function DataGisubicacion(string $contrato)
    {
        try {
            // Token de acceso para el servicio GIS
            $datagisservice= new DataGisServicesToken();
            $token = $datagisservice->getToken();
            $surtigas = surtigas::where('contrato', $contrato)->first();
            $url = "https://arcgisportal.surtigas.com.co/geaserver/rest/services/Ingenieria/FC_PTDIRECCIONES/MapServer/0/query?f=json&where=(SUBSCRIPTION_ID%20IS%20NOT%20NULL)%20AND%20(SUBSCRIPTION_ID%20%3D%20$contrato)&returnGeometry=true&spatialRel=esriSpatialRelIntersects&outFields=OBJECTID%2CORDEN%2CRID%2COBJECTID_1%2CDEPARTAMENTO%2CLOCALIDAD%2CNOMBRE%2CADDRESS_ID%2CID_PREMISE%2CNUP%2CDIRECCION%2CTAG%2CANILLADO%2CTIPOPREDIO%2CCICLO%2CDESCRIPCION%2CBARRIO%2CNOMBREBARRIO%2CCATEGORIA%2CDESCATEGORIA%2CESTRATO%2CPRODUCT_ID%2CPRODUCT_STATUS_ID%2CESTADOPRODUCTO%2CSUBSCRIPTION_ID%2CDESCESTADOCORTE%2CCODIDOESTADOCORTE%2CNOMBREUSUARIO%2CAPELLIDO%2CELEMENTOMEDICION%2CORIG_FID&outSR=102100&resultOffset=0&resultRecordCount=1000&token=$token";

            if (!$surtigas) {
                return [
                    'error' => 'No se encontró informacion asociada al contrato proporcionado.'
                ];
            }

            // URL de consulta
            $urlConsulta = Http::withoutVerifying()
                ->withHeaders([
                    "accept" => "*/*",
                    "accept-language" => "es-419,es;q=0.9,en;q=0.8",
                    "priority" => "u=1, i",
                    "referer" => "https://arcgisportal.surtigas.com.co/geaportal/apps/webappviewer/index.html?id=7f01784d858d43f49acd9fd5bd4b3123",
                    "sec-ch-ua" => "\"Chromium\";v=\"136\", \"Google Chrome\";v=\"136\", \"Not.A/Brand\";v=\"99\"",
                    "sec-ch-ua-mobile" => "?0",
                    "sec-ch-ua-platform" => "\"Windows\"",
                    "sec-fetch-dest" => "empty",
                    "sec-fetch-mode" => "cors",
                    "sec-fetch-site" => "same-origin",
                    "user-agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36",
                    "Cookie" => "AGS_ROLES=\"i96c/mmLorHlQpzmSue+ynS01g38XzWRs3bCji9jmlYtQYsgn+362nhRZI6qeQxH43OTAG6QyXzlprHFVVAM/g; esri_aopc=Yi0Y0Adj5UactyJn52KPjIcrLt6jIQo8kjLnkHK0lVIk8glqViOOnXLFuBJirQzjDr9lMeqybLtPgUjYH42uA-tpcJeDEbI8Dzr9n0c1FECF9cDeb--B8PfM7qq0vZKK-T3FrTXkCUCmaGF-VEGTy7w9FJACVF3FLI-CuxymitR_EM_WXLiHbDoFH-s75XfDPmqDEt_kb8mlCfqlvq8-4fnMEHNLXAov617EOI-V49vEt1iE9xBBU4X9i-NOVGFIlGrbdU5FuEwWOHtLE6n6nkUKJS654xnOK6GdguyKQ-Co7n6vcEw1jpMKvTjFZf0jtxCV7qmMiNosa4X8PAhLB_HGvRMHUzY_OrvwD5mmTr1cXwY-9WAIDJMiNnfznRFLTC7arXfscsSnK1SI1e51GuNJieXl7O7Z6EXhkRX6lladx3KoObo032STvsTKg2zV78ajbUMa5wUKGtgV61j3DHDTkIFRIn804ZIPiD8lIVmYiSyw7q-kqyfjQ4zd_mm2sM2mm9fooZmxoWeNhh6wuDRpHbTMxI0t0d0JlrAYMSe0KtUNrsLu5S_orZI6JcwZGXFxa2FVMgjRjCvZ1eXCRnsc7bY_wi8NzI2jFwdtNbSOsQHvqY7uu90T40CUVyHf; esri_auth=%7B%22portalApp%22%3Atrue%2C%22email%22%3A%22riesgosproderi%22%2C%22token%22%3A%22eFfNMlvqhk5_p00rjom9llmSWPkSpkI6AK9cgidnu9a9pM0KZVz98WD7q1B6iC6pyoTFF9YJAwSsJMZ93xoM9DkSn4af6SrVJM0agxyAdhP4b3eQ5QTZgoH1L-zZ10rWhZOesR3VPvBnVgonfKCtxjznT-BCjsHkc-tYLF8Yius0yhFmOVv6nZ3GyvbTkAE1msgOrhbD2kVgob_AGIHMlPCqwKmTlYP5p8dQOBTT6vk.%22%2C%22expires%22%3A1749055327383%2C%22allSSL%22%3Atrue%2C%22persistent%22%3Atrue%2C%22created%22%3A1747845787383%2C%22culture%22%3A%22es-es%22%2C%22region%22%3Anull%2C%22accountId%22%3A%220123456789ABCDEF%22%2C%22role%22%3A%22org_user%22%2C%22customBaseUrl%22%3A%22arcgisportal.surtigas.com.co%2Fgeaportal%22%7D"
                ])
                ->withOptions([
                    'version' => 2.0,
                ])
                ->get($url);


            // Verificar el estado de la respuesta
            if ($urlConsulta->failed()) {
                return [
                    'error' => 'Error al consultar el servicio GIS. Por favor, inténtelo más tarde.'
                ];
            }

            // Decodificar la respuesta JSON
            $data = $urlConsulta->json();

            if (isset($data['error'])) {
                return [
                    'error' => $data['error']['message']
                ];
            }

            if (!$data || !isset($data['features'][0])) {
                return [
                    'error' => 'No se encontraron datos para el contrato proporcionado.'
                ];
            }

            $attributes = $data['features'][0]['attributes'];
            $geometry = $data['features'][0]['geometry'];

            // Convertir coordenadas de Web Mercator a latitud y longitud
            list($lat, $lng) = $this->convertWebMercatorToLatLng($geometry['x'], $geometry['y']);

            return [
                'info' => [
                    'direccion' => $attributes['DIRECCION'],
                    'estado' => $attributes['ESTADOPRODUCTO'],
                    'estadoCorte' => $attributes['DESCESTADOCORTE'],
                    'usuario' => $attributes['NOMBREUSUARIO'],
                    'apellido' => $attributes['APELLIDO'],
                    'cliente' => $attributes['NOMBREUSUARIO'] . ' ' . $attributes['APELLIDO'],
                    'barrio' => $attributes['NOMBREBARRIO'],
                    'categoria' => $attributes['DESCATEGORIA'],
                    'descripcion' => $attributes['DESCRIPCION'],
                    'contrato' => $attributes['SUBSCRIPTION_ID'],
                    'medidor' => $attributes['ELEMENTOMEDICION']
                ],
                'geometry' => [
                    'link' => 'https://www.google.com/maps/place/' . $lat . ',' . $lng,
                ]
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Se produjo un error al intentar acceder al servicio : ' // . $e->getMessage()
            ];
        }
    }
    public function DataGishow(string $contrato)
    {
        try {

            // Token de acceso para el servicio GIS
            $datagisservice= new DataGisServicesToken();
            $token = $datagisservice->getToken();
            $reportes = reportes::where('id', $contrato)->first();
            $surtigas = surtigas::where('id', $reportes->surtigas_id)->first();
            $url = "https://arcgisportal.surtigas.com.co/geaserver/rest/services/Ingenieria/FC_PTDIRECCIONES/MapServer/0/query?f=json&where=(SUBSCRIPTION_ID%20IS%20NOT%20NULL)%20AND%20(SUBSCRIPTION_ID%20%3D%20$surtigas->contrato)&returnGeometry=true&spatialRel=esriSpatialRelIntersects&outFields=OBJECTID%2CORDEN%2CRID%2COBJECTID_1%2CDEPARTAMENTO%2CLOCALIDAD%2CNOMBRE%2CADDRESS_ID%2CID_PREMISE%2CNUP%2CDIRECCION%2CTAG%2CANILLADO%2CTIPOPREDIO%2CCICLO%2CDESCRIPCION%2CBARRIO%2CNOMBREBARRIO%2CCATEGORIA%2CDESCATEGORIA%2CESTRATO%2CPRODUCT_ID%2CPRODUCT_STATUS_ID%2CESTADOPRODUCTO%2CSUBSCRIPTION_ID%2CDESCESTADOCORTE%2CCODIDOESTADOCORTE%2CNOMBREUSUARIO%2CAPELLIDO%2CELEMENTOMEDICION%2CORIG_FID&outSR=102100&resultOffset=0&resultRecordCount=1000&token=$token";

            if (!$surtigas) {
                return [
                    'error' => 'No se encontró informacion asociada al contrato proporcionado.'
                ];
            }

            // URL de consulta
            $urlConsulta = Http::withoutVerifying()
                ->withHeaders([
                    "accept" => "*/*",
                    "accept-language" => "es-419,es;q=0.9,en;q=0.8",
                    "priority" => "u=1, i",
                    "referer" => "https://arcgisportal.surtigas.com.co/geaportal/apps/webappviewer/index.html?id=7f01784d858d43f49acd9fd5bd4b3123",
                    "sec-ch-ua" => "\"Chromium\";v=\"136\", \"Google Chrome\";v=\"136\", \"Not.A/Brand\";v=\"99\"",
                    "sec-ch-ua-mobile" => "?0",
                    "sec-ch-ua-platform" => "\"Windows\"",
                    "sec-fetch-dest" => "empty",
                    "sec-fetch-mode" => "cors",
                    "sec-fetch-site" => "same-origin",
                    "user-agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36",
                    "Cookie" => "AGS_ROLES=\"i96c/mmLorHlQpzmSue+ynS01g38XzWRs3bCji9jmlYtQYsgn+362nhRZI6qeQxH43OTAG6QyXzlprHFVVAM/g; esri_aopc=Yi0Y0Adj5UactyJn52KPjIcrLt6jIQo8kjLnkHK0lVIk8glqViOOnXLFuBJirQzjDr9lMeqybLtPgUjYH42uA-tpcJeDEbI8Dzr9n0c1FECF9cDeb--B8PfM7qq0vZKK-T3FrTXkCUCmaGF-VEGTy7w9FJACVF3FLI-CuxymitR_EM_WXLiHbDoFH-s75XfDPmqDEt_kb8mlCfqlvq8-4fnMEHNLXAov617EOI-V49vEt1iE9xBBU4X9i-NOVGFIlGrbdU5FuEwWOHtLE6n6nkUKJS654xnOK6GdguyKQ-Co7n6vcEw1jpMKvTjFZf0jtxCV7qmMiNosa4X8PAhLB_HGvRMHUzY_OrvwD5mmTr1cXwY-9WAIDJMiNnfznRFLTC7arXfscsSnK1SI1e51GuNJieXl7O7Z6EXhkRX6lladx3KoObo032STvsTKg2zV78ajbUMa5wUKGtgV61j3DHDTkIFRIn804ZIPiD8lIVmYiSyw7q-kqyfjQ4zd_mm2sM2mm9fooZmxoWeNhh6wuDRpHbTMxI0t0d0JlrAYMSe0KtUNrsLu5S_orZI6JcwZGXFxa2FVMgjRjCvZ1eXCRnsc7bY_wi8NzI2jFwdtNbSOsQHvqY7uu90T40CUVyHf; esri_auth=%7B%22portalApp%22%3Atrue%2C%22email%22%3A%22riesgosproderi%22%2C%22token%22%3A%22eFfNMlvqhk5_p00rjom9llmSWPkSpkI6AK9cgidnu9a9pM0KZVz98WD7q1B6iC6pyoTFF9YJAwSsJMZ93xoM9DkSn4af6SrVJM0agxyAdhP4b3eQ5QTZgoH1L-zZ10rWhZOesR3VPvBnVgonfKCtxjznT-BCjsHkc-tYLF8Yius0yhFmOVv6nZ3GyvbTkAE1msgOrhbD2kVgob_AGIHMlPCqwKmTlYP5p8dQOBTT6vk.%22%2C%22expires%22%3A1749055327383%2C%22allSSL%22%3Atrue%2C%22persistent%22%3Atrue%2C%22created%22%3A1747845787383%2C%22culture%22%3A%22es-es%22%2C%22region%22%3Anull%2C%22accountId%22%3A%220123456789ABCDEF%22%2C%22role%22%3A%22org_user%22%2C%22customBaseUrl%22%3A%22arcgisportal.surtigas.com.co%2Fgeaportal%22%7D"
                ])
                ->withOptions([
                    'version' => 2.0,
                ])
                ->get($url);


            // Verificar el estado de la respuesta
            if ($urlConsulta->failed()) {
                return [
                    'error' => 'Error al consultar el servicio GIS. Por favor, inténtelo más tarde.'
                ];
            }

            // Decodificar la respuesta JSON
            $data = $urlConsulta->json();

            if (isset($data['error'])) {
                return [
                    'error' => $data['error']['message']
                ];
            }

            if (!$data || !isset($data['features'][0])) {
                return [
                    'error' => 'No se encontraron datos para el contrato proporcionado.'
                ];
            }

            $attributes = $data['features'][0]['attributes'];
            $geometry = $data['features'][0]['geometry'];

            // Convertir coordenadas de Web Mercator a latitud y longitud
            list($lat, $lng) = $this->convertWebMercatorToLatLng($geometry['x'], $geometry['y']);

            return [
                'info' => [
                    'direccion' => $attributes['DIRECCION'],
                    'estado' => $attributes['ESTADOPRODUCTO'],
                    'estadoCorte' => $attributes['DESCESTADOCORTE'],
                    'usuario' => $attributes['NOMBREUSUARIO'],
                    'apellido' => $attributes['APELLIDO'],
                    'cliente' => $attributes['NOMBREUSUARIO'] . ' ' . $attributes['APELLIDO'],
                    'barrio' => $attributes['NOMBREBARRIO'],
                    'categoria' => $attributes['DESCATEGORIA'],
                    'descripcion' => $attributes['DESCRIPCION'],
                    'contrato' => $attributes['SUBSCRIPTION_ID'],
                    'medidor' => $attributes['ELEMENTOMEDICION']
                ],
                'geometry' => [
                    'link' => 'https://www.google.com/maps/place/' . $lat . ',' . $lng,
                ]
            ];
        } catch (\Exception $e) {
            return [
                'error' => 'Se produjo un error al intentar acceder al servicio : ' // . $e->getMessage()
            ];
        }
    }



    private function convertWebMercatorToLatLng($x, $y)
    {
        $lng = ($x / 6378137) * (180 / pi());
        $lat = (2 * atan(exp($y / 6378137)) - (pi() / 2)) * (180 / pi());
        return [$lat, $lng];
    }
}
