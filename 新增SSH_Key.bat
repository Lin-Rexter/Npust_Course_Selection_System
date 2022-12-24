set "params=%*" && cd /d "%CD%" && ( if exist "%temp%\getadmin.vbs" del "%temp%\getadmin.vbs" ) && fsutil dirty query %systemdrive% 1>nul 2>nul || (  echo Set UAC = CreateObject^("Shell.Application"^) : UAC.ShellExecute "cmd.exe", "/C cd ""%CD%"" && %~s0 %params%", "", "runas", 1 >>"%temp%\getadmin.vbs" && "%temp%\getadmin.vbs" && exit /B )
@echo off
cls

title 新增SSH-Key

CD /D "%USERPROFILE%/.ssh"

SET Git_Bash="C:\Program Files\Git\bin\bash.exe" --login -i -c

GOTO SSH-Key-Show-KeyFile

::REM ================================SSH-Key(設置金鑰)================================

:SSH-Key-Show-KeyFile
CLS
ECHO.
ECHO ==============================================================
ECHO                       現有SSH金鑰檔案
ECHO ==============================================================
ECHO.
%Git_Bash% "ls -al ~/.ssh"
GOTO SET-Email

:SET-Email
ECHO.
ECHO ==============================================================
ECHO                      SSH金鑰生成資料設定
ECHO ==============================================================
ECHO.
SET /P email="[1/2] 請輸入Github或者GitLab的Email: "
IF %ERRORLEVEL% NEQ 0 (CLS && ECHO 請輸入正確email && GOTO SSH-Key-Show-KeyFile)
GOTO SET-File

:SET-File
ECHO.
ECHO ==============================================================
ECHO                      SSH金鑰生成資料設定
ECHO ==============================================================
ECHO.
SET /P Key-FileName="[2/2] 請輸入要生成的密鑰文件名稱(Ex: id_ed25519_work): "
IF %ERRORLEVEL% NEQ 0 (CLS && ECHO 請輸入正確名稱 && GOTO SET-File)ELSE (GOTO Choice_SSH-key)

:Choice_SSH-key
ECHO.
ECHO ==============================================================
ECHO                         SSH密鑰類型
ECHO ==============================================================
ECHO.
ECHO --------------------------------------------------------------
ECHO [1] ED25519(優先)
ECHO [2] RSA(其次)
ECHO --------------------------------------------------------------
ECHO.
CHOICE /C 21 /N /M "選擇加密類型[1,2]: "
IF ERRORLEVEL 2 (
 GOTO ED25519
)ELSE IF ERRORLEVEL 1 (
 GOTO RSA
)

:ED25519
ECHO.
ECHO ==============================================================
ECHO.
ECHO 選擇加密類型: ED25519
ECHO.
%Git_Bash% "ssh-keygen -t ed25519 -N '' -f id_ed25519_"%Key-FileName%" -C "%email%""
IF %ERRORLEVEL% NEQ 0 (GOTO FAIL-ED25519)ELSE (PAUSE && GOTO SSH-Agent-Show-SSHFile)

:RSA
ECHO.
ECHO ==============================================================
ECHO.
ECHO 選擇加密類型: RSA
ECHO.
%Git_Bash% "ssh-keygen -t rsa -b 4096 -C "%email%""
IF %ERRORLEVEL% NEQ 0 (GOTO FAIL-RSA)ELSE (PAUSE && GOTO SSH-Agent-Show-SSHFile)

:FAIL-ED25519
ECHO.
ECHO ==============================================================
ECHO.
ECHO ED25519加密失敗!
CHOICE /C NY /N /M "是否選擇RSA加密[Y,N]: "
IF ERRORLEVEL 2 (
 GOTO RSA
)ELSE IF ERRORLEVEL 1 (
 GOTO EXIT
)

:FAIL-RSA
ECHO.
ECHO ==============================================================
ECHO.
ECHO RSA加密失敗!
CHOICE /C NY /N /M "是否選擇ED25519加密[Y,N]: "
IF ERRORLEVEL 2 (
 GOTO ED25519
)ELSE IF ERRORLEVEL 1 (
 GOTO EXIT
)

::REM ====================================SSH-Agent====================================

:SSH-Agent-Show-SSHFile
CLS
ECHO.
ECHO ==============================================================
ECHO                        現有SSH金鑰檔案
ECHO ==============================================================
ECHO.
%Git_Bash% "ls -al ~/.ssh"
GOTO SET-Email

:SET-Email
ECHO.
ECHO ==============================================================
ECHO                      	   資料設定
ECHO ==============================================================
ECHO.
SET /P SSH-FileName="請輸入金鑰檔名(私鑰): "
IF %ERRORLEVEL% NEQ 0 (CLS && ECHO 請確認是否輸入正確的私鑰檔名 && GOTO SSH-Agent-Show-SSHFile && GOTO SSH-Agent)

:SSH-Agent
CLS
ECHO.
ECHO ====================啟動SSH代理並添加SSH私鑰=====================
ECHO.
%Git_Bash% "eval `ssh-agent -s`" || "ssh-add ~/.ssh/%SSH-FileName%"
IF %ERRORLEVEL% NEQ 0 (GOTO FAIL-SSH-Agent)
GOTO Success-SSH-Agent

:Success-SSH-Agent
ECHO.
ECHO ==============================================================
ECHO.
ECHO 執行成功!
PAUSE
GOTO SSH-Test

:FAIL-SSH-Agent
ECHO.
ECHO ==============================================================
ECHO.
ECHO 啟動SSH代理失敗或是SSH密鑰添加失敗!
GOTO EXIT

::REM ====================================測試SSH連接====================================

:SSH-Test
CLS
ECHO.
ECHO ==========================測試SSH連接===========================
ECHO.
SET /P Host-Name="請輸入要連線的主機名稱(ex: github.com): "
ECHO.
%Git_Bash% "ssh -T git@"%Host-Name%""
IF %ERRORLEVEL% NEQ 0 (GOTO FAIL-SSH-Test)ELSE (GOTO EXIT)

:FAIL-SSH-Test
ECHO.
ECHO ==============================================================
ECHO.
ECHO 測試SSH連接失敗，請確認主機名稱是否有誤或是未將公鑰新增到Github或是GitLab帳號上!
PAUSE
GOTO SSH-Test

:EXIT
echo.
pause
exit