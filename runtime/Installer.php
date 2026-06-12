<?php

namespace Elymod\Runtime;

class Installer
{
    public static function install(string $name, string $driver = 'vite'): void
    {
        $namespace = self::studly($name);
        $module = $namespace;
        $moduleKey = self::kebab($namespace);

        $driver = strtolower($driver);

        if (!in_array($driver, ['vite', 'mix'])) {
            throw new \InvalidArgumentException(
                "Invalid driver [{$driver}]. Supported drivers: vite, mix."
            );
        }

        $target = getcwd();

        self::copyStub(
            __DIR__ . "/../stubs/{$driver}",
            $target
        );

        self::processFiles(
            $target,
            $namespace,
            $module,
            $moduleKey
        );

        self::cleanup($driver);

        echo PHP_EOL;
        echo "✔ Elymod module {$module} created successfully." . PHP_EOL;
        echo "✔ Asset driver: {$driver}" . PHP_EOL;
    }

    protected static function copyStub(string $src, string $dst): void
    {
        foreach (scandir($src) as $file) {
            if ($file === '.' || $file === '..')
                continue;

            $from = "{$src}/{$file}";
            $to = "{$dst}/{$file}";

            if (is_dir($from)) {
                if (!is_dir($to))
                    mkdir($to, 0755, true);
                self::copyStub($from, $to);
            } else {

                if (str_ends_with($file, '.stub')) {
                    $to = str_replace('.stub', '', $to);
                }
                copy($from, $to);
            }
        }
    }

    protected static function processFiles(string $path, string $namespace, string $module, string $moduleKey): void
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if (!$file->isFile())
                continue;

            $content = file_get_contents($file->getPathname());

            $content = str_replace(
                ['{{ Namespace }}', '{{ Module }}', '{{ module }}'],
                [$namespace, $module, $moduleKey],
                $content
            );

            file_put_contents($file->getPathname(), $content);
        }
    }

    protected static function studly(string $value): string
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $value)));
    }

    protected static function kebab(string $value): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $value));
    }

    protected static function cleanup(string $driver): void
    {
        self::removeDir(__DIR__ . '/../stubs');
        self::removeDir(__DIR__ . '/../vendor');
        self::removeDir(__DIR__ . '/../composer.lock');
        self::installDependencies(__DIR__ . '/../composer.json');
        self::installNodeDependencies($driver);
        self::removeDir(__DIR__ . '/../runtime');
    }

    protected static function removeDir(string $dir): void
    {
        if (!is_dir($dir)) {
            unlink($dir);
            return;
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($files as $fileinfo) {
            ($fileinfo->isDir() ? 'rmdir' : 'unlink')($fileinfo->getRealPath());
        }

        rmdir($dir);
    }

    protected static function installDependencies(string $target): void
    {
        if (!file_exists($target)) {
            echo "No composer.json found  , skipping dependencies installation.\n";
            return;
        }

        echo "Installing composer dependencies  ...\n";

        $cmd = "composer install --no-interaction --prefer-dist";

        passthru($cmd, $returnVar);

        if ($returnVar === 0) {
            echo "Composer dependencies installed successfully.\n";
        } else {
            echo "Failed to install composer dependencies.\n";
        }
    }

    protected static function installNodeDependencies(string $driver): void
    {
        if (!file_exists('package.json')) {
            echo "No package.json found, skipping npm installation.\n";
            return;
        }

        echo "Installing node dependencies...\n";

        passthru('npm ci', $returnVar);

        if ($returnVar !== 0) {
            echo "Failed to install node dependencies.\n";
            return;
        }

        echo "Node dependencies installed successfully.\n";

        $command = match ($driver) {
            'mix' => 'npm run dev',
            'vite' => 'npm run build',
        };

        echo "Running asset build ({$command})...\n";

        passthru($command, $returnVar);

        if ($returnVar === 0) {
            echo "Assets compiled successfully.\n";
        } else {
            echo "Asset compilation failed.\n";
        }
    }
}
