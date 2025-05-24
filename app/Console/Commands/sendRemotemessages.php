<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
class sendRemotemessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:remotebirthdaymessage';

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


        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://pcgebenezer.com/api/v1/remote-send-message');
        $response = $response->getBody()->getContents();
        return 0;
    }
}
