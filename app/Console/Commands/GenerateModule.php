<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateModule extends Command
{
    protected $signature = 'module:generate {singular} {plural?}';

    protected $description = 'Generate a Blender module.';

    public function handle()
    {
        $singular = ucfirst($this->argument('singular'));
        $plural = ucfirst($this->argument('plural') ?: $singular.'s');

        $script = base_path("app/Console/Scripts/modulegenerator.sh {$singular} {$plural}");

        $this->info(shell_exec($script));
    }
}
