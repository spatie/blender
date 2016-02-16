<?php

namespace App\Services\Navigation;

class Section
{
    public function section() : string
    {
        if(request()->segment(1) === 'blender') {
            return 'back';
        }

        return 'front';
    }

    public function isFront() : bool
    {
        return $this->section() === 'front';
    }

    public function isBack() : bool
    {
        return $this->section() === 'back';
    }
}
