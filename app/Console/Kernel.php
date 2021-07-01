<?php

namespace App\Console;

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
        //

        Commands\CheckEmployerStatus::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule1(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('employer:status')
            ->everyMinute();
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

    // Scheduling for autobackup of full laravel application including the database.
    protected function schedule(Schedule $schedule)
    {
       // $schedule->command('backup:clean')->daily()->at('01:00');

       $schedule->command('backup:run')->daily();

      //  $schedule
      // ->command('backup:run')->daily()->at('17:07')
      // ->onFailure(function () {
        
      // })


      // ->onSuccess(function () {
        
      // });
    }


}
