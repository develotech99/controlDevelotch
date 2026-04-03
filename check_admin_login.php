<?php
require "vendor/autoload.php";
$app = require "bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

$user = User::where('email','admin@admin.com')->first();
if (!$user) {
    echo "USER NOT FOUND\n";
    exit(1);
}
$check = Hash::check('admin123', $user->password);
echo 'HASH_CHECK: ' . ($check ? 'OK' : 'FAIL') . "\n";
$attempt = Auth::attempt(['email' => 'admin@admin.com', 'password' => 'admin123']);
echo 'AUTH_ATTEMPT: ' . ($attempt ? 'OK' : 'FAIL') . "\n";
