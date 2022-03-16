<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        //log all laravel queries
        \DB::listen(function ($event) {
            $bindings = $event->bindings;
            $time = $event->time/1000;
            $query = $event->sql;
            // $data = compact('bindings', 'time');
            if($time > 3) // Print query takes maore than 3 seconds
            {
                // Format binding data for sql insertion
                foreach ($bindings as $i => $binding) {
                    if (is_object($binding) && $binding instanceof \DateTime) {
                        $bindings[$i] = '\'' . $binding->format('Y-m-d H:i:s') . '\'';
                    } elseif (is_null($binding)) {
                        $bindings[$i] = 'NULL';
                    } elseif (is_bool($binding)) {
                        $bindings[$i] = $binding ? '1' : '0';
                    } elseif (is_string($binding)) {
                        $bindings[$i] = "'{$binding}'";
                    }
                }
                $query = preg_replace_callback('/\\?/', function () use(&$bindings) {
                    return array_shift($bindings);
                }, $query);

                \Storage::disk('local')->append('queryLog.txt', 'Executed at : '. date('Y-m-d H:i a') . ' | ExecutionTime : '.$time .PHP_EOL .$query .PHP_EOL);
            }

        });
    }
}

