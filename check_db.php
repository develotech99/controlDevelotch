<?php
require "vendor/autoload.php";
$app = require "bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;
try {
    $name = DB::connection()->getDatabaseName();
    $driver = DB::connection()->getDriverName();
    echo "DB: $name ($driver)\n";
    $host = DB::connection()->getConfig('host');
    echo "HOST: $host\n";
    echo DB::select('select now() as now')[0]->now . "\n";
} catch (Throwable $e) {
    echo 'ERROR: ' . $e->getMessage() . "\n";
}
