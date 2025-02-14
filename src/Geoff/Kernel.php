<?php

declare(strict_types=1);

namespace Geoff;

use Geoff\Environment\EnvironmentFileParser;
use Geoff\Routing\RouteResolver;
use Geoff\Routing\ViewResolver;

use function Geoff\Environment\setenv;

class Kernel
{
    public function __construct(
        private RouteResolver $routeResolver,
        private ViewResolver $viewResolver,
        private EnvironmentFileParser $environmentFileParser
    ) {
    }

    public static function create()
    {
        return new Kernel(
            RouteResolver::create(),
            ViewResolver::create(),
            EnvironmentFileParser::create()
        );
    }

    public function prepare(): void
    {
        $this->environmentFileParser->parse();

        $rootPath = $_SERVER['SCRIPT_FILENAME'];
        $rootPath = str_replace('/index.php', '', $rootPath);
        setenv('ROOT_PATH', $rootPath);
    }

    public function run(): void
    {
        $this->prepare();

        $this->viewResolver->resolve(
            $this->routeResolver->resolve()
        );
    }
}