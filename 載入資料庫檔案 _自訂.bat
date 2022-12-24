set "params=%*" && cd /d "%CD%" && ( if exist "%temp%\getadmin.vbs" del "%temp%\getadmin.vbs" ) && fsutil dirty query %systemdrive% 1>nul 2>nul || (  ECHO Set UAC = CreateObject^("Shell.Application"^) : UAC.ShellExecute "cmd.exe", "/C cd ""%CD%"" && %~s0 %params%", "", "runas", 1 >>"%temp%\getadmin.vbs" && "%temp%\getadmin.vbs" && exit /B )
@ECHO OFF
CLS

TITLE ���J��Ʈw

::COLOR F0

:: ���O��m
SET "mysql=C:\xampp\mysql\bin\mysql.exe"

:: �p���Q�n�C����J�b�K���Ʈw�ɮ׸��|�A�Х��]�w(�]�w�e�A�Ч�e�������_������Ѥ�r�R��)
:: �b���W�� SET User_name = ""
SET "User_name=B11056051"
:: �b���K�X SET password = ""
SET "password=password"
:: �n���J����Ʈw�ɮ׸��|(�w�]�w�q�{���|) SET DBPath = ".\database\npust_course_selection_system.sql"
SET "DBPath=.\database\npust_course_selection_system.sql"

IF NOT DEFINED User_name (
	GOTO Username
)

IF NOT DEFINED Password (
	GOTO Password
)

IF NOT DEFINED DBPath (
	GOTO Database
)

GOTO Check

:Username
CLS
ECHO.
ECHO ==============================================================
ECHO                            �b���W�ٳ]�w
ECHO ==============================================================
SET User_name = ""
SET /P "User_name=�п�J��Ʈw�b���W��(�p���إ߱b���п�JN/n�A�q�{root): "
IF "%User_name%" EQU "" (
	CALL :Print �п�J�b���W��!
	PAUSE
	GOTO Username
)ELSE IF /I "%User_name%" EQU "N" (
	SET "User_name%=root"
)
GOTO Password

:Password
CLS
ECHO.
ECHO ==============================================================
ECHO                            �b���K�X�]�w
ECHO ==============================================================
SET password = ""
SET /P "password=�п�J��Ʈw�b���K�X(�p�G���]�w�K�X��JN/n; �^��W�@�B��JB/b): "
IF "%password%" EQU "" (
	CALL :Print �п�J�b���K�X!
	PAUSE
	GOTO Password
)ELSE IF /I "%password%" EQU "N" (
	SET "password="
)ELSE IF /I "%password%" EQU "B" (
	GOTO Username
)
GOTO Database

