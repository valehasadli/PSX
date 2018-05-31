@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../psx/schema/bin/schema
php "%BIN_TARGET%" %*
