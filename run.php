#!/usr/bin/env php
<?php

function red(string $text): void
{
  printf("\033[31m%s\033[0m", $text);
}
function green(string $text): void
{
}

try {
  echo PHP_EOL;
  printf('🏃 Running %s', $argv[1]);
  echo PHP_EOL;
  echo "\033[32m";
  require_once $argv[1];
  echo "\033[0m";
  echo PHP_EOL;
  echo PHP_EOL;
} catch (\Throwable $e) {
  echo ' ';
  echo '❌ ';
  echo red(get_class($e) .' at line ' . $e->getLine()) . ' ' . $e->getMessage();
  echo PHP_EOL;
  echo PHP_EOL;
}
