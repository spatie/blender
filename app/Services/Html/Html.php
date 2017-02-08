<?php

namespace App\Services\Html;

use App\Models\Tag;
use App\Services\Auth\User;
use Exception;
use Illuminate\Support\ViewErrorBag;
use Spatie\Html\Elements\A;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Span;
use Spatie\Html\Elements\Textarea;

class Html extends \Spatie\Html\Html
{
    /** @var string */
    protected $locale = null;

    /**
     * @param string $locale
     *
     * @return static
     */
    public function locale(string $locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return static
     */
    public function endLocale()
    {
        $this->locale = null;

        return $this;
    }

    public function translations(callable $callback)
    {
        $fieldsets = locales()->map(function ($locale) use ($callback) {
            return $this
                ->locale($locale)
                ->fieldset()
                ->addChild($this->legend($locale)->class('legend__lang'))
                ->addChildren($callback($this));
        });

        $this->endLocale();

        return $this->div()->children($fieldsets);
    }

    public function alert(string $type, string $message): Div
    {
        return $this->div()
            ->class(['alert', "-{$type}"])
            ->text($message);
    }

    public function flashMessage(): ?Div
    {
        if (
            ! $this->request->session()->get('flash_notification.level') ||
            ! $this->request->session()->get('flash_notification.message')
        ) {
            return null;
        }

        return $this->alert(
            $this->request->session()->get('flash_notification.level'),
            $this->request->session()->get('flash_notification.message')
        );
    }

    public function error(?string $message, string $field = ''): ?Div
    {
        if (! $message) {
            return null;
        }

        return $this->alert('danger', $message)
            ->attributeIf($field, 'data-validation-error', $field);
    }

    public function message($message): Div
    {
        return $this->alert('success', $message);
    }

    public function info($message): Div
    {
        return $this->alert(
            'info',
            $this->icon('info-circle').' '.$message
        );
    }

    public function warning($message): Div
    {
        return $this->alert(
            'warning',
            $this->icon('exclamation-triangle').' '.$message
        );
    }

    public function icon(string $icon): Span
    {
        return $this->span()->class("fa fa-{$icon}");
    }

    public function avatar(User $user): Span
    {
        return $this->span()
            ->class('avatar')
            ->attribute('style', "background-image: url('{$user->avatar}')");
    }

    public function onlineIndicator(bool $online): Span
    {
        return $this->icon($online ? 'circle' : 'circle-o')
            ->class($online ? 'on' : 'off');
    }

    public function backToIndex(string $action, array $parameters = []): A
    {
        return $this->a(
            action($action, $parameters),
            fragment('back.backToIndex')
        )->class('breadcrumb--back');
    }

    public function redactor(string $name = '', string $value = ''): Textarea
    {
        $this->ensureModelIsAvailable();

        $medialibraryUrl = action(
            'Back\Api\MediaLibraryController@add',
            [class_basename($this->model), $this->model->id, 'redactor']
        );

        return $this->textarea($name, $value)
            ->attributes([
                'data-editor',
                'data-editor-medialibrary-url' => $medialibraryUrl,
            ]);
    }

    public function datePicker(string $name = '', string $value = ''): string
    {
        return $this->text($name, $value)
            ->attribute('data-datetimepicker')
            ->class('-datetime');
    }

    public function category(string $type)
    {
        $this->ensureModelIsAvailable();

        return $this->select(
            "{$type}_tags[]",
            Tag::getWithType($type)->pluck('name', 'name'),
            $this->model->tagsWithType($type)->pluck('name', 'name')
        );
    }

    public function tags(string $type)
    {
        return $this->category($type)->attributes(['multiple', 'data-select' => 'tags']);
    }

    public function old(string $name = '', string $value = '')
    {
        $value = parent::old($name, $value);

        if ($value instanceof Carbon) {
            return $value->format('d/m/Y');
        }

        return $value;
    }

    public function blender(): FormGroup
    {
        return new FormGroup($this);
    }

    public function formGroup(): FormGroup
    {
        return new FormGroup($this);
    }

    public function errors(): ViewErrorBag
    {
        return $this->request->session()->get('errors', new ViewErrorBag());
    }

    protected function ensureModelIsAvailable()
    {
        if (empty($this->model)) {
            throw new Exception('Method requires a model to be set on the html builder');
        }
    }
}
