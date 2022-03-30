<?php
$path = '.env';

$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue;

    list($name, $value) = explode('=', $line, 2);
    $_ENV[trim($name)] = trim($value);
}
