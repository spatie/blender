<?php

namespace App\Services\Html;

use Illuminate\Support\ViewErrorBag;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Label;
use Spatie\Html\HtmlElement;

class FormGroup
{
    /** @var \App\Services\Html\Html */
    protected $html;

    /** @var bool */
    protected $required = false;

    public function __construct(Html $html)
    {
        $this->html = $html;
    }

    /**
     * @return static
     */
    public function required()
    {
        $formGroup = clone $this;

        $formGroup->required = true;

        return $formGroup;
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
                ->html($this->html->checkbox($name)->class('form-control').' '.__($label).($this->required ? '*' : ''))
                ->class('-checkbox'),
        ]);
    }

    public function date(string $name, string $label): Div
    {
        return $this->assemble($name, $label, $this->html->date($name));
    }

    public function email(string $name, string $label): Div
    {
        return $this->assemble($name, $label, $this->html->email($name));
    }

    public function redactor(string $name, string $label): Div
    {
        return $this->assemble($name, $label, $this->html->redactor($name));
    }

    public function searchableSelect(string $name, string $label, iterable $options): Div
    {
        return $this->assemble($name, $label, $this->html->searchableSelect($name, $options));
    }

    public function select(string $name, string $label, iterable $options): Div
    {
        return $this->assemble($name, $label, $this->html->select($name, $options));
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

    public function withContents($contents): Div
    {
        return $this->wrapper()->children($contents);
    }

    protected function wrapper(): Div
    {
        return $this->html->div()->class('form__group');
    }

    protected function assemble(string $name, string $label, HtmlElement $contents): Div
    {
        return $this->wrapper()->children([
            $this->html->label(__($label).($this->required ? '*' : ''), $name),
            $contents,
            $this->html->error($this->errors()->first($name)),
        ]);
    }

    protected function errors(): ViewErrorBag
    {
        return session('errors', new ViewErrorBag());
    }
}
