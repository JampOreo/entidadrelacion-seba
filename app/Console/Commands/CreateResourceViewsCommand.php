<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateResourceViewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:resource-views {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates resource view folders and empty blade files (index, create, show, edit) for a given resource name.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $resourceName = strtolower($this->argument('name')); // Nombre del recurso en minúsculas

        $viewTypes = ['index', 'create', 'show', 'edit'];
        $basePath = resource_path("views/{$resourceName}");

        // Crear el directorio principal del recurso
        if (!File::isDirectory($basePath)) {
            File::makeDirectory($basePath, 0755, true);
            $this->info("Directorio {$basePath}/ creado.");
        } else {
            $this->warn("Directorio {$basePath}/ ya existe.");
        }

        // Crear los archivos blade dentro del directorio
        foreach ($viewTypes as $type) {
            $filePath = "{$basePath}/{$type}.blade.php";
            if (!File::exists($filePath)) {
                File::put($filePath, ''); // Crear archivo vacío
                $this->info("  - Archivo {$filePath} creado.");
            } else {
                $this->warn("  - Archivo {$filePath} ya existe. Saltando.");
            }
        }

        $this->info("¡Archivos de vista para el recurso '{$resourceName}' creados exitosamente!");
    }
}