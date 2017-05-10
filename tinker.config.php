<?php

/**
 * Automatically alias Laravel Model's to their base classname.
 * Ex: "App\Models\User" now can just be accessed by "User"
 */
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

if (!function_exists('aliasModels')) {
    function aliasModels()
    {
        collect((new Finder())->files()->name('*.php')->in(base_path() . '/app/Models'))
            ->map(function (SplFileInfo $file) {
                $name = determineAliasModelClass($file);

                return compact('file', 'name');
            })
            ->filter(function (array $class) {
                $r = new ReflectionClass($class['name']);

                return $r->isSubclassOf('Illuminate\\Database\\Eloquent\\Model');
            })
            ->each(function (array $class) {
                try {
                    class_alias($class['name'], $class['file']->getBasename('.php'));
                } catch (Exception $e) {
                }
            });
    }
}

function determineAliasModelClass(SplFileInfo $file): string
{
    $namespace = 'App\\Models\\';

    if ($relativePath = $file->getRelativePath()) {
        $namespace .= strtr($relativePath, '/', '\\') . '\\';
    }

    $class = $namespace . $file->getBasename('.php');

    return $class;
}

aliasModels();

return [
    'startupMessage' => '<info>Using local config file (tinker.config.php)</info>',
];