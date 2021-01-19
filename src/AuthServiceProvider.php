<?php

/**
 * Auth：baiming
 * Date：2021-01-19
 *
 * 所有的服务提供者都继承自 Illuminate\Support\ServiceProvider 类
 */

namespace Baiming\Authsteam;

use Baiming\Authsteam\Console\InstallPackage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * 如果你的服务提供者注册了很多简单的绑定，你可能希望使用 bindings 和 singletons 属性来替代手动注册每个容器绑定以简化代码。
     * 当服务提供者被框架加载后，会自动检查这些属性并注册相应绑定
     */

    // 所有应注册的容器绑定
    public $bindings = [];

    // 所有应注册的容器单例
    public $singletons = [];

    public function register()
    {
        /**
         * 在 register 方法中，唯一要做的事情就是绑定服务到"服务容器"，不要做其他事情
         * 在任何服务提供者方法中，都可以通过 $app 属性来访问服务容器
         *
         * 绑定
         * bind（简单绑定）：注册一个绑定，该方法需要两个参数：第一个参数是我们想要注册的类名或接口名称，第二个参数是返回类的实例的闭包
         * singleton（绑定一个单例）：绑定一个只会解析一次的类或接口到容器，然后接下来对容器的调用将会返回同一个对象实例
         * instance（绑定实例）：绑定一个已存在的对象实例到容器，随后调用容器将总是返回给定的实例
         * extend（扩展绑定）：允许对解析服务进行修改。例如，当服务被解析后，可以运行额外代码装饰或配置该服务。extend 方法接收一个闭包来返回修改后的服务，该闭包接收待解析的服务和容器实例作为参数
         *
         * 解析
         * make：该方法接收你想要解析的类名或接口名作为参数
         * resolve：如果你所在的代码位置访问不了 $app 变量，可以使用辅助函数resolve
         * makeWith：某些类的依赖不能通过容器来解析，你可以通过关联数组方式将其传递传递到 makeWith 方法来注入
         *
         * 容器事件
         * resolving：服务容器在每一次解析对象时都会触发一个事件，可以使用 resolving 方法监听该事件
         */
    }

    public function boot()
    {
        /**
         * 在 boot 方法中对依赖进行类型提示，"服务容器"会自动注入所需要的依赖
         * 初始化某些路由或添加事件侦听器
         */

//        if ($this->app->runningInConsole()) { // 检查应用程序是否在控制台中运行
//
//            // 注册 'artisan' 命令
//            $this->commands([
//                InstallPackage::class
//            ]);
//        }
        Log::info('我来了');
    }
}
