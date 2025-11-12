@echo off
title Create Quick Access - Faculty Evaluation System
color 0D
cls

echo ============================================
echo   CREATE QUICK ACCESS SHORTCUTS
echo ============================================
echo.
echo   This will create easy access shortcuts
echo   for your organized access control files.
echo.
echo   What do you want to create?
echo.
echo   1. Desktop shortcut for Unlock System
echo   2. Desktop shortcut for Lock System
echo   3. Quick access batch file (in main folder)
echo   4. All of the above
echo   5. Exit
echo.
echo ============================================
echo.

set /p choice="Enter your choice (1-5): "

if "%choice%"=="1" (
    echo Creating desktop shortcut for Unlock System...
    echo Set oWS = WScript.CreateObject("WScript.Shell") > "%temp%\CreateShortcut.vbs"
    echo sLinkFile = "%USERPROFILE%\Desktop\Unlock Eval System.lnk" >> "%temp%\CreateShortcut.vbs"
    echo Set oLink = oWS.CreateShortcut(sLinkFile) >> "%temp%\CreateShortcut.vbs"
    echo oLink.TargetPath = "C:\xampp\htdocs\eval\.access_control\unlock_system.bat" >> "%temp%\CreateShortcut.vbs"
    echo oLink.WorkingDirectory = "C:\xampp\htdocs\eval\.access_control" >> "%temp%\CreateShortcut.vbs"
    echo oLink.Description = "Unlock Faculty Evaluation System" >> "%temp%\CreateShortcut.vbs"
    echo oLink.Save >> "%temp%\CreateShortcut.vbs"
    cscript "%temp%\CreateShortcut.vbs" >nul
    del "%temp%\CreateShortcut.vbs"
    echo Desktop shortcut created!
    goto end
)

if "%choice%"=="2" (
    echo Creating desktop shortcut for Lock System...
    echo Set oWS = WScript.CreateObject("WScript.Shell") > "%temp%\CreateShortcut.vbs"
    echo sLinkFile = "%USERPROFILE%\Desktop\Lock Eval System.lnk" >> "%temp%\CreateShortcut.vbs"
    echo Set oLink = oWS.CreateShortcut(sLinkFile) >> "%temp%\CreateShortcut.vbs"
    echo oLink.TargetPath = "C:\xampp\htdocs\eval\.access_control\lock_system.bat" >> "%temp%\CreateShortcut.vbs"
    echo oLink.WorkingDirectory = "C:\xampp\htdocs\eval\.access_control" >> "%temp%\CreateShortcut.vbs"
    echo oLink.Description = "Lock Faculty Evaluation System" >> "%temp%\CreateShortcut.vbs"
    echo oLink.Save >> "%temp%\CreateShortcut.vbs"
    cscript "%temp%\CreateShortcut.vbs" >nul
    del "%temp%\CreateShortcut.vbs"
    echo Desktop shortcut created!
    goto end
)

if "%choice%"=="3" (
    echo Creating quick access batch file...
    echo @echo off > "%~dp0access_control.bat"
    echo title Quick Access - Access Control >> "%~dp0access_control.bat"
    echo color 0E >> "%~dp0access_control.bat"
    echo cls >> "%~dp0access_control.bat"
    echo echo ============================================ >> "%~dp0access_control.bat"
    echo echo   QUICK ACCESS - ACCESS CONTROL >> "%~dp0access_control.bat"
    echo echo ============================================ >> "%~dp0access_control.bat"
    echo echo. >> "%~dp0access_control.bat"
    echo echo   1. Unlock System >> "%~dp0access_control.bat"
    echo echo   2. Lock System >> "%~dp0access_control.bat"
    echo echo   3. Open Access Control Folder >> "%~dp0access_control.bat"
    echo echo   4. Exit >> "%~dp0access_control.bat"
    echo echo. >> "%~dp0access_control.bat"
    echo echo ============================================ >> "%~dp0access_control.bat"
    echo echo. >> "%~dp0access_control.bat"
    echo set /p choice="Enter your choice (1-4): " >> "%~dp0access_control.bat"
    echo if "%%choice%%"=="1" start "" "%%~dp0.access_control\unlock_system.bat" >> "%~dp0access_control.bat"
    echo if "%%choice%%"=="2" start "" "%%~dp0.access_control\lock_system.bat" >> "%~dp0access_control.bat"
    echo if "%%choice%%"=="3" explorer "%%~dp0.access_control" >> "%~dp0access_control.bat"
    echo Quick access file created: access_control.bat
    goto end
)

