<?php

namespace Elymod;

/**
 *  Elymod  Skeleton  Installer
 *
 *  Features:
 *  -  Packagist  version  resolution
 *  -  GitHub  fallback
 *  -  Git  clone  fallback
 *  -  Temporary  workspace  extraction
 *  -  Placeholder  replacement
 */
class Installer
{
    /**
     *  Install  Elymod  module
     */
    public static function install(string $name): void
    {
        $namespace = self::studly($name);
        $moduleKey = self::kebab($namespace);

        $target = getcwd();
        $version = self::getSkeletonVersion();

        $tempDir = $target . '/.elymod_tmp_' . uniqid();

        try {
            self::info("Installing  Elymod  module:  {$namespace}");
            self::info("Skeleton  version:  {$version}");

            $source = self::resolveSkeletonSource();

            self::downloadSkeleton($source, $tempDir, $version);

            self::moveDirectory($tempDir, $target);

            self::processFiles(
                $target,
                $namespace,
                $namespace,
                $moduleKey
            );
            self::installDependencies($target);
            self::installNodeDependencies($target);

            self::removeDir($tempDir);
            self::removeDir('src');

            self::success("Module  '{$namespace}'  created  successfully!");

        } catch (\Throwable $e) {

            self::error($e->getMessage());

            if (file_exists($tempDir)) {
                self::removeDir($tempDir);
            }

            throw $e;
        }
    }

    /**
     *  Resolve  skeleton  source
     */
    protected static function resolveSkeletonSource(): array
    {
        return [
            'type' => 'packagist',
            'package' => 'elyerr/elymod-app'
        ];
    }

    /**
     *  Download  skeleton
     */
    protected static function downloadSkeleton(array $source, string $dst, string $version): void
    {
        self::info("Downloading  skeleton...");

        mkdir($dst, 0755, true);

        /**
         *  PACKAGIST  MODE  (IMPORTANT  FIX)
         *  This  ensures  Packagist  installs  are  counted  correctly
         */
        if ($source['type'] === 'packagist') {

            $package = $source['package'];

            $cmd = sprintf(
                "composer  create-project --no-cache  %s  %s  %s  --no-interaction",
                escapeshellarg($package),
                escapeshellarg($dst),
                escapeshellarg($version)
            );

            exec($cmd, $out, $code);

            if ($code !== 0) {
                throw new \RuntimeException("Composer  create-project  failed  for  {$package}");
            }

            self::info("Skeleton  installed  via  Packagist  (create-project)");
            return;
        }

        /**
         *  GIT  FALLBACK
         */
        $repo = $source['repo'];

        $cmd = "git  clone  --depth  1  {$repo}  {$dst}";
        exec($cmd, $out, $code);

        if ($code !== 0) {
            throw new \RuntimeException("Git  clone  failed  from  {$repo}");
        }

        self::info("Skeleton  downloaded  via  Git");
    }

    /**
     *  Move  directory  contents
     */
    protected static function moveDirectory(string $src, string $dst): void
    {
        foreach (scandir($src) as $file) {
            if ($file === '.' || $file === '..')
                continue;

            $from = $src . '/' . $file;
            $to = $dst . '/' . $file;

            if (is_dir($from)) {
                self::copyDir($from, $to);
            } else {
                copy($from, $to);
            }
        }
    }

    protected static function copyDir(string $src, string $dst): void
    {
        if (!is_dir($dst)) {
            mkdir($dst, 0755, true);
        }

        foreach (scandir($src) as $file) {
            if ($file === '.' || $file === '..')
                continue;

            $from = $src . '/' . $file;
            $to = $dst . '/' . $file;

            is_dir($from)
                ? self::copyDir($from, $to)
                : copy($from, $to);
        }
    }

    /**
     *  Replace  placeholders
     */
    protected static function processFiles($path, $namespace, $module, $key): void
    {
        $it = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS)
        );

        $search = ['ElymodApp', 'Elymod  App', 'Elymod App', 'elymod-app', 'elymod app'];
        $replace = [$namespace, $module, $module, $key, $key];

        foreach ($it as $file) {
            if (!$file->isFile())
                continue;

            $content = file_get_contents($file->getPathname());

            if ($content === false || strpos($content, "\0") !== false)
                continue;

            file_put_contents(
                $file->getPathname(),
                str_replace($search, $replace, $content)
            );
        }
    }

    protected static function getSkeletonVersion(): string
    {
        $composer = json_decode(file_get_contents(__DIR__ . '/../composer.json'), true);

        return $composer['extra']['skeleton-version'] ?? '^1.0';
    }

    /**
     *  Composer  install
     */
    protected static function installDependencies(string $path): void
    {
        self::info("Installing  dependencies...");

        self::removeDir($path . '/vendor');
        self::removeDir($path . '/vendor-build');
        @unlink($path . '/composer.lock');

        exec("cd {$path} && composer clear-cache && elyscope install", $output, $code);

        if ($code !== 0) {
            self::error("Dependency  install  failed");
        }
    }

    /**
     *  Node  install
     */
    protected static function installNodeDependencies(string $path): void
    {
        if (!file_exists($path . '/package.json'))
            return;

        self::info("Installing  node  dependencies...");

        exec("cd  {$path}  &&  npm install", $code);

        if ($code !== 0) {
            self::error("Node  build  failed");
        }
    }

    protected static function removeDir($dir): void
    {
        if (!file_exists($dir))
            return;

        if (!is_dir($dir)) {
            unlink($dir);
            return;
        }

        $it = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($it as $item) {
            $item->isDir()
                ? rmdir($item->getRealPath())
                : unlink($item->getRealPath());
        }

        rmdir($dir);
    }

    protected static function studly($v)
    {
        return str_replace('  ', '', ucwords(str_replace(['-', '_'], '  ', $v)));
    }

    protected static function kebab($v)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $v));
    }

    protected static function info($m)
    {
        echo "[INFO]  $m\n";
    }
    protected static function warning($m)
    {
        echo "[WARN]  $m\n";
    }
    protected static function success($m)
    {
        echo "[OK]  $m\n";
    }
    protected static function error($m)
    {
        echo "[ERROR]  $m\n";
    }
}