<?php

declare(strict_types=1);

namespace Geoff\Environment;

/**
 * Get an environment variable.
 *
 * @param string $key
 * @param $default
 * @return array|false|mixed|string|null
 */
function env(string $key, $default = null): mixed
{
    $value = $_ENV[$key] ?? null;

    if (!isset($value)) {
        return $default;
    }

    return $value;
}

/**
 * Set an environment variable.
 *
 * @param string $key
 * @param $value
 * @return void
 */
function setenv(string $key, $value): void
{
    $_ENV[$key] = $value;
}