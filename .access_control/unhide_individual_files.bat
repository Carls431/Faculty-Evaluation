@echo off
title Unhide Individual Files - Faculty Evaluation System
color 0A
cls

echo ============================================
echo   UNHIDE INDIVIDUAL FILES
echo ============================================
echo.
echo   Choose which file to unhide:
echo.
echo   1. Unhide unlock_system.bat
echo   2. Unhide lock_system.bat
echo   3. Unhide both unlock and lock files
echo   4. Unhide quick_unlock.bat
echo   5. Unhide all access control files
echo   6. Exit
echo.
echo ============================================
echo.

set /p choice="Enter your choice (1-6): "

if "%choice%"=="1" (
    attrib -h -s "unlock_system.bat"
    echo.
    echo unlock_system.bat is now visible!
    goto end
)

if "%choice%"=="2" (
    attrib -h -s "lock_system.bat"
    echo.
    echo lock_system.bat is now visible!
    goto end
)

if "%choice%"=="3" (
    attrib -h -s "unlock_system.bat"
    attrib -h -s "lock_system.bat"
    echo.
    echo Both unlock and lock files are now visible!
    goto end
)

if "%choice%"=="4" (
    attrib -h -s "quick_unlock.bat"
    echo.
    echo quick_unlock.bat is now visible!
    goto end
)

if "%choice%"=="5" (
    attrib -h -s "unlock_system.bat"
    attrib -h -s "lock_system.bat"
    attrib -h -s "quick_unlock.bat"
    attrib -h -s "hide_unlock_files.bat"
    attrib -h -s "create_desktop_shortcut.vbs"
    attrib -h "HIDDEN_ACCESS_GUIDE.txt"
    attrib -h "ACCESS_CONTROL_README.md"
    echo.
    echo All access control files are now visible!
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
