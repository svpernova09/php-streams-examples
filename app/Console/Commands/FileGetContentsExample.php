<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FileGetContentsExample extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ex:readppl {needle?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read CSV Stream';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $people = [];
        $file = fopen('10mill.csv', "r");
        $needle = $this->argument('needle');

        while(!feof($file)) {
            $line = trim(fgets($file));

            if (strpos($line, $needle) !== false) {
                $people[] = str_getcsv($line);
            }
        }

        fclose($file);

        if (!empty($people)) {
            $this->info('Found ' . count($people) . ' Matches');
            $this->info(var_dump($people['0']));
        }

        function formatBytes($bytes, $precision = 2) {
            $units = array("b", "kb", "mb", "gb", "tb");

            $bytes = max($bytes, 0);
            $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
            $pow = min($pow, count($units) - 1);

            $bytes /= (1 << (10 * $pow));

            return round($bytes, $precision) . " " . $units[$pow];
        }

        print formatBytes(memory_get_peak_usage());
    }









    //        $fp = fopen('file.csv', 'w');
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }







//
//        $url = 'https://google.com';
//
//        $response = file_get_contents($url);
//        dd($response);
//    }
}
