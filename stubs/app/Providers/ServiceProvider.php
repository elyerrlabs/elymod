<?php
namespace {{ Namespace }}\App\Providers;

use Elyerr\ApiResponse\Exceptions\ReportError;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{
    /**
     * Composer file
     * @var 
     */
    private $composerFile;

    /**
     * Vendor autoload
     * @var 
     */
    private $vendorAutoload;

    /**
     * Views
     * @var 
     */
    private $views;

    private $routes;

    /**
     * Kernel
     * @var 
     */
    private $kernel;

    /**
     * Migrations
     * @var 
     */
    private $migration;


    /**
     * Construct
     * @param mixed $app
     */
    public function __construct($app)
    {
        parent::__construct($app);
        $this->vendorAutoload = __DIR__ . '/../../vendor/autoload.php';
        $this->composerFile = __DIR__ . '/../../composer.json';
        $this->views = __DIR__ . '/../../resources/views';
        $this->routes = __DIR__ . '/../../routes';
        $this->kernel = __DIR__ . '/../Http/kernel.php';
    }

    public function boot()
    {
        if (file_exists($this->vendorAutoload)) {
            require $this->vendorAutoload;

            $this->loadViewsFrom($this->views, ucfirst($this->getModuleName()));
            $this->registerRoutes();
            $this->registerMiddlewares();
            $this->registerMigrations();
            $this->registerConfigs();
        }
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Decode composer file
     * @throws ReportError
     */
    private function decodeComposer()
    {
        if (!file_exists($this->composerFile)) {
            throw new \Exception("composer.json not found");
        }
        return json_decode(file_get_contents($this->composerFile));
    }

    /**
     * Get module name
     * @return string
     */
    private function getModuleName()
    {
        return strtolower(explode('/', $this->decodeComposer()->name)[1]);
    }

    /**
     * Generate view prefix
     * @return string
     */
    private function generateViewPrefix()
    {
        $moduleName = str_replace("-", " ", $this->getModuleName());

        return str_replace(" ", "", ucwords($moduleName));
    }


    /**
     * Modulo base path
     * @param string $moduleName
     * @return string|null
     */
    protected function moduleBasePath(string $moduleName): ?string
    {
        $modulesPath = base_path('third-party');

        if (!is_dir($modulesPath)) {
            return null;
        }

        // List directories
        $directories = array_filter(glob($modulesPath . '/*'), 'is_dir');

        foreach ($directories as $dir) {

            $dirname = basename($dir);

            if (strcasecmp($dirname, $moduleName) === 0) {
                return $dir;
            }
        }

        return null;
    }

    /**
     * Register the routes for the Identity module.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        $slugIdentifier = $this->getModuleName();
        Route:: as("module.{$slugIdentifier}.")->group(
            function () use ($slugIdentifier) {

                // Admin routes
                if (file_exists($this->routes . '/admin.php')) {
                    Route::group([
                        'prefix' => "{$slugIdentifier}/admin",
                        'as' => "admin.",
                        'middleware' => ['web'],
                        'module' => $this->generateViewPrefix(), // DO NOT REMOVE
                        'module_type' => 'third-party', // DO NOT REMOVE
                        'module_path' => $this->moduleBasePath($this->generateViewPrefix()) // DO NOT REMOVE
                    ], function () {
                        require $this->routes . '/admin.php';
                    });
                }

                // API routes
                if (file_exists($this->routes . '/api.php')) {

                    Route::group([
                        'prefix' => "{$slugIdentifier}/api",
                        'as' => 'api.',
                        'middleware' => ['web'],
                        'module' => $this->generateViewPrefix(), // DO NOT REMOVE
                        'module_type' => 'third-party', // DO NOT REMOVE
                        'module_path' => $this->moduleBasePath($this->generateViewPrefix()) // DO NOT REMOVE
                    ], function () {
                        require $this->routes . '//api.php';
                    });

                }

                if (file_exists($this->routes . '/web.php')) {

                    Route::group([
                        'prefix' => $slugIdentifier,
                        'as' => 'web.',
                        'middleware' => ['web'],
                        'module' => $this->generateViewPrefix(), // DO NOT REMOVE
                        'module_type' => 'third-party', // DO NOT REMOVE
                        'module_path' => $this->moduleBasePath($this->generateViewPrefix()) // DO NOT REMOVE
                    ], function () {
                        require $this->routes . '/web.php'; // DO NOT REMOVE
                    });
                }
            }
        );
    }

    /**
     * Merge configs
     * @return void
     */
    public function registerConfigs()
    {
        $configPath = __DIR__ . "/../../config";
        $moduleName = $this->getModuleName();

        if (!is_dir($configPath)) {
            return;
        }

        foreach (glob($configPath . "/*.php") as $file) {

            $key = basename($file, '.php');
            $currentConfig = config($key, []);
            $loadFile = include $file;

            // Merge configs
            switch ($key) {
                case 'rate_limit':
                    $rate_limit['third-party'][strtolower($moduleName)] = $loadFile;
                    $merged = $this->mergeConfigSmart($rate_limit, $currentConfig);
                    config()->set($key, $merged);
                    break;

                case 'routes':
                    $routes['third-party'][strtolower($moduleName)] = $loadFile;
                    $merged = $this->mergeConfigSmart($routes, $currentConfig);
                    config()->set($key, $merged);
                    break;

                case 'module':
                    $modules['third-party'][strtolower($moduleName)] = $loadFile;
                    $merged = $this->mergeConfigSmart($modules, $currentConfig);
                    config()->set($key, $merged);

                    break;

                case 'menus': // Merge Menus 
                    $merged = $this->mergeConfigSmart($loadFile, $currentConfig);
                    config()->set($key, $merged);

                    break;
                case 'auth':
                    $currentConfig = config('auth', []);
                    $merged = $this->mergeConfigSmart($currentConfig, $loadFile);
                    config()->set('auth', $merged);
                    break;
                default:
                    $this->mergeConfigFrom($file, $key);
                    break;
            }
        }

    }

    /**
     * Register middlewares
     * @return void
     */
    protected function registerMiddlewares()
    {
        $router = $this->app->make(Router::class);

        if (file_exists($this->kernel)) {
            $alias = require $this->kernel;

            foreach ($alias as $key => $value) {

                $router->aliasMiddleware($key, $value);
            }
        }

    }

    /**
     * Register the migrations for the Identity module.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . "/../../database/migrations");
    }


    /**
     * Merge configs
     * @param array $base
     * @param array $merge
     * @return array
     */
    private function mergeConfigSmart(array $base, array $merge): array
    {
        foreach ($merge as $key => $value) {

            if (isset($base[$key]) && is_array($base[$key]) && is_array($value)) {

                if ($this->isNumericArray($base[$key]) && $this->isNumericArray($value)) {
                    $base[$key] = array_values(array_merge($base[$key], $value));
                    ksort($base);

                } else { // Associative
                    $base[$key] = $this->mergeConfigSmart($base[$key], $value);
                    ksort($base);

                }
            } else {
                $base[$key] = $value;
                ksort($base);
            }
        }
        ksort($base);
        return $base;
    }

    /**
     * Verify arrays
     * @param array $array
     * @return bool
     */
    private function isNumericArray(array $array): bool
    {
        return array_keys($array) === range(0, count($array) - 1);
    }
}
