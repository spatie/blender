<?php

namespace App\Test\Integration\Back;

class DashboardTest extends BackTestCase
{
    /**
     * @test
     */
    public function it_can_display_the_dashboard()
    {
        $this
            ->visit(route('dashboard'))
            ->see('Dashboard')
            ->see($this->currentUser->email);
    }
}
