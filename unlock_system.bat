@echo off
color 0C
title Faculty Evaluation System - Access Control
cls

echo ============================================
echo   FACULTY EVALUATION SYSTEM - LOCKED
echo ============================================
echo.
echo   System is currently locked.
echo   Enter the developer's name to unlock.
echo.
echo ============================================
echo.

set /p username="Enter Developer Name: "

if /i "%username%"=="Carl" (
    echo.
    echo ============================================
    echo   ACCESS GRANTED!
    echo ============================================
    echo.
    echo   Generating access token...
    
    REM Create access token file with timestamp
    echo %date% %time% > "%~dp0.system_access"
    
    echo   System unlocked successfully!
    echo   You can now access the system via browser.
    echo.
    echo   Access will remain active until:
    echo   - You restart Apache/XAMPP
    echo   - You run lock_system.bat
    echo   - You restart your computer
    echo.
    
    color 0A
    echo   Starting Apache and MySQL...
    echo.
    
    REM Start XAMPP services
    net start Apache2.4 2>nul
    net start MySQL 2>nul
    
    echo   Opening system in browser...
    timeout /t 2 /nobreak >nul
    start http://localhost/eval
    
    echo.
    echo   Press any key to close this window...
    pause >nul
    
) else (
    echo.
    echo ============================================
    echo   ACCESS DENIED!
    echo ============================================
    echo.
    echo   Invalid developer name.
    echo   System remains locked.
    echo.
    echo   Press any key to exit...
    pause >nul
    exit
)
