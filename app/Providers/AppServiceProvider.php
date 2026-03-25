<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Inertia::share([
            'auth' => fn () => [
                'user' => Auth::user()?->only('id', 'name', 'email'),
            ],
            'flash' => fn () => [
                'success' => request()->session()->get('success'),
                'error' => request()->session()->get('error'),
            ],
        ]);
    }
}
