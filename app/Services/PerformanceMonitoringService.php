<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PerformanceMonitoringService
{
    /**
     * Performance thresholds in milliseconds
     */
    private const THRESHOLDS = [
        'authentication' => 100,
        'page_load' => 500,
        'dashboard_init' => 1000,
        'asset_load' => 300,
        'database_query' => 50,
    ];

    /**
     * Monitor a process and log if it exceeds thresholds
     */
    public function monitor(string $processName, callable $callback)
    {
        $startTime = microtime(true);
        
        try {
            $result = $callback();
            
            $endTime = microtime(true);
            $duration = ($endTime - $startTime) * 1000;
            
            $this->recordMetric($processName, $duration, true);
            
            return $result;
        } catch (\Exception $e) {
            $endTime = microtime(true);
            $duration = ($endTime - $startTime) * 1000;
            
            $this->recordMetric($processName, $duration, false);
            
            throw $e;
        }
    }

    /**
     * Record performance metric
     */
    private function recordMetric(string $processName, float $duration, bool $success): void
    {
        $threshold = self::THRESHOLDS[$processName] ?? 1000;
        
        $metric = [
            'process' => $processName,
            'duration' => $duration,
            'threshold' => $threshold,
            'success' => $success,
            'exceeds_threshold' => $duration > $threshold,
            'timestamp' => now()->toISOString(),
        ];
        
        // Log if threshold exceeded
        if ($duration > $threshold) {
            Log::warning('Performance threshold exceeded', $metric);
        }
        
        // Store in cache for reporting
        $this->storeMetric($metric);
    }

    /**
     * Store metric in cache for performance reporting
     */
    private function storeMetric(array $metric): void
    {
        $key = 'performance_metrics';
        $metrics = Cache::get($key, []);
        
        $metrics[] = $metric;
        
        // Keep only last 100 metrics
        if (count($metrics) > 100) {
            $metrics = array_slice($metrics, -100);
        }
        
        Cache::put($key, $metrics, now()->addHours(24));
    }

    /**
     * Get performance report
     */
    public function getPerformanceReport(): array
    {
        $metrics = Cache::get('performance_metrics', []);
        
        if (empty($metrics)) {
            return [
                'status' => 'no_data',
                'message' => 'No performance metrics available',
            ];
        }
        
        $report = [];
        $processes = [];
        
        foreach ($metrics as $metric) {
            $process = $metric['process'];
            
            if (!isset($processes[$process])) {
                $processes[$process] = [
                    'count' => 0,
                    'total_duration' => 0,
                    'threshold_violations' => 0,
                    'success_count' => 0,
                    'min_duration' => null,
                    'max_duration' => null,
                ];
            }
            
            $processes[$process]['count']++;
            $processes[$process]['total_duration'] += $metric['duration'];
            
            if ($metric['exceeds_threshold']) {
                $processes[$process]['threshold_violations']++;
            }
            
            if ($metric['success']) {
                $processes[$process]['success_count']++;
            }
            
            if (is_null($processes[$process]['min_duration']) || $metric['duration'] < $processes[$process]['min_duration']) {
                $processes[$process]['min_duration'] = $metric['duration'];
            }
            
            if (is_null($processes[$process]['max_duration']) || $metric['duration'] > $processes[$process]['max_duration']) {
                $processes[$process]['max_duration'] = $metric['duration'];
            }
        }
        
        foreach ($processes as $process => $data) {
            $report[$process] = [
                'average_duration' => round($data['total_duration'] / $data['count'], 2),
                'min_duration' => round($data['min_duration'], 2),
                'max_duration' => round($data['max_duration'], 2),
                'threshold' => self::THRESHOLDS[$process] ?? 1000,
                'violation_rate' => round(($data['threshold_violations'] / $data['count']) * 100, 2),
                'success_rate' => round(($data['success_count'] / $data['count']) * 100, 2),
                'total_requests' => $data['count'],
            ];
        }
        
        return [
            'status' => 'success',
            'generated_at' => now()->toISOString(),
            'total_metrics' => count($metrics),
            'processes' => $report,
            'thresholds' => self::THRESHOLDS,
        ];
    }

    /**
     * Check if system meets performance requirements
     */
    public function validatePerformanceRequirements(): array
    {
        $report = $this->getPerformanceReport();
        
        if ($report['status'] === 'no_data') {
            return [
                'status' => 'insufficient_data',
                'message' => 'Not enough performance data to validate requirements',
                'requirements_met' => false,
            ];
        }
        
        $requirements = [
            'authentication' => ['threshold' => 100, 'description' => 'Authentication < 100ms'],
            'page_load' => ['threshold' => 500, 'description' => 'Page loads < 500ms'],
            'dashboard_init' => ['threshold' => 1000, 'description' => 'Dashboard initialization < 1s'],
        ];
        
        $validationResults = [];
        $allRequirementsMet = true;
        
        foreach ($requirements as $process => $requirement) {
            if (isset($report['processes'][$process])) {
                $processData = $report['processes'][$process];
                $requirementMet = $processData['average_duration'] <= $requirement['threshold'] && 
                                 $processData['violation_rate'] <= 10; // Allow 10% violation rate
                
                $validationResults[$process] = [
                    'description' => $requirement['description'],
                    'average_duration' => $processData['average_duration'],
                    'threshold' => $requirement['threshold'],
                    'violation_rate' => $processData['violation_rate'],
                    'requirement_met' => $requirementMet,
                ];
                
                if (!$requirementMet) {
                    $allRequirementsMet = false;
                }
            } else {
                $validationResults[$process] = [
                    'description' => $requirement['description'],
                    'requirement_met' => false,
                    'message' => 'No data available for this process',
                ];
                $allRequirementsMet = false;
            }
        }
        
        return [
            'status' => 'validation_complete',
            'requirements_met' => $allRequirementsMet,
            'validation_results' => $validationResults,
            'overall_score' => $this->calculateOverallScore($validationResults),
        ];
    }

    /**
     * Calculate overall performance score
     */
    private function calculateOverallScore(array $validationResults): float
    {
        $totalProcesses = count($validationResults);
        $passedProcesses = 0;
        
        foreach ($validationResults as $result) {
            if ($result['requirement_met']) {
                $passedProcesses++;
            }
        }
        
        return $totalProcesses > 0 ? round(($passedProcesses / $totalProcesses) * 100, 2) : 0;
    }

    /**
     * Clear performance metrics
     */
    public function clearMetrics(): void
    {
        Cache::forget('performance_metrics');
    }

    /**
     * Get current performance thresholds
     */
    public function getThresholds(): array
    {
        return self::THRESHOLDS;
    }
}