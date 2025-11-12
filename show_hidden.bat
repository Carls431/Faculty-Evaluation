@echo off
title Show Hidden Files - Developer Access
color 0A

echo.
echo Showing hidden system files...
echo.

attrib -h -s "unlock_system.bat" 2>nul
attrib -h -s "lock_system.bat" 2>nul
attrib -h -s "hide_unlock_files.bat" 2>nul
attrib -h -s "create_desktop_shortcut.vbs" 2>nul
attrib -h "HIDDEN_ACCESS_GUIDE.txt" 2>nul
attrib -h "ACCESS_CONTROL_README.md" 2>nul

echo Files are now visible!
echo.
echo Press any key to close...
pause >nul
