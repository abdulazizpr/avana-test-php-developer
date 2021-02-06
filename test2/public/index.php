<?php
require '../vendor/autoload.php';
define( 'PUBLICPATH', dirname( __FILE__ ) . '/' );

use App\Controllers\HomeController;

(new HomeController)->index();