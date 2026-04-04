<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Mock dashboard data
        $stats = [
            'total_users' => 1250,
            'active_streams' => 847,
            'total_channels' => 1500,
            'server_load' => 78,
            'active_sessions' => 324,
            'bandwidth_usage' => 2500
        ];
        
        return view('dashboard', compact('stats'));
    }
}