@echo off
title METAIR ENTERPRISE - Laravel Server
echo ============================================
echo   METAIR ENTERPRISE - starting server
echo ============================================
echo.
echo   IMPORTANT: XAMPP Control Panel e MySQL "Start"
echo   kore nin (green hoye gele) tarpor eta cholbe.
echo.
echo   Site: http://localhost:8000
echo   Bondho korte: ei window e Ctrl+C chapun.
echo ============================================
echo.
cd /d "F:\extrain web all project\METAIR\METAIR ENTERPRISE e commarce laravel"
"C:\xampp_new\php\php.exe" artisan serve --host=127.0.0.1 --port=8000
pause
