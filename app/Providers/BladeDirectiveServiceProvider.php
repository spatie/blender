<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeDirectiveServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Blade::directive('json', function($expression) {
            return "<?php echo json_encode({$expression}); ?>";
        });
    }
}
