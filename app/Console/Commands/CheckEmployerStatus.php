<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CheckEmployerStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employer:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check employer status';

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
     * @return int
     */
    public function handle()
    {
        
        $employers = User::where('id', '114')->first();
        $employers->name = 'checkCommand';
        $employers->save();

    }
}
