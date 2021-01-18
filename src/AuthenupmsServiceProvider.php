<?php

//namespace App\Providers;
namespace John\Authenupms;

use John\Authenupms\Console\InstallAuthenupms;
use Illuminate\Support\ServiceProvider;

class AuthenupmsServiceProvider extends ServiceProvider
{
    /**
     * 服务提供者加是否延迟加载
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * 绑定服务容器中的内容
     *
     * @return void
     */
    public function register()
    {
        // 单例绑定服务
        $this->app->singleton('packagetest', function ($app) {
            return new AuthenupmsServiceProvider($app['session'], $app['config']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'Packagetest'); // 视图目录指定
        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/packagetest'), // 发布视图目录到 resource 下
            __DIR__ . '/config/packagetest.php' => config_path('packagetest.php'), // 发布配置文件到 laravel 的 config 下
        ]);

        // 在服务提供者中这册命令
        if ($this->app->runningInConsole()) { // 检查应用程序是否在控制台中运行
            // 发布的配置文件
            // 注册 'artisan' 命令
            $this->commands([
                InstallAuthenupms::class,
            ]);
            //
            if (!class_exists('CreateUsersTable')) { // 检查用户是否已经发布了迁移
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_users_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_users_table.php'),
                    // 这里可以添加更多的迁移
                ], 'migrations');
            }
        }
    }

    public function provides()
    {
        // 因为延迟加载，所以要定义 provides 函数，具体参考 laravel 文档
        return ['authenupms'];
    }
}
