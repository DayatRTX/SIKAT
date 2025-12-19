<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Report;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $weather = $this->getWeatherData();

        // Base query based on role
        if ($user->role === 'mahasiswa') {
            $baseQuery = Report::where('user_id', $user->id);
        } elseif ($user->role === 'admin') {
            $baseQuery = Report::query();
        } else { // teknisi
            $baseQuery = Report::where('technician_id', $user->id);
        }

        // Stats
        $stats = [
            'total' => (clone $baseQuery)->count(),
            'pending' => (clone $baseQuery)->where('status', 'pending')->count(),
            'process' => (clone $baseQuery)->where('status', 'process')->count(),
            'done' => (clone $baseQuery)->where('status', 'done')->count(),
            'rejected' => (clone $baseQuery)->where('status', 'rejected')->count(),
        ];

        // Recent Reports
        $recentReports = (clone $baseQuery)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Chart Data - Status Distribution
        $chartStatus = [
            'labels' => ['Pending', 'Proses', 'Selesai', 'Ditolak'],
            'data' => [$stats['pending'], $stats['process'], $stats['done'], $stats['rejected']],
            'colors' => ['#F59E0B', '#06B6D4', '#10B981', '#EF4444'],
        ];

        // Chart Data - Category Distribution
        $categoryData = (clone $baseQuery)
            ->selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();
        
        $chartCategory = [
            'labels' => array_keys($categoryData) ?: ['Tidak ada data'],
            'data' => array_values($categoryData) ?: [0],
            'colors' => ['#8B5CF6', '#EC4899', '#F59E0B', '#10B981', '#06B6D4', '#6366F1'],
        ];

        // Chart Data - Trend 30 days
        $trendData = [];
        $trendLabels = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $trendLabels[] = $date->format('d M');
            
            $count = (clone $baseQuery)
                ->whereDate('created_at', $date->toDateString())
                ->count();
            $trendData[] = $count;
        }

        $chartTrend = [
            'labels' => $trendLabels,
            'data' => $trendData,
        ];

        return view('dashboard', compact('stats', 'recentReports', 'weather', 'chartStatus', 'chartCategory', 'chartTrend'));
    }

    


    private function getWeatherData()
    {
        try {
            
            
            $apiKey = 'demo'; 
            $city = 'Palembang';
            
            
            $weatherData = [
                'city' => 'Palembang',
                'temp' => '28',
                'description' => 'Cerah Berawan',
                'icon' => '02d',
                'humidity' => '75',
            ];

            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            

            return $weatherData;
        } catch (\Exception $e) {
            
            return [
                'city' => 'Palembang',
                'temp' => '28',
                'description' => 'Data tidak tersedia',
                'icon' => '01d',
                'humidity' => '-',
            ];
        }
    }
}
