set "params=%*" && cd /d "%CD%" && ( if exist "%temp%\getadmin.vbs" del "%temp%\getadmin.vbs" ) && fsutil dirty query %systemdrive% 1>nul 2>nul || (  echo Set UAC = CreateObject^("Shell.Application"^) : UAC.ShellExecute "cmd.exe", "/C cd ""%CD%"" && %~s0 %params%", "", "runas", 1 >>"%temp%\getadmin.vbs" && "%temp%\getadmin.vbs" && exit /B )
@echo off
cls

CD /D "%CD%"

:Meun
cls
ECHO.
ECHO ==============================================================
ECHO                         ��ܹB��覡
ECHO ==============================================================
ECHO.
ECHO ------------------------------------------------------------
ECHO [1] ����
ECHO [2] ���}
ECHO ------------------------------------------------------------
ECHO.

CHOICE /C 21 /N /M "��ܥ\��[1, 2]: "
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
	echo git rm ���~!
)ELSE (
	echo.
	echo git rm ���\!
)
goto add

:add
echo.
echo ===========
git add .
if %errorlevel% NEQ 0 (
	echo.
	echo git add ���~!
)ELSE (
	echo.
	echo git add ���\!
)
goto commit

:commit
echo.
echo ===========
SET /P "message=�п�J����T��(�i�H��J��擄����άO���ɶ�����): "
git commit -am "%message%"
if %errorlevel% NEQ 0 (
	echo.
	echo git commit ���~!
)ELSE (
	echo.
	echo git commit ���\!
)
goto push

:push
echo.
echo ===========
git push
if %errorlevel% NEQ 0 (
	echo.
	echo git push ���~!
)ELSE (
	echo.
	echo git push ���\!
)
ECHO.
Pause
GOTO Meun
