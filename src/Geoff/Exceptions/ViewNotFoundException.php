<?php

declare(strict_types=1);

namespace Geoff\Exceptions;

use Exception;

class ViewNotFoundException extends Exception
{
    public function __construct(string $viewPath)
    {
        parent::__construct("View not found at: $viewPath");
    }
}