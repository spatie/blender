<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::withDoubleEncoding();

        $this->addComposer('*', \App\Http\ViewComposers\Shared\GlobalViewComposer::class);
        $this->addComposer('*.layouts.*', \App\Http\ViewComposers\Shared\EncryptedCsrfTokenComposer::class);

        $this->addComposer('front.layouts.*', \App\Http\ViewComposers\Front\SeoViewComposer::class);

        Blade::directive('svg', function ($expression) {
            return "<?php echo svg({$expression}); ?>";
        });
    }

    protected function addComposer($views, $callback)
    {
        View::composer($views, $callback);
    }
}
