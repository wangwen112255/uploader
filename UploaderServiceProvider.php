<?php

namespace Wangwin\Uploader;

use Illuminate\Support\ServiceProvider;

class UploaderServiceProvider extends ServiceProvider
{
    /**
     * 服务提供者加是否延迟加载.
     *
     * @var bool
     */
    protected $defer = true; // 延迟加载服务

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        // 单例绑定服务
        $this->app->singleton('uploader', function ($app) {
            return new Uploader(app('config'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //

        $this->loadViewsFrom(__DIR__ . '/views', 'Uploaders'); // 视图目录指定

        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/uploader'),  // 发布视图目录到resources 下
            __DIR__.'/config/uploader.php' => config_path('uploader.php'), // 发布配置文件到 laravel 的config 下
        ]);

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        // 因为延迟加载 所以要定义 provides 函数 具体参考laravel 文档
        return ['uploader'];
    }
}
