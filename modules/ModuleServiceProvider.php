<?php

namespace modules;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;


class ModuleServiceProvider extends ServiceProvider
{
    private $middlewares = [];

    private $commands = [];
    // get base name
    private function getModules()
    {
        $directories = array_map('basename', File::directories(__DIR__));
        return $directories;
    }
    public function boot()
    {
        $modules = $this->getModules();

        if (!empty($modules)) {
            foreach ($modules as $directory) {
                $this->registerModule($directory);
            }
        }
    }

    // dang ky Configuration
    private function registerConfig($directory)
    {
        $configPath = $directory . '/configs';
        if (File::exists(__DIR__ . '/' . $configPath)) {
            $configFiles = array_map('basename', File::allFiles(__DIR__ . '/' . $configPath));
            foreach ($configFiles as $config) {
                $alias = str_replace('.php', '', $config);
                $alias = basename($config, '.php');
                $this->mergeConfigFrom(__DIR__ . '/' . $configPath . '/' . $config, $alias);
            }
        }
    }
    // dang ky middleware
    private function registerMiddleware()
    {
        if (!empty($this->middlewares)) {
            foreach ($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }

    private function registerCommand()
    {
    }

    public function register()
    {
        $modules = $this->getModules();
        //configs
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->registerConfig($module);
            }
        }

        //middleware
        $this->registerMiddleware();

        //khai bao commands
        $this->registerCommand();

        //biding user
        // $this->app->singleton(
        //     UserServiceInterface::class,
        //     UserService::class,
        // );

        // $this->app->singleton(
        //     UserRepositoryInterface::class,
        //     UserRepository::class,
        // );

        //biding role
        // $this->app->singleton(
        //     RoleServiceInterface::class,
        //     RoleService::class,
        // );

        // $this->app->singleton(
        //     RoleRepositoryInterface::class,
        //     RoleRepository::class,
        // );
    }

    //khai bao module
    private function registerModule($module)
    {
        $modulePath = __DIR__ . '/' . $module . '/';
        //khai báo routes
        if (File::exists($modulePath . 'routes/api.php')) {
            $this->loadRoutesFrom($modulePath . 'routes/api.php');
        }


        //Khai báo Migrations
        if (File::exists($modulePath . 'migrations')) {
            $this->loadMigrationsFrom($modulePath . 'migrations');
        }

        //khai báo languages
        if (File::exists($modulePath . 'resources/lang')) {
            $this->loadTranslationsFrom($modulePath . 'resources/lang', strtolower($module));
            $this->loadJsonTranslationsFrom($modulePath . 'resources/lang');
        }
        //Khai báo helpers
        if (File::exists($modulePath . 'helpers')) {
            $helpers_dir = File::allFiles($modulePath . 'helpers');
            foreach ($helpers_dir as $key => $value) {
                $file = $value->getPathname();
                require $file;
            }
        }
    }
}
