<?php

namespace App\Services\Html;

use Spatie\Html\Elements\Div;
use Spatie\Html\HtmlElement;

class FormGroup
{
    /** @var \App\Services\Html\Html */
    protected $html;

    public function __construct(Html $html)
    {
        $this->html = $html;
    }

    public function category(string $name, string $label): Div
    {
        return $this->assemble($name, $label, $this->html->category($name));
    }

    public function checkbox(string $name, string $label): Div
    {
        return $this->wrapper()->children([
            $this->html->label()
                ->for($name)
                ->html($this->html->checkbox($name).' '.__($label)),
        ]);
    }

    public function redactor(string $name, string $label): Div
    {
        return $this->assemble($name, $label, $this->html->redactor($name));
    }

    public function submit(string $value): Div
    {
        return $this->wrapper()->children([
            $this->html->submit($value)->class('button'),
        ]);
    }

    public function tags(string $name, string $label): Div
    {
        return $this->assemble($name, $label, $this->html->tags($name));
    }

    public function text(string $name, string $label): Div
    {
        return $this->assemble($name, $label, $this->html->text($name));
    }

    public function wrapper(): Div
    {
        return $this->html->div()->class('form__group');
    }

    protected function assemble(string $name, string $label, HtmlElement $contents): Div
    {
        return $this->wrapper()->children([
            $this->html->label(__($label), $name),
            $contents,
            $this->html->error($this->html->errors()->first($name)),
        ]);
    }
}
