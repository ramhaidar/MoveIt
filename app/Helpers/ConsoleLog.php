<?php

/**
 * Console Logging Helper
 * 
 * This file provides helper functions for console/logging operations.
 * It's autoloaded via composer.json files array.
 */

if (!function_exists('console_log')) {
    /**
     * Log a message to the console (stderr).
     *
     * @param mixed $message The message to log
     * @param string $level The log level (debug, info, warning, error)
     * @return void
     */
    function console_log($message, string $level = 'info'): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $level = strtoupper($level);
        
        if (is_array($message) || is_object($message)) {
            $message = json_encode($message, JSON_PRETTY_PRINT);
        }
        
        $output = "[{$timestamp}] {$level}: {$message}" . PHP_EOL;
        
        // Write to stderr so it doesn't interfere with HTTP responses
        fwrite(STDERR, $output);
    }
}

if (!function_exists('console_debug')) {
    /**
     * Log a debug message to the console.
     *
     * @param mixed $message The message to log
     * @return void
     */
    function console_debug($message): void
    {
        console_log($message, 'debug');
    }
}

if (!function_exists('console_info')) {
    /**
     * Log an info message to the console.
     *
     * @param mixed $message The message to log
     * @return void
     */
    function console_info($message): void
    {
        console_log($message, 'info');
    }
}

if (!function_exists('console_warning')) {
    /**
     * Log a warning message to the console.
     *
     * @param mixed $message The message to log
     * @return void
     */
    function console_warning($message): void
    {
        console_log($message, 'warning');
    }
}

if (!function_exists('console_error')) {
    /**
     * Log an error message to the console.
     *
     * @param mixed $message The message to log
     * @return void
     */
    function console_error($message): void
    {
        console_log($message, 'error');
    }
}
