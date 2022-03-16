<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Illuminate\Support\Facades\Cache;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\CheckNewBpApiAndRunCron::class,
        \App\Console\Commands\CheckNewSfApiAndRunCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        \Storage::put('cron_log.txt', 'Cron called at: ' . now());
        $schedule->command('Cron:CheckNewBpApiAndRunCron')->cron('*/2 * * * *');
        $schedule->command('Cron:CheckNewSfApiAndRunCron')->cron('*/2 * * * *');

		$instance_count = 1;
		$users = Cache::remember('cron_user_data', (40*60), function () {
            return DB::table('users')->select('org_id','id')->where(['status'=>1,'category'=>'Admin'])->get();
        });

		foreach($users as $uk => $uv){

            $bp_info = Cache::remember('cron_brightpearl_info_'.$uv->org_id, (30*60), function () use($uv) {
                $params_bp = ['api_config.organization_id'=>$uv->org_id,'api_config.status'=>1,'api_config.sync_completed'=>1,'api_config.api_provider'=>'brightpearl']; // ,'sync_started'=>0
                return DB::table('api_config')->where($params_bp)->select('api_config.organization_id')->first();
            });

            $sf_info = Cache::remember('cron_shopify_info_'.$uv->org_id, (30*60), function () use($uv) {
                $params_sf = ['api_config.organization_id'=>$uv->org_id,'api_config.status'=>1,'api_config.sync_completed'=>1,'api_config.api_provider'=>'shopify']; // ,'sync_started'=>0
                return DB::table('api_config')->where($params_sf)->select('api_config.organization_id')->first();
            });

            for($ci=1;$ci<=$instance_count;$ci++){

                if($bp_info && $sf_info){ // If Shopify & Brightpearl ac is Active & Initial sync completed

                    $schedule->call('App\Http\Controllers\ShopifyController@syncProductsInSF', [$uv->org_id])->name('syncProductsInSF' . $uv->org_id)->withoutOverlapping()->cron('*/2 * * * *');

                }

            }
        }

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
