<?php
require '../vendor/autoload.php';
define( 'PUBLICPATH', dirname( __FILE__ ) . '/' );

use Abdulazizpr\Controllers\HomeController;

(new HomeController)->index();