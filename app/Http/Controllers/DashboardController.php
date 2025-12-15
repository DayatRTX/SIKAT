<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Report;

class DashboardController extends Controller
{
    


    public function index()
    {
        $user = auth()->user();
        $weather = $this->getWeatherData();

        
        if ($user->role === 'mahasiswa') {
            $stats = [
                'total' => Report::where('user_id', $user->id)->count(),
                'pending' => Report::where('user_id', $user->id)->where('status', 'pending')->count(),
                'process' => Report::where('user_id', $user->id)->where('status', 'process')->count(),
                'done' => Report::where('user_id', $user->id)->where('status', 'done')->count(),
            ];
            $recentReports = Report::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        } elseif ($user->role === 'admin') {
            $stats = [
                'total' => Report::count(),
                'pending' => Report::where('status', 'pending')->count(),
                'process' => Report::where('status', 'process')->count(),
                'done' => Report::where('status', 'done')->count(),
            ];
            $recentReports = Report::with('user')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        } else { 
            $stats = [
                'total' => Report::where('technician_id', $user->id)->count(),
                'pending' => Report::where('technician_id', $user->id)->where('status', 'pending')->count(),
                'process' => Report::where('technician_id', $user->id)->where('status', 'process')->count(),
                'done' => Report::where('technician_id', $user->id)->where('status', 'done')->count(),
            ];
            $recentReports = Report::where('technician_id', $user->id)
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

        return view('dashboard', compact('stats', 'recentReports', 'weather'));
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
