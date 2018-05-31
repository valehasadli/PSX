@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../psx/api/bin/api
php "%BIN_TARGET%" %*
