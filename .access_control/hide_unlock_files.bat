@echo off
echo Hiding unlock system files...

REM Create hidden system folder
if not exist "%~dp0.syslock" mkdir "%~dp0.syslock"

REM Move unlock/lock scripts to hidden folder
move "%~dp0unlock_system.bat" "%~dp0.syslock\unlock_system.bat" >nul 2>&1
move "%~dp0lock_system.bat" "%~dp0.syslock\lock_system.bat" >nul 2>&1

REM Set folder as hidden and system
attrib +h +s "%~dp0.syslock"

REM Set files as hidden and system
attrib +h +s "%~dp0.syslock\unlock_system.bat"
attrib +h +s "%~dp0.syslock\lock_system.bat"

echo.
echo Files hidden successfully!
echo.
echo Location: C:\xampp\htdocs\eval\.syslock\
echo.
echo To unlock system, run:
echo C:\xampp\htdocs\eval\.syslock\unlock_system.bat
echo.
echo Press any key to exit...
pause >nul

REM Delete this setup script after running
del "%~dp0hide_unlock_files.bat"
