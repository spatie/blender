<?php

namespace App\Http;

use Illuminate\Http\Request as BaseRequest;

class Request extends BaseRequest
{
    public function section() : string
    {
        if($this->segment(1) === 'blender') {
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
