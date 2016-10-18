<?php

namespace App\Console\Commands;

use App\Jobs\SendReminderEmail;
use Illuminate\Console\Command;
use Queue;
use Symfony\Component\Console\Input\InputArgument;

class ClearBeanstalkdQueue extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'queue:beanstalkd:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear a Beanstalkd queue, by deleting all pending jobs.';

    /**
     * Defines the arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            ['queue', InputArgument::OPTIONAL, 'The name of the queue to clear.'],
        ];
    }

    /**
     * Execute the console command.
     */
    public function fire()
    {
        $queue = ($this->argument('queue')) ?
            $this->argument('queue') :
            config('queue.connections.beanstalkd.queue');

        $this->info(sprintf('Clearing queue: %s', $queue));

        $pheanstalk = Queue::getPheanstalk();
        $pheanstalk->useTube($queue);
        $pheanstalk->watch($queue);

        while ($job = $pheanstalk->reserve(0)) {
            $pheanstalk->delete($job);
        }

        $this->info('...cleared.');
    }
}
