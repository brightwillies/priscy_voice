<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sendMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:birthdaymessage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        // sendSms('233241849088', generate_random_password());
        // sendSms('233241849088', 'testing cron message'. generate_mask());
    }
}
