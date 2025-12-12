<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Report;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard sesuai role.
     */
    public function index()
    {
        $user = auth()->user();
        $weather = $this->getWeatherData();

        // Statistik berdasarkan role
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
        } else { // teknisi
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

    /**
     * Ambil data cuaca dari API.
     */
    private function getWeatherData()
    {
        try {
            // Menggunakan OpenWeatherMap API (gratis)
            // API Key demo - ganti dengan API key Anda sendiri
            $apiKey = 'demo'; // Ganti dengan API key yang valid
            $city = 'Palembang';
            
            // Fallback data jika API gagal
            $weatherData = [
                'city' => 'Palembang',
                'temp' => '28',
                'description' => 'Cerah Berawan',
                'icon' => '02d',
                'humidity' => '75',
            ];

            // Uncomment ini jika punya API key valid
            // $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            //     'q' => $city,
            //     'appid' => $apiKey,
            //     'units' => 'metric',
            //     'lang' => 'id'
            // ]);

            // if ($response->successful()) {
            //     $data = $response->json();
            //     $weatherData = [
            //         'city' => $data['name'],
            //         'temp' => round($data['main']['temp']),
            //         'description' => ucfirst($data['weather'][0]['description']),
            //         'icon' => $data['weather'][0]['icon'],
            //         'humidity' => $data['main']['humidity'],
            //     ];
            // }

            return $weatherData;
        } catch (\Exception $e) {
            // Return data default jika ada error
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
