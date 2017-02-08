<?php

namespace App\Services\Html;

use Spatie\Html\Elements\Div;
use Spatie\Html\HtmlElement;

class Blender
{
    /** @var \App\Services\Html\Html */
    protected $html;

    public function __construct(Html $html)
    {
        $this->html = $html;
    }

    public function text(string $name, string $label): Div
    {
        return $this->formGroup($name, $label, $this->html->text($name));
    }

    public function redactor(string $name, string $label): Div
    {
        return $this->formGroup($name, $label, $this->html->redactor($name));
    }

    public function formGroup(string $name, string $label, HtmlElement $contents): Div
    {
        return $this->html->div()
            ->class('form__group')
            ->children([
                $this->html->label(__($label), $name),
                $contents,
            ]);
    }
}
