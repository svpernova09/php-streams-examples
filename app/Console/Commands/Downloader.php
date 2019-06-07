<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Downloader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ex:iso';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download an ISO';

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
        $handle = fopen(
            'http://releases.ubuntu.com/19.04/ubuntu-19.04-live-server-amd64.iso',
            'rb'
        );
        $destination = fopen(__DIR__ . '/ubuntu-19.04-live-server-amd64.iso', 'w');
        stream_copy_to_stream($handle, $destination);
    }
}
