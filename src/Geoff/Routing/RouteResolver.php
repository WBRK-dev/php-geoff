<?php

declare(strict_types=1);

namespace Geoff\Routing;

use function Geoff\Environment\setenv;

class RouteResolver
{
    public static function create()
    {
        return new RouteResolver();
    }

    public function resolve(): string
    {
        $rootPath = $_SERVER['PHP_SELF'];
        $rootPath = str_replace('/index.php', '', $rootPath);
        $path = $_SERVER['REQUEST_URI'];

        $httpBasePath = str_replace($rootPath, '', $path);
        setenv('HTTP_BASE_PATH', $httpBasePath);

        return $this->escapePath(
            $httpBasePath
        );
    }

    private function escapePath(string $path): string
    {
        return str_replace('.', '', $path);
    }
}