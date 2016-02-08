<?php

namespace App\Http;

use Illuminate\Http\Request as BaseRequest;

class Request extends BaseRequest
{
    protected function section() : string
    {
        if($this->segment(1) === 'blender') {
            return 'back';
        }

        return 'front';
    }

    public function isForFront() : bool
    {
        return $this->section() === 'front';
    }

    public function isForBack() : bool
    {
        return $this->section() === 'back';
    }
}
