<?php

namespace App\Services\coordinador;

use App\Models\surtigas;
use App\Models\reportes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class DataGisServicesToken
{

    private $proxy;

    public function __construct()
    {
        $proxy = "http://".config('services.proxy.user').":".config('services.proxy.pass')."@".config('services.proxy.server').":".config('services.proxy.port');
        $this->proxy = $proxy;
    }

    public function DataGis()
    {
        try {
            $Gen_token = "https://arcgisportal.surtigas.com.co/geaportal/sharing/rest/oauth2/authorize?client_id=arcgisonline&display=default&response_type=token&state=%7B%22returnUrl%22%3A%22https%3A%2F%2Farcgisportal.surtigas.com.co%2Fgeaportal%2Fapps%2Fwebappviewer%2Findex.html%3Fid%3D7f01784d858d43f49acd9fd5bd4b3123%22%2C%22useLandingPage%22%3Afalse%7D&expiration=20160&locale=es-es&redirect_uri=https%3A%2F%2Farcgisportal.surtigas.com.co%2Fgeaportal%2Fhome%2Faccountswitcher-callback.html&force_login=false&hideCancel=true&showSignupOption=true&canHandleCrossOrgSignIn=true&signuptype=esri";
            $response = Http::withoutVerifying()
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
                ])
                ->withOptions([
                    'version' => 2.0,
                    'proxy' => [
                        'http'  => $proxy,
                        'https' => $proxy,
                    ],
                    'force_ip_resolve' => 'v4',
                    // 'curl' => [
                    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    //     CURLOPT_HTTPPROXYTUNNEL => true,
                    //     CURLOPT_SSLVERSION   => CURL_SSLVERSION_TLSv1_2,
                    // ],
                ])
                ->get($Gen_token);

            // Check if the response is successful
            if ($response->successful()) {
                // Parse the response body to extract the token
                $responseBody = $response->body();
                preg_match('/"oauth_state"\s*:\s*"([^"]+)"/', $responseBody, $matches);
                if (isset($matches[1])) {
                    $token = $matches[1];
                    return $token; // Return the token
                } else {
                    Log::error('Token not found in response body.');
                    return null; // Token not found
                }
            } else {
                Log::error('Failed to retrieve token from DataGis Service (Datagis).', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'headers' => $response->headers(),
                ]);
                return null; // Request failed
            }
        } catch (\Exception $e) {
            return [
                'error' => 'Se produjo un error al intentar acceder al servicio : '  //. $e->getMessage()
            ];
        }
    }

    public function logingis()
    {

        $login = $this->DataGis();

        if ($login) {
            $url = "https://arcgisportal.surtigas.com.co/geaportal/sharing/oauth2/signin";
            // Use the token in the request
            $response = Http::withoutVerifying()->withHeaders([
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
            ])
            ->withOptions([
                'version' => 2.0,
                'proxy' => [
                    'http'  => $proxy,
                    'https' => $proxy,
                ],
                'force_ip_resolve' => 'v4',
                // 'curl' => [
                //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                //     CURLOPT_HTTPPROXYTUNNEL => true,
                //     CURLOPT_SSLVERSION   => CURL_SSLVERSION_TLSv1_2,
                // ],
            ])
            ->withoutRedirecting()
            ->asForm()
            ->post($url, [
                'oauth_state' => $login,
                'authorize' => true,
                'username' => 'riesgosproderi',
                'password' => 'riesgosproderi2024',
            ]);


            //redirect to the URL
            $gisurl = $response->handlerStats()['redirect_url'] ?? null;
            $parsedUrl = parse_url($gisurl, PHP_URL_FRAGMENT);
            if ($parsedUrl) {
                parse_str($parsedUrl, $params);
                $token = $params['access_token'] ?? null;
                if ($token) {
                    return  $token; // Return the token
                } else {
                    Log::error('Access token not found in the response.');
                    return  null; // Access token not found
                }
            } else {
                Log::error('Failed to parse the redirect URL.');
                return  null; // Redirect URL parsing failed
            }
        }

        return $this; // Return the token
    }

    public function getToken()
    {
        $cache = Cache::get('gis_token');
        if ($cache) {
            Log::info('Returning cached GIS token.');
            return $cache; // Return cached token if available
        }
        $token = $this->logingis();
        $url = "https://arcgisportal.surtigas.com.co/geaportal/sharing/generateToken?request=getToken&serverUrl=https%3A%2F%2Farcgisportal.surtigas.com.co%2Fgeaportal%2Fsharing%2Fservers%2Fa4c5837128a3482f89823d843cc26dde%2Frest%2Fservices%2FIngenieria%2FRedGas%2FFeatureServer%2F34&token=$token&referer=arcgisportal.surtigas.com.co&f=json";
        $response = Http::withoutVerifying()
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
            ])
            ->withOptions([
                'version' => 2.0,
                'proxy' => [
                    'http'  => $proxy,
                    'https' => $proxy,
                ],
                'force_ip_resolve' => 'v4',
                // 'curl' => [
                //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                //     CURLOPT_HTTPPROXYTUNNEL => true,
                //     CURLOPT_SSLVERSION   => CURL_SSLVERSION_TLSv1_2,
                // ],
            ])
            ->get($url);
        $data = $response->json();
         Log::info('Token update.');
        Cache::put('gis_token', $data['token'], Carbon::createFromTimestampMs($data['expires']));
        return $data['token']; // Return the token
    }
}
