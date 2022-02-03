<?php

/**
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function env($key, $default = null)
{

    $value = $_ENV[$key] ?? null;

    if ($value === false) {
        return $default;
    }

    switch (strtolower($value)) {
        case 'true':
        case '(true)':
            return true;

        case 'false':
        case '(false)':
            return false;
    }

    return $value;
}
