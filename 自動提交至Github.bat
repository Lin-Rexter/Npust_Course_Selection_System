set "params=%*" && cd /d "%CD%" && ( if exist "%temp%\getadmin.vbs" del "%temp%\getadmin.vbs" ) && fsutil dirty query %systemdrive% 1>nul 2>nul || (  echo Set UAC = CreateObject^("Shell.Application"^) : UAC.ShellExecute "cmd.exe", "/C cd ""%CD%"" && %~s0 %params%", "", "runas", 1 >>"%temp%\getadmin.vbs" && "%temp%\getadmin.vbs" && exit /B )
@echo off
cls

CD /D "%CD%"

:Meun
cls
ECHO.
ECHO ==============================================================
ECHO                         選擇運行方式
ECHO ==============================================================
ECHO.
ECHO ------------------------------------------------------------
ECHO [1] 提交
ECHO [2] 離開
ECHO ------------------------------------------------------------
ECHO.

CHOICE /C 21 /N /M "選擇功能[1, 2]: "
IF ERRORLEVEL 2 (
 Goto rm_cached
)ELSE IF ERRORLEVEL 1 (
 exit
)

:rm_cached
echo.
echo ===========
git rm -r --cached .
if %errorlevel% NEQ 0 (
	echo.
	echo git rm 錯誤!
)ELSE (
	echo.
	echo git rm 成功!
)
goto add

:add
echo.
echo ===========
git add .
if %errorlevel% NEQ 0 (
	echo.
	echo git add 錯誤!
)ELSE (
	echo.
	echo git add 成功!
)
goto commit

:commit
echo.
echo ===========
SET /P "message=請輸入提交訊息(可以輸入更改什麼文件或是更改時間等等): "
git commit -am "%message%"
if %errorlevel% NEQ 0 (
	echo.
	echo git commit 錯誤!
)ELSE (
	echo.
	echo git commit 成功!
)
goto push

:push
echo.
echo ===========
git push
if %errorlevel% NEQ 0 (
	echo.
	echo git push 錯誤!
)ELSE (
	echo.
	echo git push 成功!
)
ECHO.
Pause
GOTO Meun
