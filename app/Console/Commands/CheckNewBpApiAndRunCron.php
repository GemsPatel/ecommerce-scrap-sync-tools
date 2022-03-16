<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class CheckNewBpApiAndRunCron extends Command
{

    public static $provider_bp = "brightpearl";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Cron:CheckNewBpApiAndRunCron';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'This file Checks for new Brightpearl api connection and runs api calls for it.';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
    parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
        set_time_limit(0);

        app('App\Http\Controllers\BrightpearlController')->sendAcSyncedEmail(); // Check if any other sync completed then send mail

        $bp_info = DB::table('api_config')->leftJoin('users','users.id','=','api_config.organization_id')
        ->where('users.status','=',1)
        ->where(['api_config.api_provider'=>self::$provider_bp,'api_config.status'=>1,'api_config.sync_ac'=>1])
        ->select('api_config.id', 'api_config.organization_id', 'api_config.pre_initial_sync')->get();

        foreach($bp_info as $shk => $shv){
            DB::table('api_config')->where(['id'=>$shv->id])->update(['sync_ac' => 0]);
            if($shv->pre_initial_sync == 0){
                app('App\Http\Controllers\BrightpearlController')->preInitialSync($shv->organization_id);
            }else{
                app('App\Http\Controllers\BrightpearlController')->bpFetchUserInitialData($shv->organization_id);
            }
        }

        app('App\Http\Controllers\BrightpearlController')->sendAcSyncedEmail();  // Check if any other sync completed then send mail
    }

}
