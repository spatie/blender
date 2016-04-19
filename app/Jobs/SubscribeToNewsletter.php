<?php

namespace App\Jobs;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use Spatie\Newsletter\Interfaces\NewsletterInterface;

class SubscribeToNewsletter extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(NewsletterInterface $newsletter)
    {
        Log::info("subscribing {$this->user->email} to the newsletter");

        try {
            $newsletter->subscribe($this->user->email, [], 'subscribers');

            Log::info("subscribed {$this->user->email} to the newsletter");
        } catch(Exception $e) {
            Log::warning("could not subscribe {$this->user->email} to the newsletter because {$e->getMessage()}");
        }


    }
}
