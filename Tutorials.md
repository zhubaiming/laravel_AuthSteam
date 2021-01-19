# 扩展包开发 - 教程

## 包自动发现

在 Laravel 应用的配置文件 ``` config/app.php ``` 中，``` providers``` 配置项定义了一个会被 Laravel 加载的服务提供者列表。当安装完新的
扩展包后，在老版本中需要将扩展包当服务提供者添加到这个列表以便被 Laravel 使用。从 Laravel 5.5 开始，不必再手动添加服务提供者到该列表，而是将
提供者定义到扩展包下 ``` composer.json``` 文件的 ```extra``` 选项中，除了服务提供者之外，还可以以这种方式注册门面：

```json
"extra": {
    "laravel": {
        "providers": [
        
        ],
        "aliases": [
        
        ]
    }
}
```
定义好之后，在安装扩展包之后 Laravel 就会自动注册响应的服务提供者和门面，从而为扩展包使用者提供一个更加便捷的安装体验。

## 服务提供者

服务提供者是扩展包和 Laravel 之间的连接纽带。服务提供者负责绑定对象到 Laravel 的服务容器并告知 Laravel 从哪里加载包资源，如视图、配置和本地化
文件。

服务提供者继承自 ```Illuminate\Support\ServiceProvider``` 类并包含两个方法： ```register``` 和 ```boot```。

## 命令

要通过 Laravel 注册扩展包的 Artisan 命令，可以使用 ```commands``` 方法。该方法需要传入命令名称数组，注册号命令后，可以使用 Artisan CLI 执行它们

```php
/**
 * Bootstrap the application services.
 *
 * @return void
 */
public function boot()
{
    if ($this->app->runningInConsole()) {
        $this->commands([
            FooCommand::class,
            BarCommand::class,
        ]);
    }
}
```
