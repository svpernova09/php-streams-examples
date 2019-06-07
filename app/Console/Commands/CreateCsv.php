<?php

namespace App\Console\Commands;

use Faker\Factory;
use Illuminate\Console\Command;

class CreateCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CSV';

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
        $fp = fopen('file.csv', 'w');
        $faker = Factory::create();

        $i = 0;
        $bar = $this->output->createProgressBar(5000000);

        $bar->start();
        do {
            $user = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->companyEmail,
                'phone' => $faker->phoneNumber,
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'country' => $faker->country,
            ];
            fputcsv($fp, $user);
            $bar->advance();
            $i++;
        } while ($i < 5000000);

        fclose($fp);
        $bar->finish();
    }
}
