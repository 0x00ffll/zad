<?php

namespace App\Services;

use Exception;

class AssetService
{
    /**
     * Get CSS asset URL with proper versioning
     * 
     * @param string $filename CSS filename (e.g., 'bootstrap.min.css')
     * @return string Versioned asset URL
     * @throws Exception If asset file does not exist
     */
    public function css(string $filename): string
    {
        $path = "assets/css/{$filename}";
        if (!$this->assetExists($path)) {
            throw new Exception("CSS asset not found: {$filename}");
        }
        
        return asset($path) . '?v=' . $this->getAssetVersion($path);
    }

    /**
     * Get JavaScript asset URL with proper versioning
     * 
     * @param string $filename JavaScript filename (e.g., 'app.js')
     * @return string Versioned asset URL
     * @throws Exception If asset file does not exist
     */
    public function js(string $filename): string
    {
        $path = "assets/js/{$filename}";
        if (!$this->assetExists($path)) {
            throw new Exception("JS asset not found: {$filename}");
        }
        
        return asset($path) . '?v=' . $this->getAssetVersion($path);
    }

    /**
     * Get image asset URL with proper versioning
     * 
     * @param string $path Image path relative to assets/images/
     * @return string Versioned asset URL
     * @throws Exception If asset file does not exist
     */
    public function image(string $path): string
    {
        $fullPath = "assets/images/{$path}";
        if (!$this->assetExists($fullPath)) {
            throw new Exception("Image asset not found: {$path}");
        }
        
        return asset($fullPath) . '?v=' . $this->getAssetVersion($fullPath);
    }

    /**
     * Get plugin asset URL for third-party libraries
     * 
     * @param string $plugin Plugin name (e.g., 'metismenu')
     * @param string $filename File within plugin directory
     * @return string Versioned asset URL
     * @throws Exception If asset file does not exist
     */
    public function plugin(string $plugin, string $filename): string
    {
        $path = "assets/plugins/{$plugin}/{$filename}";
        if (!$this->assetExists($path)) {
            throw new Exception("Plugin asset not found: {$plugin}/{$filename}");
        }
        
        return asset($path) . '?v=' . $this->getAssetVersion($path);
    }

    /**
     * Validate Dashtrans asset structure
     * 
     * @return array Missing asset files or empty array if all present
     */
    public function validateAssetStructure(): array
    {
        $requiredAssets = [
            'assets/css/bootstrap.min.css',
            'assets/css/app.css',
            'assets/js/bootstrap.min.js',
            'assets/js/app.js',
            'assets/images', // Directory check
            'assets/plugins' // Directory check
        ];

        $missing = [];
        
        foreach ($requiredAssets as $asset) {
            if (!$this->assetExists($asset)) {
                $missing[] = $asset;
            }
        }

        return $missing;
    }

    /**
     * Get all CSS assets in proper loading order
     * 
     * @return array Ordered CSS asset URLs
     */
    public function getAllCssAssets(): array
    {
        $cssFiles = [
            'bootstrap.min.css',       // Bootstrap framework
            'bootstrap-extended.css',  // Bootstrap extensions
            'icons.css',              // Icon fonts (BoxIcons)
            'app.css'                 // Main application styles
        ];
        
        $pluginCssFiles = [
            'metismenu/css/metisMenu.min.css',  // MetisMenu for sidebar navigation
            'simplebar/css/simplebar.css',       // Simplebar for custom scrollbars
            'perfect-scrollbar/css/perfect-scrollbar.css'  // Perfect scrollbar
        ];

        $assets = [];
        
        // Load main CSS files
        foreach ($cssFiles as $file) {
            try {
                $assets[] = $this->css($file);
            } catch (Exception $e) {
                if (config('app.debug')) {
                    logger("Missing CSS asset: {$file}");
                }
            }
        }
        
        // Load plugin CSS files
        foreach ($pluginCssFiles as $pluginFile) {
            try {
                $parts = explode('/', $pluginFile);
                $plugin = $parts[0];
                $subPath = implode('/', array_slice($parts, 1));
                $assets[] = $this->plugin($plugin, $subPath);
            } catch (Exception $e) {
                if (config('app.debug')) {
                    logger("Missing plugin CSS asset: {$pluginFile}");
                }
            }
        }

        return $assets;
    }

