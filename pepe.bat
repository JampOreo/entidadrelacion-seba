@echo off
setlocal

set "ENTITIES=materias docentes cursos aulas reservas horarios actividades-academicas informaticos mantenimientos"
set "VIEW_TYPES=index create show edit"

echo Creando directorios y archivos de vista...

for %%e in (%ENTITIES%) do (
    mkdir "resources\views\%%e" 2>nul
    echo Directorio resources\views\%%e\ creado.

    for %%v in (%VIEW_TYPES%) do (
        type nul > "resources\views\%%e\%%v.blade.php"
        echo   - Archivo resources\views\%%e\%%v.blade.php creado.
    )
)

echo ¡Todas las carpetas y archivos de vista base han sido creados!

endlocals