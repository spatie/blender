<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->addComposer('*', \App\Http\ViewComposers\Shared\GlobalViewComposer::class);
        $this->addComposer('*._layouts.*', \App\Http\ViewComposers\Shared\EncryptedCsrfTokenComposer::class);

        $this->addComposer('front._layouts.*', \App\Http\ViewComposers\Front\SeoViewComposer::class);

        Blade::directive('svg', function ($expression) {
            return "<?php echo svg({$expression}); ?>";
        });
    }

    protected function addComposer($views, $callback)
    {
        View::composer($views, $callback);
    }
}
