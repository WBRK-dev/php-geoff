<?php

declare(strict_types=1);

namespace Geoff\Routing;

use Geoff\Exceptions\ViewNotFoundException;

use function Geoff\Environment\env;

class ViewResolver
{
    public static function create(): ViewResolver
    {
        return new ViewResolver();
    }

    /**
     * @throws ViewNotFoundException
     */
    public function resolve(string $viewName): void
    {
        if ($viewName === "/")
            $viewName = "/index";

        $viewPath = $this->getViewPath() . $viewName . '.php';

        $this->checkViewExists($viewPath);

        require $viewPath;
    }

    private function getViewPath(): string
    {
        return env("ROOT_PATH") . "/views";
    }

    /**
     * @throws ViewNotFoundException
     */
    private function checkViewExists(string $viewPath): void
    {
        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException($viewPath);
        }
    }
}