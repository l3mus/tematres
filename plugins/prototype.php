<?php
require_once 'core/init.php';
use \Plugin_classes\Config;

echo Config::get('mysql/host');