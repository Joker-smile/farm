<?php

namespace App\Console;
use App\Entities\User;
use App\Entities\Subscribe;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            $user=new User();
            $subscribe=new Subscribe();
            $result=$subscribe->get();
            $users=$user->get();
            for($i=0;$i<count($result);$i++){
                if (strtotime($result[$i]->expired_at)<time()&&$result[$i]->status!='expired'&&$result[$i]->status!='unpaid'){
                    $result[$i]->status='expired';
                    $result[$i]->save();
                    for ($j=0;$j<count($users);$j++){
                        if ($users[$j]->id==$result[$i]->user_id){
                            $users[$j]->balance+=$result[$i]->total;
                            $users[$j]->trees=$users[$j]->trees+$result[$i]->count;
                            $users[$j]->update();
                        }
                    }
                }
            }
        })->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
