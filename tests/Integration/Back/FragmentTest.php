<?php

namespace App\Test\Integration\Back;

use App\Models\Fragment;
use FragmentSeeder;

class FragmentTest extends BackTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->fragments = (new FragmentSeeder())->seedRandomFragments(10);
    }

    /**
     * @test
     */
    public function it_displays_a_list_of_all_fragments()
    {
        $this->visit(action('Back\FragmentController@index'))
            ->see(trans('back-fragments.title'));

        foreach ($this->fragments as $fragment) {
            $this->see($fragment->name);
        }
    }

    /**
     * @test
     */
    public function it_can_edit_a_fragment()
    {
        $fragment = $this->fragments->first();

        $this
            ->visit(action('Back\FragmentController@index'))
            ->click($fragment->name)
            ->onPage(action('Back\FragmentController@edit', [$fragment->id]))
            ->press(trans('back-fragments.save'))
            ->see(trans('back.events.updated', ['model' => 'Fragment', 'name' => $fragment->name]))
            ->onPage(action('Back\FragmentController@edit', [$fragment->id]));
    }
}
