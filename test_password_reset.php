<?php
require "vendor/autoload.php";
$app = require "bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\Password;

$status = Password::sendResetLink(['email' => 'admin@admin.com']);
var_dump($status);
