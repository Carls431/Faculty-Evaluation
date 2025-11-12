@echo off
title Hide Individual Files - Faculty Evaluation System
color 0E
cls

echo ============================================
echo   HIDE INDIVIDUAL FILES
echo ============================================
echo.
echo   Choose which file to hide:
echo.
echo   1. Hide unlock_system.bat
echo   2. Hide lock_system.bat
echo   3. Hide both unlock and lock files
echo   4. Hide quick_unlock.bat
echo   5. Hide all access control files
echo   6. Exit
echo.
echo ============================================
echo.

set /p choice="Enter your choice (1-6): "

if "%choice%"=="1" (
    attrib +h +s "unlock_system.bat"
    echo.
    echo unlock_system.bat is now hidden!
    goto end
)

if "%choice%"=="2" (
    attrib +h +s "lock_system.bat"
    echo.
    echo lock_system.bat is now hidden!
    goto end
)

if "%choice%"=="3" (
    attrib +h +s "unlock_system.bat"
    attrib +h +s "lock_system.bat"
    echo.
    echo Both unlock and lock files are now hidden!
    goto end
)

if "%choice%"=="4" (
    attrib +h +s "quick_unlock.bat"
    echo.
    echo quick_unlock.bat is now hidden!
    goto end
)

if "%choice%"=="5" (
    attrib +h +s "unlock_system.bat"
    attrib +h +s "lock_system.bat"
    attrib +h +s "quick_unlock.bat"
    attrib +h +s "hide_unlock_files.bat"
    attrib +h +s "create_desktop_shortcut.vbs"
    attrib +h "HIDDEN_ACCESS_GUIDE.txt"
    attrib +h "ACCESS_CONTROL_README.md"
    echo.
    echo All access control files are now hidden!
    goto end
)

if "%choice%"=="6" (
    echo.
    echo Cancelled.
    goto end
)

echo.
echo Invalid choice. Please try again.

:end
echo.
echo Press any key to exit...
pause >nul
