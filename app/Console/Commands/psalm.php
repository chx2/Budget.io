<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class psalm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'psalm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the Psalm static analysis tool';

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
     * @return void
     */
    public function handle()
    {
        exec('./vendor/bin/psalm');
    }
}
