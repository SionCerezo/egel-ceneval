<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_TIME, config('app.locale'));

        Blade::directive('attribute', function ($expression) {
            return $this->attributeDirective($expression);
        });
    }

    private function attributeDirective($expression) {
        $attrName = strtok($expression, " ,");
        $arg2 = strtok('\0');
        $value = $arg2===false ? "$$attrName" : $arg2;
        return "<?php \$tmp_val=$value; if( !empty(\$tmp_val) ) echo \"$attrName='\$tmp_val'\"; ?>";
    }
}
