<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class OptimizationController extends Controller
{
    public function optimizeCache()
    {
        try {
            Artisan::call('optimize:clear');
            Artisan::call('config:cache');
            Artisan::call('view:cache');
            Artisan::call('route:cache');
            return 'Cache optimized successfully.';
        } catch (\Exception $e) {
            return 'Failed to optimize cache. Error: ' . $e->getMessage();
        }
    }
}