    /**
     * Get all JavaScript assets in proper loading order
     * 
     * @return array Categorized JavaScript asset URLs
     */
    public function getAllJsAssets(): array
    {
        // Head scripts (loaded before page content) - REMOVED pace.min.js for no loading bar
        $headJs = [];
        
        // Body scripts (loaded after page content in correct order)
        $bodyJs = [
            'jquery.min.js',           // jQuery must be first
            'bootstrap.bundle.min.js', // Bootstrap (includes Popper.js)
        ];
        
        // Plugin scripts (must load after jQuery and Bootstrap)
        $pluginJs = [
            'simplebar/js/simplebar.min.js',     // Simplebar for custom scrollbars
            'metismenu/js/metisMenu.min.js',     // MetisMenu for navigation
            'perfect-scrollbar/js/perfect-scrollbar.js'  // Perfect scrollbar
        ];
        
        // Application scripts (loaded last)
        $appJs = ['app.js'];

        $assets = ['head' => [], 'body' => []];
        
        // Load head scripts
        foreach ($headJs as $file) {
            try {
                $assets['head'][] = $this->js($file);
            } catch (Exception $e) {
                if (config('app.debug')) {
                    logger("Missing head JS asset: {$file}");
                }
            }
        }

        // Load jQuery and Bootstrap first (critical order)
        foreach ($bodyJs as $file) {
            try {
                $assets['body'][] = $this->js($file);
            } catch (Exception $e) {
                if (config('app.debug')) {
                    logger("Missing core JS asset: {$file}");
                }
            }
        }
        
        // Then load plugins (depend on jQuery and Bootstrap)
        foreach ($pluginJs as $file) {
            try {
                $parts = explode('/', $file);
                $plugin = $parts[0];
                $subPath = implode('/', array_slice($parts, 1));
                $assets['body'][] = $this->plugin($plugin, $subPath);
            } catch (Exception $e) {
                if (config('app.debug')) {
                    logger("Missing plugin JS asset: {$file}");
                }
            }
        }
        
        // Finally load application scripts
        foreach ($appJs as $file) {
            try {
                $assets['body'][] = $this->js($file);
            } catch (Exception $e) {
                if (config('app.debug')) {
                    logger("Missing app JS asset: {$file}");
                }
            }
        }

        return $assets;
    }

    /**
     * Get asset version for cache busting
     * 
     * @param string $assetPath Path to asset file
     * @return string Version string for URL parameter
     */
    public function getAssetVersion(string $assetPath): string
    {
        $fullPath = public_path($assetPath);
        
        if (file_exists($fullPath)) {
            // Use file modification time for development, app version for production
            if (config('app.debug')) {
                return (string) filemtime($fullPath);
            } else {
                // In production, use a combination of file time and app version for better caching
                return config('app.version', '1.0.0') . '.' . filemtime($fullPath);
            }
        }
        
        return config('app.version', '1.0.0');
    }

    /**
     * Check if asset file exists
     * 
     * @param string $assetPath Relative path within assets directory
     * @return bool True if asset exists
     */
    public function assetExists(string $assetPath): bool
    {
        $fullPath = public_path($assetPath);
        
        // For directories, check if directory exists
        if (str_ends_with($assetPath, '/') || !str_contains($assetPath, '.')) {
            return is_dir($fullPath);
        }
        
        return file_exists($fullPath);
    }

    /**
     * Get asset MIME type for proper serving
     * 
     * @param string $assetPath Path to asset file
     * @return string MIME type string
     */
    public function getAssetMimeType(string $assetPath): string
    {
        $extension = pathinfo($assetPath, PATHINFO_EXTENSION);
        
        return match($extension) {
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'woff' => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'eot' => 'application/vnd.ms-fontobject',
            default => 'application/octet-stream'
        };
    }

