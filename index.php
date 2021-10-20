<?php
require 'autoloader.php';
require 'vendor/autoload.php';

use League\Plates\Engine;

$template =new Engine("templates");

echo $template->render("login");