if "%choice%"=="4" (
    echo Creating all shortcuts...
    
    REM Desktop shortcut for Unlock
    echo Set oWS = WScript.CreateObject("WScript.Shell") > "%temp%\CreateShortcut.vbs"
    echo sLinkFile = "%USERPROFILE%\Desktop\Unlock Eval System.lnk" >> "%temp%\CreateShortcut.vbs"
    echo Set oLink = oWS.CreateShortcut(sLinkFile) >> "%temp%\CreateShortcut.vbs"
    echo oLink.TargetPath = "C:\xampp\htdocs\eval\.access_control\unlock_system.bat" >> "%temp%\CreateShortcut.vbs"
    echo oLink.WorkingDirectory = "C:\xampp\htdocs\eval\.access_control" >> "%temp%\CreateShortcut.vbs"
    echo oLink.Description = "Unlock Faculty Evaluation System" >> "%temp%\CreateShortcut.vbs"
    echo oLink.Save >> "%temp%\CreateShortcut.vbs"
    cscript "%temp%\CreateShortcut.vbs" >nul
    del "%temp%\CreateShortcut.vbs"
    
    REM Desktop shortcut for Lock
    echo Set oWS = WScript.CreateObject("WScript.Shell") > "%temp%\CreateShortcut.vbs"
    echo sLinkFile = "%USERPROFILE%\Desktop\Lock Eval System.lnk" >> "%temp%\CreateShortcut.vbs"
    echo Set oLink = oWS.CreateShortcut(sLinkFile) >> "%temp%\CreateShortcut.vbs"
    echo oLink.TargetPath = "C:\xampp\htdocs\eval\.access_control\lock_system.bat" >> "%temp%\CreateShortcut.vbs"
    echo oLink.WorkingDirectory = "C:\xampp\htdocs\eval\.access_control" >> "%temp%\CreateShortcut.vbs"
    echo oLink.Description = "Lock Faculty Evaluation System" >> "%temp%\CreateShortcut.vbs"
    echo oLink.Save >> "%temp%\CreateShortcut.vbs"
    cscript "%temp%\CreateShortcut.vbs" >nul
    del "%temp%\CreateShortcut.vbs"
    
    REM Quick access batch file
    echo @echo off > "%~dp0access_control.bat"
    echo title Quick Access - Access Control >> "%~dp0access_control.bat"
    echo color 0E >> "%~dp0access_control.bat"
    echo cls >> "%~dp0access_control.bat"
    echo echo ============================================ >> "%~dp0access_control.bat"
    echo echo   QUICK ACCESS - ACCESS CONTROL >> "%~dp0access_control.bat"
    echo echo ============================================ >> "%~dp0access_control.bat"
    echo echo. >> "%~dp0access_control.bat"
    echo echo   1. Unlock System >> "%~dp0access_control.bat"
    echo echo   2. Lock System >> "%~dp0access_control.bat"
    echo echo   3. Open Access Control Folder >> "%~dp0access_control.bat"
    echo echo   4. Exit >> "%~dp0access_control.bat"
    echo echo. >> "%~dp0access_control.bat"
    echo echo ============================================ >> "%~dp0access_control.bat"
    echo echo. >> "%~dp0access_control.bat"
    echo set /p choice="Enter your choice (1-4): " >> "%~dp0access_control.bat"
    echo if "%%choice%%"=="1" start "" "%%~dp0.access_control\unlock_system.bat" >> "%~dp0access_control.bat"
    echo if "%%choice%%"=="2" start "" "%%~dp0.access_control\lock_system.bat" >> "%~dp0access_control.bat"
    echo if "%%choice%%"=="3" explorer "%%~dp0.access_control" >> "%~dp0access_control.bat"
    
    echo All shortcuts created successfully!
    goto end
)

if "%choice%"=="5" (
    echo Cancelled.
    goto end
)

echo Invalid choice.

:end
echo.
echo Press any key to exit...
pause >nul
