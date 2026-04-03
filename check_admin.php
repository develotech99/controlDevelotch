<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$admin = App\Models\User::where('email','admin@admin.com')->first();
if ($admin) {
    echo 'FOUND:' . $admin->id . ' ' . $admin->email . '\n';
    echo 'PWDHASH:' . $admin->password . '\n';
} else {
    echo 'NOT FOUND\n';
}
