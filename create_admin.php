<?php
require "vendor/autoload.php";
$app = require "bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

$role = Role::firstOrCreate(['name' => 'admin']);
$user = User::updateOrCreate(
    ['email' => 'admin@admin.com'],
    [
        'name' => 'Admin Sistema',
        'password' => Hash::make('admin123'),
        'email_verified_at' => now(),
    ]
);
$user->assignRole($role);
echo 'ADMIN CREATED: ' . $user->id . ' ' . $user->email . "\n";
