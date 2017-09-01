<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerRegexFunctionForSqlite();
    }

    private function registerRegexFunctionForSqlite()
    {
        if (config('database.default') !== 'sqlite') {
            return;
        }

        DB::getPdo()->sqliteCreateFunction(
            'regexp',
            function ($pattern, $data, $delimiter = '~', $modifiers = 'isuS') {
                if (isset($pattern, $data) !== true) {
                    return;
                }

                return preg_match(sprintf('%1$s%2$s%1$s%3$s', $delimiter, $pattern, $modifiers), $data) > 0;
            }
        );
    }
}
