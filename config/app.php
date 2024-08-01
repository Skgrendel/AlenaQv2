<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'gis_api_token' => 'https://arcgisportal.surtigas.com.co/geaserver/rest/services/Ingenieria/FC_PTDIRECCIONES/MapServer/0/query?f=json&where=(SUBSCRIPTION_ID%20IS%20NOT%20NULL)%20AND%20(SUBSCRIPTION_ID%20%3D%20336917)&returnGeometry=true&spatialRel=esriSpatialRelIntersects&outFields=OBJECTID%2CORDEN%2CRID%2COBJECTID_1%2CDEPARTAMENTO%2CLOCALIDAD%2CNOMBRE%2CADDRESS_ID%2CID_PREMISE%2CNUP%2CDIRECCION%2CTAG%2CANILLADO%2CTIPOPREDIO%2CCICLO%2CDESCRIPCION%2CBARRIO%2CNOMBREBARRIO%2CCATEGORIA%2CDESCATEGORIA%2CESTRATO%2CPRODUCT_ID%2CPRODUCT_STATUS_ID%2CESTADOPRODUCTO%2CSUBSCRIPTION_ID%2CDESCESTADOCORTE%2CCODIDOESTADOCORTE%2CNOMBREUSUARIO%2CAPELLIDO%2CELEMENTOMEDICION%2CORIG_FID&outSR=102100&resultOffset=0&resultRecordCount=1000&token=fjnygukgg4Ib-IzsfLUL0CencSZ4TiCD1HjNlkSNpsQ50oH292Rj9mxQRa97SkNlIRQfMhtQk0KEhMzzcOeIQebIleihUysgB16MZh-tbjOsERkLd6Lkwb_OVfnZEwIiAOlQNzU-HBeSuC46cbFz8SF9kHZRf3BaDDoSqPi9UHyR8_4DG848D1YQVefmZfHdsBZrdysUTNaqJuPjhjosHYYg6HycAa5mAVOkm4Xt47iPMIwjiVlsQj-ngPPmubTz19z1Ybt_tr8bpas_LTXEpQ..',
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => env('APP_TIMEZONE'),

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => env('APP_LANG'),

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store' => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Maatwebsite\Excel\ExcelServiceProvider::class,
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,
        // 'Example' => App\Facades\Example::class,
    ])->toArray(),

];
