@echo off
REM ================================================
REM  SiGAP Polsri - Laravel Server Launcher
REM  Quick Start Script
REM ================================================

echo =========================================
echo   SiGAP Polsri - Server Launcher
echo =========================================
echo.

REM Check if in correct directory
if not exist "artisan" (
    echo ERROR: File artisan tidak ditemukan!
    echo Pastikan Anda menjalankan script ini di folder project.
    pause
    exit /b
)

echo [1/3] Checking database connection...
php artisan migrate:status >nul 2>&1
if errorlevel 1 (
    echo WARNING: Database belum siap atau belum di-migrate
    echo.
    echo Jalankan perintah berikut terlebih dahulu:
    echo   php artisan migrate:fresh --seed
    echo.
    pause
)

echo [2/3] Clearing cache...
php artisan config:clear >nul 2>&1
php artisan cache:clear >nul 2>&1

echo [3/3] Starting Laravel server...
echo.
echo =========================================
echo   Server akan berjalan di:
echo   http://127.0.0.1:8000
echo   http://localhost:8000
echo =========================================
echo.
echo AKUN DEMO:
echo   Mahasiswa: mahasiswa@polsri.ac.id / mahasiswa123
echo   Admin:     admin@polsri.ac.id / admin123
echo   Teknisi:   teknisi@polsri.ac.id / teknisi123
echo.
echo Tekan Ctrl+C untuk menghentikan server
echo =========================================
echo.

REM Start server
php artisan serve

pause
