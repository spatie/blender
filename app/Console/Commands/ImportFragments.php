<?php

namespace App\Console\Commands;

use App\Models\Fragment;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;

class ImportFragments extends Command
{
    protected $signature = 'fragments:import {--update : Update the existing fragments}';

    protected $description = 'Import Blender fragments';

    public function handle()
    {
        $root = database_path('seeds/fragments');

        $fragments = collect()->glob("{$root}/*.yml")->map(function (string $path) use ($root) {
            $fragments = Yaml::parse(file_get_contents($path));

            $group = Str::before(Str::after($path, "{$root}/"), '.yml');

            return $this->importFragmentGroup($group, $fragments);
        });

        Fragment::query()
            ->whereNotIn('id', $fragments->pluck('id'))
            ->where('image', false)
            ->delete();
    }

    private function importFragmentGroup(string $group, array $fragments)
    {
        return collect($fragments)->map(function (array $attributes, string $key) use ($group) {
            $fragment = Fragment::firstOrNew(['group' => $group, 'key' => $key]);

            if ($fragment->exists && ! $this->option('update')) {
                return $fragment;
            }

            $translations = Arr::except($attributes, ['html', 'description']);

            foreach ($translations as $locale => $text) {
                $fragment->setTranslation($locale, $text ?: '');
            }

            $fragment->html = $attributes['html'] ?? $this->translationsContainHtml($translations);
            $fragment->description = $attributes['description'] ?? null;

            $fragment->save();

            return $fragment;
        })->values();
    }

    private function translationsContainHtml(array $translations): bool
    {
        foreach ($translations as $translation) {
            if ((string) $translation !== strip_tags($translation)) {
                return true;
            }
        }

        return false;
    }
}