    /**
     * Check for missing critical assets and return fallback options
     * 
     * @return array Missing assets with fallback suggestions
     */
    public function getMissingAssetsWithFallbacks(): array
    {
        $criticalAssets = [
            'jquery.min.js' => 'https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js',
            'bootstrap.bundle.min.js' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
            'bootstrap.min.css' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
        ];

        $missing = [];
        
        foreach ($criticalAssets as $asset => $fallback) {
            if ($asset === 'jquery.min.js') {
                $path = "assets/js/{$asset}";
            } elseif (str_contains($asset, '.css')) {
                $path = "assets/css/{$asset}";
            } else {
                $path = "assets/js/{$asset}";
            }
            
            if (!$this->assetExists($path)) {
                $missing[$asset] = $fallback;
            }
        }
        
        return $missing;
    }

    /**
     * Get fallback assets for critical functionality
     * 
     * @return array Fallback asset URLs
     */
    public function getFallbackAssets(): array
    {
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
                'https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css',
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js',
                'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
            ]
        ];
    }

    /**
     * Validate asset integrity and log errors
     * 
     * @param array $assets Array of asset URLs
     * @return array Valid assets
     */
    public function validateAssetIntegrity(array $assets): array
    {
        $validAssets = [];
        
        foreach ($assets as $asset) {
            // Extract path from asset URL
            $path = parse_url($asset, PHP_URL_PATH);
            $fullPath = public_path($path);
            
            if (file_exists($fullPath)) {
                $validAssets[] = $asset;
            } else {
                // Log missing asset
                logger()->warning("Asset not found: {$asset}", [
                    'asset_url' => $asset,
                    'file_path' => $fullPath,
                    'user_agent' => request()->header('User-Agent'),
                    'ip' => request()->ip()
                ]);
            }
        }
        
        return $validAssets;
    }

    /**
     * Generate error notification for missing assets
     * 
     * @param array $missingAssets
     * @return string HTML error message
     */
    public function generateAssetErrorMessage(array $missingAssets): string
    {
        if (empty($missingAssets)) {
            return '';
        }

        $assetList = implode(', ', array_keys($missingAssets));
        
        return "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <i class='bx bx-error-circle'></i>
            <strong>Asset Loading Warning:</strong> Some assets could not be loaded: {$assetList}.
            The system is using fallback resources to maintain functionality.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    /**
     * Get enhanced CSS assets with fallback handling
     * 
     * @return array CSS assets with error handling
     */
    public function getCssAssetsWithFallback(): array
    {
        $assets = $this->getAllCssAssets();
        $validAssets = $this->validateAssetIntegrity($assets);
        
        // If critical assets are missing, add fallbacks
        $missingAssets = $this->getMissingAssetsWithFallbacks();
        $fallbacks = $this->getFallbackAssets();
        
        if (!empty($missingAssets)) {
            foreach ($fallbacks['css'] as $fallbackCss) {
                if (!in_array($fallbackCss, $validAssets)) {
                    $validAssets[] = $fallbackCss;
                }
            }
        }
        
        return $validAssets;
    }

    /**
     * Get enhanced JavaScript assets with fallback handling
     * 
     * @return array JavaScript assets with error handling
     */
    public function getJsAssetsWithFallback(): array
    {
        $assets = $this->getAllJsAssets();
        $headAssets = $this->validateAssetIntegrity($assets['head']);
        $bodyAssets = $this->validateAssetIntegrity($assets['body']);
        
        // Check for missing critical assets
        $missingAssets = $this->getMissingAssetsWithFallbacks();
        $fallbacks = $this->getFallbackAssets();
        
        if (!empty($missingAssets)) {
            // Add fallback JavaScript assets if needed
            foreach ($fallbacks['js'] as $fallbackJs) {
                if (!in_array($fallbackJs, $bodyAssets)) {
                    $bodyAssets[] = $fallbackJs;
                }
            }
        }
        
        return [
            'head' => $headAssets,
            'body' => $bodyAssets,
            'errors' => !empty($missingAssets) ? $this->generateAssetErrorMessage($missingAssets) : ''
        ];
    }
}