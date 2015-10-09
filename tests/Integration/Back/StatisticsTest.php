<?php

namespace App\Test\Integration\Back;

class StatisticsTest extends BackTestCase
{
    /**
     * @test
     */
    public function it_can_display_the_statistics()
    {
        $this
            ->visit(action('Back\StatisticsController@index'))
            ->see(trans('back-statistics.title'));
    }
}
