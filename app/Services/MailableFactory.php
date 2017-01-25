<?php

namespace App\Services;

use Exception;
use ReflectionClass;
use ReflectionParameter;
use Illuminate\Contracts\Mail\Mailable;

class MailableFactory
{
    /** @var string */
    public $mailableClass;

    public static function create(string $mailableClass): Mailable
    {
        return (new static ($mailableClass))->getInstance();
    }

    public function __construct(string $mailableClass)
    {
        if (! class_exists($mailableClass)) {
            throw new Exception("Class `{$mailableClass}` does not exist.");
        }

        $this->mailableClass = $mailableClass;
    }

    public function getInstance(): Mailable
    {
        $argumentValues = $this->getArguments();

        return new $this->mailableClass(...$argumentValues);
    }

    public function getArguments()
    {
        $parameters = (new ReflectionClass($this->mailableClass))
            ->getConstructor()
            ->getParameters();

        return collect($parameters)
            ->map(function (ReflectionParameter $reflectionParameter) {
                return $this->getArgumentValue($reflectionParameter->getType()->getName());
            });
    }

    protected function getArgumentValue(string $type)
    {
        if ($type === 'int') {
            return faker()->numberBetween(1, 100);
        }

        if ($type === 'string') {
            return faker()->sentence;
        }

        if ($type === 'bool') {
            return faker()->sometimes();
        }

        if (starts_with($type, 'App\Models')) {
            return $this->getModel($type);
        }

        return app($type);
    }

    protected function getModel(string $modelClass)
    {
        $model = app($modelClass)->first();

        if (! $model) {
            throw new Exception("Could not find a model of class `{$modelClass}`.");
        }

        return $model;
    }
}
