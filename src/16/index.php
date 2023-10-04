<?php
require_once 'Level.php';
require_once 'InterfaceLogger.php';
require_once 'FileLogger.php';
require_once 'DBLogger.php';

$logger = new FileLogger(__DIR__ . '/logs.txt');

$logger->log('Це повідомлення логу', Level::INFO);
$logger->log('Це повідомлення помилки', Level::ERROR);
$logger->log('Це повідомлення попередження', Level::WARNING);