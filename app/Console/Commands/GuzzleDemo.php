<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class GuzzleDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ex:guzzle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Guzzle Demo';

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
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://tek.phparch.com/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $response = $client->request(
            'GET',
            'wp-json/wp/v2/posts');

        if($response->getStatusCode() !== '200') {
            $type = $response->getHeader('Content-Type');

            if (!strpos($type[0], 'application/json')) {
                // Body should be JSON, Probably safe to pull down in one go
                $posts = json_decode($response->getBody(), true);

                dd($posts);
            }
        }
    }
}
