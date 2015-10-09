<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Slack;

class SendSlackMessage extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'slack {message} {--channel=#deployments} {--icon=blender} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a message to slack.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Slack::to($this->option('channel'))
            ->withIcon(':'.$this->option('icon').':')
            ->send($this->argument('message'));
    }
}
