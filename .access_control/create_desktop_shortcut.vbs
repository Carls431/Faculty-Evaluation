Set oWS = WScript.CreateObject("WScript.Shell")
sLinkFile = oWS.SpecialFolders("Desktop") & "\Unlock Eval System.lnk"
Set oLink = oWS.CreateShortcut(sLinkFile)
oLink.TargetPath = "C:\xampp\htdocs\eval\.syslock\unlock_system.bat"
oLink.WindowStyle = 1
oLink.IconLocation = "C:\Windows\System32\shell32.dll,47"
oLink.Description = "Unlock Faculty Evaluation System"
oLink.WorkingDirectory = "C:\xampp\htdocs\eval"
oLink.Save

MsgBox "Desktop shortcut created successfully!" & vbCrLf & vbCrLf & "You can now unlock the system from your desktop.", vbInformation, "Shortcut Created"
