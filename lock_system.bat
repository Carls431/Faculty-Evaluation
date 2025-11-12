@echo off
color 0E
title Faculty Evaluation System - Lock System
cls

echo ============================================
echo   FACULTY EVALUATION SYSTEM - LOCK
echo ============================================
echo.
echo   This will lock the system and prevent
echo   browser access until unlocked again.
echo.
echo ============================================
echo.

set /p confirm="Are you sure you want to lock the system? (Y/N): "

if /i "%confirm%"=="Yes" (
    echo.
    echo   Locking system...
    
    REM Delete access token file
    if exist "%~dp0.system_access" (
        del "%~dp0.system_access"
        echo   System locked successfully!
    ) else (
        echo   System is already locked.
    )
    
    echo.
    echo   Press any key to exit...
    pause >nul
) else (
    echo.
    echo   Lock cancelled.
    echo.
    echo   Press any key to exit...
    pause >nul
)
