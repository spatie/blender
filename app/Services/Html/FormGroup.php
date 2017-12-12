<?php

namespace App\Services\Html;

use Spatie\Html\Elements\Div;
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
        return $this->assemble($name, $label, $this->html->category($name, $this->required));
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

    public function contentBlocks(string $collection, string $label, array $fields = []): Div
    {
        return $this->assemble($collection, $label, $this->html->contentBlocks($collection, $fields));
    }

    public function date(string $name, string $label): Div
    {
        return $this->assemble($name, $label, $this->html->date($name));
    }

    public function email(string $name, string $label): Div
    {
        return $this->assemble($name, $label, $this->html->email($name));
    }

    public function map(string $name, string $label): Div
    {
        return $this->assemble($name, $label, $this->html->map($name));
    }

    public function media(string $collection, string $type, string $label, array $associated = []): Div
    {
        return $this->assemble($collection, $label, $this->html->media($collection, $type, $associated));
    }

    public function relatedModelsSelect(string $name, string $label, string $nameProperty = 'name', ?iterable $models = null): Div
    {
        return $this->assemble($name, $label, $this->html->associatedModelsSelect($name, $nameProperty, $models));
    }

    public function password(string $name, string $label): Div
    {
        return $this->assemble($name, $label, $this->html->password($name));
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
            $this->html->button($value, 'submit')->class('button'),
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

    public function textarea(string $name, string $label): Div
    {
        return $this->assemble($name, $label, $this->html->textarea($name));
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
            $this->html->label(__($label), $name)->class($this->required ? 'label--required' : ''),
            $contents,
            $this->html->errorFor($name),
        ]);
    }
}