:Database
CLS
ECHO.
ECHO ==============================================================
ECHO                         ��Ʈw�ɮ׸��g�]�w
ECHO ==============================================================
SET DBPath = ""
SET /P "DBPath=�п�J��Ʈw�ɮ׸��|(��JN/n�A�q�{��.\database\npust_course_selection_system.sql; �^��W�@�B��JB/b): "
IF "%DBPath%" EQU "" (
	CALL :Print �п�J�ɮ׸��|!
	PAUSE
	GOTO Database
)ELSE IF /I "%DBPath%" EQU "N" (
	IF EXIST ".\database\npust_course_selection_system.sql" (
		CALL :Print �w�T�{�q�{���|�s�b��Ʈw!
		SET "DBPath=.\database\npust_course_selection_system.sql"
	)ELSE (
		CALL :Print �q�{���|���s�b"npust_course_selection_system.sql"��Ʈw!
		PAUSE
		GOTO Database
	)
)ELSE IF /I "%DBPath%" EQU "B" (
	GOTO Password
)
GOTO Check

:Check
CLS
ECHO.
ECHO ==============================================================
ECHO                         	 �T�{���
ECHO ==============================================================
ECHO -------------------------------
ECHO 1. �b���W��: "%User_name%"
ECHO 2. �b���K�X: "%password%"
ECHO 3. ��Ʈw�ɮ׸��|: "%DBPath%"
ECHO -------------------------------
CHOICE /C BEY /N /M "�нT�{��ƬO�_���T[Y/y���T/E/e���}�ާ@/B/b�^��W�@�B]"
IF ERRORLEVEL 3 (
	GOTO Check_db
)ELSE IF ERRORLEVEL 2 (
	GOTO EXIT
)ELSE IF ERRORLEVEL 1 (
	GOTO Database
)

:Check_db
CLS
ECHO.
ECHO ==============================================================
ECHO                          �T�{��Ʈw�s�b
ECHO ==============================================================
CALL :Print "���b�T�{�O�_�s�b��Ʈw(npust_course_selection_system)��..."
"%mysql%" -u "%User_name%" -p"%password%" -e "SHOW DATABASES LIKE 'npust_course_selection_system'"
ECHO.
ECHO -------------------------------
ECHO [1] �X�{���A��ܦs�b��Ʈw�A����R���즳��Ʈw�í��s�Ы�!
ECHO [2] ���X�{���A��ܥ��s�b��Ʈw�A����إ߸�Ʈw�ø��J��Ʈw�ɮ�!
ECHO [3] �X�{���~�A�нT�{�b���W�١B�K�X��J�O�_���T�A��^���s��J!
ECHO [4] �����ާ@�A���}!
ECHO -------------------------------
CHOICE /C 4321 /N /M "�п�ܥ\��[1~4]"
IF ERRORLEVEL 4 (
	GOTO Delete_DB
)ELSE IF ERRORLEVEL 3 (
	GOTO Create_DB
)ELSE IF ERRORLEVEL 2 (
	GOTO Check
)ELSE IF ERRORLEVEL 1 (
	GOTO EXIT
)

:Delete_DB
CLS
ECHO.
ECHO ==============================================================
ECHO                         	�R����Ʈw
ECHO ==============================================================
CALL :Print "�R���즳��Ʈw(npust_course_selection_system)��..."
"%mysql%" -u "%User_name%" -p"%password%" -e "DROP DATABASE `npust_course_selection_system`"
ECHO.
ECHO -------------------------------
ECHO [1] ���X�{���~�A��Ʈw�i��w�R�����\�A�~��إ߷s��Ʈw!
ECHO [2] �����ާ@�A���}!
ECHO -------------------------------
CHOICE /C 21 /N /M "�п�ܥ\��[1~2]"
IF ERRORLEVEL 2 (
	GOTO Create_DB
)ELSE IF ERRORLEVEL 1 (
	GOTO EXIT
)

:Create_DB
CLS
ECHO.
ECHO ==============================================================
ECHO                        	�إ߸�Ʈw
ECHO ==============================================================
CALL :Print "�إ߷s��Ʈw(npust_course_selection_system)��..."
"%mysql%" -u "%User_name%" -p"%password%" -e "CREATE DATABASE `npust_course_selection_system`"
ECHO.
ECHO -------------------------------
ECHO [1] ���X�{���~�A�~����J��Ʈw�ɮ�!
ECHO [2] �X�{���~�A���p����!
ECHO -------------------------------
CHOICE /C 21 /N /M "�п�ܥ\��[1~2]"
IF ERRORLEVEL 2 (
	GOTO Import
)ELSE IF ERRORLEVEL 1 (
	GOTO EXIT
)

:Import
CLS
ECHO.
ECHO ==============================================================
ECHO                           ���J��Ʈw�ɮ�
ECHO ==============================================================
CALL :Print ���J��Ʈw�ɮפ�...
"%mysql%" -u "%User_name%" -p"%password%" npust_course_selection_system < "%DBPath%"
ECHO.
ECHO �p�G�X�{���~�T���A���p���ڡA�P��!
GOTO EXIT

:Print
ECHO.
ECHO %~1
ECHO.
EXIT /B

:EXIT
ECHO.
PAUSE...
EXIT