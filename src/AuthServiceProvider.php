<?php

namespace Baiming\Authsteam;

use Baiming\Authsteam\Console\InstallPackage;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        if ($this->app->runningInConsole()) { // 检查应用程序是否在控制台中运行

            // 注册 'artisan' 命令
            $this->commands([
                InstallPackage::class
            ]);
        }
    }
}
