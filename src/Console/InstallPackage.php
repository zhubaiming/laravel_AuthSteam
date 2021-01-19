<?php

namespace Baiming\Authsteam\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallPackage extends Command
{
    protected $files;

    /**
     * 在 Artisan 命令列表中隐藏该命令，但该命令仍然可以使用
     *
     * @var bool
     */
    protected $hidden = true;

    /**
     * 命令名称，在控制台执行命令时用到
     *
     * 参数：必填、可选和默认参数
     * 定义一个必填参数，需要用花括号将其包裹起来：{name}
     * 定义一个可选参数，可以在参数名称后面加一个问号：{name?}
     * 定义一个可选参数，并定义默认值：{name=name}
     *
     * 选项：必须设值、默认值以及缩写
     * 选项和参数很像，但是选项有前缀 --，而且可以在没有值的情况下使用
     * 添加一个最基本的选项，可以通过花括号将其包裹：{--table}
     * 如果这个选项必须要设置选项值，可以加上一个 =：{--table=}
     * 如果你想要为其设置默认选项值，可以这么做：{--table=users}
     * 此外，选项还支持缩写，比如我们可以通过 T 来代表 table：{--T|table}
     *
     * 数组参数和数组选项
     * 不管是参数还是选项，如果你想要接收数组作为参数，都要使用 * 通配符：{name*} {--table=*}
     * 数组参数和选项的调用方式如下（这里仅作演示，make:migration 本身不支持这么干）：
     * make:migration create_users_table create_posts_table --table=users --table=posts
     *
     * @var string
     */
    protected $signature = 'authsteam:install';

    /**
     * 命令描述
     *
     * @var string
     */
    protected $description = '安装用户认证权限扩展包';

    /**
     * 创建命令
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * 命令具体执行逻辑放在这里
     *
     * @return int
     */
    public function handle()
    {
        /**
         * 控制台输出文本
         * 绿色：info()
         * 红色：error()
         * 无色：line()
         * 黄色：comment()
         * 靛蓝色：question()
         */
        $this->info('开始安装 AuthSteam 所需文件');
        // 在应用代码中调用 Artisan 命令
        // Artisan::call();
        // $this->callSilent();该方法会抑制所有输出
        $this->callSilent('make:provider', [
            'name' => 'EloquentUserProvider'
        ]);

        $stub = $this->files->get(__DIR__ . '/stub/Providers/EloquentUserProvider.php.stub');

        $this->files->put(app_path('Providers/EloquentUserProvider.php'), $stub);

        $stub = $this->files->get(__DIR__ . '/stub/Models/User.php.stub');

        $this->files->put(app_path('Models/User.php'), $stub);

        return 0;
    }
}
