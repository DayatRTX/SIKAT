@echo off
REM ================================================
REM  SiGAP Polsri - Asset Builder
REM  Build Tailwind CSS untuk Production
REM ================================================

echo =========================================
echo   SiGAP Polsri - Asset Builder
echo =========================================
echo.

REM Check if node_modules exists
if not exist "node_modules" (
    echo [1/2] Installing NPM dependencies...
    call npm install
    echo.
) else (
    echo [1/2] NPM dependencies already installed
    echo.
)

echo [2/2] Building assets for production...
call npm run build

echo.
echo =========================================
echo   Build selesai!
echo   Assets tersimpan di folder: public/build/
echo =========================================
echo.

pause
