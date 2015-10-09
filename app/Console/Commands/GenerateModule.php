<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateModule extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'module:generate {singular} {plural?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Blender module.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $singular = ucfirst($this->argument('singular'));
        $plural = ucfirst($this->argument('plural') ?: $singular.'s');

        $script = base_path("app/Console/Scripts/modulegenerator.sh {$singular} {$plural}");

        $this->info(shell_exec($script));
    }
}
