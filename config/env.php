<?php

/**
 * Require helpers
 */
require_once(__DIR__ . '/helpers.php');

/**
 * Load application environment from .env file
 */
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

