<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    /**
     * Display the system settings page.
     */
    public function index(): View
    {
        $settings = [
            'app_name' => config('app.name'),
            'app_url' => config('app.url'),
            'timezone' => config('app.timezone'),
            'locale' => config('app.locale'),
            'debug' => config('app.debug'),
            'environment' => config('app.env'),
            'session_lifetime' => config('session.lifetime'),
            'cache_driver' => config('cache.default'),
            'queue_connection' => config('queue.default'),
            'mail_driver' => config('mail.default'),
        ];

        return view('settings', compact('settings'));
    }

    /**
     * Update system settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'app_name' => ['required', 'string', 'max:255'],
            'timezone' => ['required', 'string', 'max:255'],
            'locale' => ['required', 'string', 'max:10'],
            'session_lifetime' => ['required', 'integer', 'min:1', 'max:1440'],
        ]);

        // In a real application, you would update configuration files
        // or save settings to database. For this demo, we'll just redirect back
        // with a success message.

        return redirect()->route('settings')->with('status', 'settings-updated');
    }

    /**
     * Clear application cache.
     */
    public function clearCache(): RedirectResponse
    {
        // Clear various caches
        try {
            \Artisan::call('cache:clear');
            \Artisan::call('config:clear');
            \Artisan::call('view:clear');
            \Artisan::call('route:clear');

            return redirect()->route('settings')->with('status', 'cache-cleared');
        } catch (\Exception $e) {
            return redirect()->route('settings')->with('error', 'cache-clear-failed');
        }
    }

    /**
     * Show system information.
     */
    public function systemInfo(): array
    {
        return [
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
            'server_info' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'database_connection' => config('database.default'),
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time'),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
        ];
    }
}