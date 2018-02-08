<?php

namespace Unit;

use App\Models\Traits\Draftable;
use App\Models\Traits\HasMedia;
use PHPUnit\Framework\TestCase;

class classHasTraitTest extends TestCase
{
    /** @test */
    public function it_knows_whether_a_class_has_a_trait_or_not()
    {
        $model = new class {
            use Draftable;
        };

        $this->assertTrue(class_has_trait($model, Draftable::class));
        $this->assertFalse(class_has_trait($model, HasMedia::class));
    }
}
