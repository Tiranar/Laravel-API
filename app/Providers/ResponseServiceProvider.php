<?php
// Place this file on the Providers folder of your project
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\ResponseFactory;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('success', function ($data = null, $message = '', $status = 200) use ($factory) {
            $format = [
                'status' => $status,
                'message' => $message,
                'pkg' => $data,
            ];

            return $factory->make($format);
        });

        $factory->macro('error', function ($errors = [], string $message = '', $status = 'error') use ($factory){
            $format = [
                'status' => $status, 
                'message' => $message,
                'errors' => $errors,
            ];

            return $factory->make($format);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}