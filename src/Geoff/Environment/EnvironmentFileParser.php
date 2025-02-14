<?php

declare(strict_types=1);

namespace Geoff\Environment;

class EnvironmentFileParser
{
    public static function create(): EnvironmentFileParser
    {
        return new EnvironmentFileParser();
    }

    public function parse(): void
    {
        $_ENV = [
            ...$_ENV,
            ...parse_ini_file(".env"),
        ];
    }
}