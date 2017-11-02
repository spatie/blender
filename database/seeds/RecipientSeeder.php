<?php

use App\Models\Recipient;

class RecipientSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->truncate((new Recipient())->getTable());

        Recipient::create([
            'form' => 'contactForm',
            'email' => 'technical@spatie.be',
            'draft' => false,
        ]);
    }
}
