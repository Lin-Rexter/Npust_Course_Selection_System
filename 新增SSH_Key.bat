set "params=%*" && cd /d "%CD%" && ( if exist "%temp%\getadmin.vbs" del "%temp%\getadmin.vbs" ) && fsutil dirty query %systemdrive% 1>nul 2>nul || (  echo Set UAC = CreateObject^("Shell.Application"^) : UAC.ShellExecute "cmd.exe", "/C cd ""%CD%"" && %~s0 %params%", "", "runas", 1 >>"%temp%\getadmin.vbs" && "%temp%\getadmin.vbs" && exit /B )
@echo off
cls

title �s�WSSH-Key

CD /D "%USERPROFILE%/.ssh"

SET Git_Bash="C:\Program Files\Git\bin\bash.exe" --login -i -c

GOTO SSH-Key-Show-KeyFile

::REM ================================SSH-Key(�]�m���_)================================

:SSH-Key-Show-KeyFile
CLS
ECHO.
ECHO ==============================================================
ECHO                       �{��SSH���_�ɮ�
ECHO ==============================================================
ECHO.
%Git_Bash% "ls -al ~/.ssh"
GOTO SET-Email

:SET-Email
ECHO.
ECHO ==============================================================
ECHO                      SSH���_�ͦ���Ƴ]�w
ECHO ==============================================================
ECHO.
SET /P email="[1/2] �п�JGithub�Ϊ�GitLab��Email: "
IF %ERRORLEVEL% NEQ 0 (CLS && ECHO �п�J���Temail && GOTO SSH-Key-Show-KeyFile)
GOTO SET-File

:SET-File
ECHO.
ECHO ==============================================================
ECHO                      SSH���_�ͦ���Ƴ]�w
ECHO ==============================================================
ECHO.
SET /P Key-FileName="[2/2] �п�J�n�ͦ����K�_���W��(Ex: id_ed25519_work): "
IF %ERRORLEVEL% NEQ 0 (CLS && ECHO �п�J���T�W�� && GOTO SET-File)ELSE (GOTO Choice_SSH-key)

:Choice_SSH-key
ECHO.
ECHO ==============================================================
ECHO                         SSH�K�_����
ECHO ==============================================================
ECHO.
ECHO --------------------------------------------------------------
ECHO [1] ED25519(�u��)
ECHO [2] RSA(�䦸)
ECHO --------------------------------------------------------------
ECHO.
CHOICE /C 21 /N /M "��ܥ[�K����[1,2]: "
IF ERRORLEVEL 2 (
 GOTO ED25519
)ELSE IF ERRORLEVEL 1 (
 GOTO RSA
)

:ED25519
ECHO.
ECHO ==============================================================
ECHO.
ECHO ��ܥ[�K����: ED25519
ECHO.
%Git_Bash% "ssh-keygen -t ed25519 -N '' -f id_ed25519_"%Key-FileName%" -C "%email%""
IF %ERRORLEVEL% NEQ 0 (GOTO FAIL-ED25519)ELSE (PAUSE && GOTO SSH-Agent-Show-SSHFile)

:RSA
ECHO.
ECHO ==============================================================
ECHO.
ECHO ��ܥ[�K����: RSA
ECHO.
%Git_Bash% "ssh-keygen -t rsa -b 4096 -C "%email%""
IF %ERRORLEVEL% NEQ 0 (GOTO FAIL-RSA)ELSE (PAUSE && GOTO SSH-Agent-Show-SSHFile)

:FAIL-ED25519
ECHO.
ECHO ==============================================================
ECHO.
ECHO ED25519�[�K����!
CHOICE /C NY /N /M "�O�_���RSA�[�K[Y,N]: "
IF ERRORLEVEL 2 (
 GOTO RSA
)ELSE IF ERRORLEVEL 1 (
 GOTO EXIT
)

:FAIL-RSA
ECHO.
ECHO ==============================================================
ECHO.
ECHO RSA�[�K����!
CHOICE /C NY /N /M "�O�_���ED25519�[�K[Y,N]: "
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
ECHO                        �{��SSH���_�ɮ�
ECHO ==============================================================
ECHO.
%Git_Bash% "ls -al ~/.ssh"
GOTO SET-Email

:SET-Email
ECHO.
ECHO ==============================================================
ECHO                      	   ��Ƴ]�w
ECHO ==============================================================
ECHO.
SET /P SSH-FileName="�п�J���_�ɦW(�p�_): "
IF %ERRORLEVEL% NEQ 0 (CLS && ECHO �нT�{�O�_��J���T���p�_�ɦW && GOTO SSH-Agent-Show-SSHFile && GOTO SSH-Agent)

:SSH-Agent
CLS
ECHO.
ECHO ====================�Ұ�SSH�N�z�òK�[SSH�p�_=====================
ECHO.
%Git_Bash% "eval `ssh-agent -s`" || "ssh-add ~/.ssh/%SSH-FileName%"
IF %ERRORLEVEL% NEQ 0 (GOTO FAIL-SSH-Agent)
GOTO Success-SSH-Agent

:Success-SSH-Agent
ECHO.
ECHO ==============================================================
ECHO.
ECHO ���榨�\!
PAUSE
GOTO SSH-Test

:FAIL-SSH-Agent
ECHO.
ECHO ==============================================================
ECHO.
ECHO �Ұ�SSH�N�z���ѩάOSSH�K�_�K�[����!
GOTO EXIT

::REM ====================================����SSH�s��====================================

:SSH-Test
CLS
ECHO.
ECHO ==========================����SSH�s��===========================
ECHO.
SET /P Host-Name="�п�J�n�s�u���D���W��(ex: github.com): "
ECHO.
%Git_Bash% "ssh -T git@"%Host-Name%""
IF %ERRORLEVEL% NEQ 0 (GOTO FAIL-SSH-Test)ELSE (GOTO EXIT)

:FAIL-SSH-Test
ECHO.
ECHO ==============================================================
ECHO.
ECHO ����SSH�s�����ѡA�нT�{�D���W�٬O�_���~�άO���N���_�s�W��Github�άOGitLab�b���W!
PAUSE
GOTO SSH-Test

:EXIT
echo.
pause
exit