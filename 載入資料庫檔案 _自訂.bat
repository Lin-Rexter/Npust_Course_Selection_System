set "params=%*" && cd /d "%CD%" && ( if exist "%temp%\getadmin.vbs" del "%temp%\getadmin.vbs" ) && fsutil dirty query %systemdrive% 1>nul 2>nul || (  ECHO Set UAC = CreateObject^("Shell.Application"^) : UAC.ShellExecute "cmd.exe", "/C cd ""%CD%"" && %~s0 %params%", "", "runas", 1 >>"%temp%\getadmin.vbs" && "%temp%\getadmin.vbs" && exit /B )
@ECHO OFF
CLS

TITLE 載入資料庫

::COLOR F0

:: 指令位置
SET "mysql=C:\xampp\mysql\bin\mysql.exe"

:: 如不想要每次輸入帳密跟資料庫檔案路徑，請先設定(設定前，請把前面的雙冒號跟註解文字刪除)
:: 帳號名稱 SET User_name = ""
SET "User_name=B11056051"
:: 帳號密碼 SET password = ""
SET "password=password"
:: 要載入的資料庫檔案路徑(已設定默認路徑) SET DBPath = ".\database\npust_course_selection_system.sql"
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
ECHO                            帳號名稱設定
ECHO ==============================================================
SET User_name = ""
SET /P "User_name=請輸入資料庫帳號名稱(如未建立帳號請輸入N/n，默認root): "
IF "%User_name%" EQU "" (
	CALL :Print 請輸入帳號名稱!
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
ECHO                            帳號密碼設定
ECHO ==============================================================
SET password = ""
SET /P "password=請輸入資料庫帳號密碼(如果未設定密碼輸入N/n; 回到上一步輸入B/b): "
IF "%password%" EQU "" (
	CALL :Print 請輸入帳號密碼!
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
ECHO                         資料庫檔案路經設定
ECHO ==============================================================
SET DBPath = ""
SET /P "DBPath=請輸入資料庫檔案路徑(輸入N/n，默認為.\database\npust_course_selection_system.sql; 回到上一步輸入B/b): "
IF "%DBPath%" EQU "" (
	CALL :Print 請輸入檔案路徑!
	PAUSE
	GOTO Database
)ELSE IF /I "%DBPath%" EQU "N" (
	IF EXIST ".\database\npust_course_selection_system.sql" (
		CALL :Print 已確認默認路徑存在資料庫!
		SET "DBPath=.\database\npust_course_selection_system.sql"
	)ELSE (
		CALL :Print 默認路徑不存在"npust_course_selection_system.sql"資料庫!
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
ECHO                         	 確認資料
ECHO ==============================================================
ECHO -------------------------------
ECHO 1. 帳號名稱: "%User_name%"
ECHO 2. 帳號密碼: "%password%"
ECHO 3. 資料庫檔案路徑: "%DBPath%"
ECHO -------------------------------
CHOICE /C BEY /N /M "請確認資料是否正確[Y/y正確/E/e離開操作/B/b回到上一步]"
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
ECHO                          確認資料庫存在
ECHO ==============================================================
CALL :Print "正在確認是否存在資料庫(npust_course_selection_system)中..."
"%mysql%" -u "%User_name%" -p"%password%" -e "SHOW DATABASES LIKE 'npust_course_selection_system'"
ECHO.
ECHO -------------------------------
ECHO [1] 出現表格，表示存在資料庫，執行刪除原有資料庫並重新創建!
ECHO [2] 未出現表格，表示未存在資料庫，執行建立資料庫並載入資料庫檔案!
ECHO [3] 出現錯誤，請確認帳號名稱、密碼輸入是否正確，返回重新輸入!
ECHO [4] 取消操作，離開!
ECHO -------------------------------
CHOICE /C 4321 /N /M "請選擇功能[1~4]"
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
ECHO                         	刪除資料庫
ECHO ==============================================================
CALL :Print "刪除原有資料庫(npust_course_selection_system)中..."
"%mysql%" -u "%User_name%" -p"%password%" -e "DROP DATABASE `npust_course_selection_system`"
ECHO.
ECHO -------------------------------
ECHO [1] 未出現錯誤，資料庫可能已刪除成功，繼續建立新資料庫!
ECHO [2] 取消操作，離開!
ECHO -------------------------------
CHOICE /C 21 /N /M "請選擇功能[1~2]"
IF ERRORLEVEL 2 (
	GOTO Create_DB
)ELSE IF ERRORLEVEL 1 (
	GOTO EXIT
)

:Create_DB
CLS
ECHO.
ECHO ==============================================================
ECHO                        	建立資料庫
ECHO ==============================================================
CALL :Print "建立新資料庫(npust_course_selection_system)中..."
"%mysql%" -u "%User_name%" -p"%password%" -e "CREATE DATABASE `npust_course_selection_system`"
ECHO.
ECHO -------------------------------
ECHO [1] 未出現錯誤，繼續載入資料庫檔案!
ECHO [2] 出現錯誤，請聯絡我!
ECHO -------------------------------
CHOICE /C 21 /N /M "請選擇功能[1~2]"
IF ERRORLEVEL 2 (
	GOTO Import
)ELSE IF ERRORLEVEL 1 (
	GOTO EXIT
)

:Import
CLS
ECHO.
ECHO ==============================================================
ECHO                           載入資料庫檔案
ECHO ==============================================================
CALL :Print 載入資料庫檔案中...
"%mysql%" -u "%User_name%" -p"%password%" npust_course_selection_system < "%DBPath%"
ECHO.
ECHO 如果出現錯誤訊息，請聯絡我，感謝!
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