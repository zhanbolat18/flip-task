#!/usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: aligieri
 * Date: 6/13/19
 * Time: 12:35 AM
 */

require __DIR__ . '/vendor/autoload.php';

$application = new \Symfony\Component\Console\Application('Convertor', '1.0');

$application->add(new \App\Commands\ConvertCommand());

$application->run();