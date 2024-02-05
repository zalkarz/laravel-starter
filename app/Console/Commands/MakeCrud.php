<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Pluralizer;

class MakeCrud extends Command
{
    protected array $path = [];

    protected string $model;
    protected string $modelPlural;

    protected array $createdFiles = [];
    protected array $existingFiles = [];

    protected array $extraResponseMessages = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class with fully ready CRUD for it';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->prepareModelNameAndPath();

        $this->createMigration();
        $this->createModel();
        $this->createController();
        $this->createRequests();
        $this->createActions();
        $this->createViews();
        $this->createFactory();
        $this->createSeeder();

        $this->flashResponse();
        $this->flashExtraResponseMessages();
    }

    protected function prepareModelNameAndPath()
    {
        $path = explode('/', trim($this->argument('model'), '/'));

        foreach ($path as $key => $pathElement) {
            if (empty($pathElement)) {
                continue;
            }

            if ($key === array_key_last($path)) {
                $this->model = $this->getSingularClassName($pathElement);
                $this->modelPlural = $this->getPluralClassName($pathElement);
            } else {
                $this->path[] = $pathElement;
            }
        }
    }

    protected function createMigration()
    {
        $path = base_path() . "/database/migrations";
        $pathWithFilename = $path . "/" . now()->format('Y_m_d_His') . "_create_" . strtolower($this->modelPlural) . "_table.php";

        $content = file_get_contents(base_path() . '/stubs/crud/migration.stub');
        $content = str_replace("{{ modelPlural }}", strtolower($this->modelPlural), $content);

        if (!$this->migrationExists($path)) {
            $this->createFile($pathWithFilename, $content);
            $this->extraResponseMessages[] = "Run this migration command: php artisan migrate";
        }
    }

    protected function createModel()
    {
        $path = base_path() . "/app/Models/" . implode("/", $this->path);
        $pathWithFilename = $path . "/" . $this->model . ".php";

        $content = file_get_contents(base_path() . '/stubs/crud/model.stub');
        $content = str_replace("{{ Namespace }}", $this->getNamespace("App\\Models"), $content);
        $content = str_replace("{{ Model }}", $this->model, $content);

        $this->makeDirectory($path);

        $this->createFile($pathWithFilename, $content);
    }

    protected function createController()
    {
        $path = base_path() . "/app/Http/Controllers/" . implode("/", $this->path);
        $pathWithFilename = $path . "/" . $this->model . "Controller.php";

        $content = file_get_contents(base_path() . '/stubs/crud/controller.stub');
        $content = str_replace("{{ Namespace }}", $this->getNamespace("App\\Http\\Controllers"), $content);
        $content = str_replace("{{ ParentControllerNamespace }}", ((!empty($this->path) ? "\nuse App\\Http\\Controllers\\Controller;" : "")), $content);
        $content = str_replace("{{ Model }}", $this->model, $content);
        $content = str_replace("{{ model }}", strtolower($this->model), $content);
        $content = str_replace("{{ ModelPlural }}", $this->modelPlural, $content);
        $content = str_replace("{{ modelPlural }}", strtolower($this->modelPlural), $content);
        $content = str_replace("{{ Path }}", implode("\\", $this->path) . (!empty($this->path) ? "\\" : ""), $content);
        $content = str_replace("{{ viewPath }}", implode(".", $this->path) . (!empty($this->path) ? "." : ""), $content);

        $this->makeDirectory($path);

        $this->createFile($pathWithFilename, $content);
    }

    protected function createRequests()
    {
        $path = base_path() . "/app/Http/Requests/" . implode("/", $this->path) . "/" . $this->modelPlural;
        $storeRequestPath = $path . "/StoreRequest.php";
        $updateRequestPath = $path . "/UpdateRequest.php";

        $storeRequestContent = file_get_contents(base_path() . '/stubs/crud/request.store.stub');
        $storeRequestContent = str_replace("{{ Namespace }}", $this->getNamespace("App\\Http\\Requests", true), $storeRequestContent);

        $updateRequestContent = file_get_contents(base_path() . '/stubs/crud/request.update.stub');
        $updateRequestContent = str_replace("{{ Namespace }}", $this->getNamespace("App\\Http\\Requests", true), $updateRequestContent);

        $this->makeDirectory($path);

        $this->createFile($storeRequestPath, $storeRequestContent);
        $this->createFile($updateRequestPath, $updateRequestContent);
    }

    protected function createActions()
    {
        $path = base_path() . "/app/UseCases/" . implode("/", $this->path) . "/" . $this->modelPlural;
        $indexActionPath = $path . "/IndexAction.php";
        $storeActionPath = $path . "/StoreAction.php";
        $updateActionPath = $path . "/UpdateAction.php";
        $destroyActionPath = $path . "/DestroyAction.php";

        $indexActionContent = file_get_contents(base_path() . '/stubs/crud/action.index.stub');
        $indexActionContent = str_replace("{{ Namespace }}", $this->getNamespace("App\\UseCases", true), $indexActionContent);
        $indexActionContent = str_replace("{{ Model }}", $this->model, $indexActionContent);
        $indexActionContent = str_replace("{{ modelPlural }}", strtolower($this->modelPlural), $indexActionContent);
        $indexActionContent = str_replace("{{ Path }}", implode("\\", $this->path) . (!empty($this->path) ? "\\" : ""), $indexActionContent);

        $storeActionContent = file_get_contents(base_path() . '/stubs/crud/action.store.stub');
        $storeActionContent = str_replace("{{ Namespace }}", $this->getNamespace("App\\UseCases", true), $storeActionContent);
        $storeActionContent = str_replace("{{ Model }}", $this->model, $storeActionContent);
        $storeActionContent = str_replace("{{ Path }}", implode("\\", $this->path) . (!empty($this->path) ? "\\" : ""), $storeActionContent);

        $updateActionContent = file_get_contents(base_path() . '/stubs/crud/action.update.stub');
        $updateActionContent = str_replace("{{ Namespace }}", $this->getNamespace("App\\UseCases", true), $updateActionContent);
        $updateActionContent = str_replace("{{ Model }}", $this->model, $updateActionContent);
        $updateActionContent = str_replace("{{ Path }}", implode("\\", $this->path) . (!empty($this->path) ? "\\" : ""), $updateActionContent);
        $updateActionContent = str_replace("{{ model }}", strtolower($this->model), $updateActionContent);

        $destroyActionContent = file_get_contents(base_path() . '/stubs/crud/action.destroy.stub');
        $destroyActionContent = str_replace("{{ Namespace }}", $this->getNamespace("App\\UseCases", true), $destroyActionContent);
        $destroyActionContent = str_replace("{{ Model }}", $this->model, $destroyActionContent);
        $destroyActionContent = str_replace("{{ Path }}", implode("\\", $this->path) . (!empty($this->path) ? "\\" : ""), $destroyActionContent);
        $destroyActionContent = str_replace("{{ model }}", strtolower($this->model), $destroyActionContent);

        $this->makeDirectory($path);

        $this->createFile($indexActionPath, $indexActionContent);
        $this->createFile($storeActionPath, $storeActionContent);
        $this->createFile($updateActionPath, $updateActionContent);
        $this->createFile($destroyActionPath, $destroyActionContent);
    }

    protected function createViews()
    {
        $path = base_path() . "/resources/views/" . strtolower(implode("/", $this->path)) . "/" . strtolower($this->modelPlural);
        $indexViewPath = $path . "/index.blade.php";
        $showViewPath = $path . "/show.blade.php";
        $createViewPath = $path . "/create.blade.php";
        $editViewPath = $path . "/edit.blade.php";

        $indexViewContent = file_get_contents(base_path() . '/stubs/crud/view.index.stub');
        $indexViewContent = str_replace("{{ model }}", strtolower($this->model), $indexViewContent);
        $indexViewContent = str_replace("{{ modelPlural }}", strtolower($this->modelPlural), $indexViewContent);
        $indexViewContent = str_replace("{{ ModelPlural }}", $this->modelPlural, $indexViewContent);

        $showViewContent = file_get_contents(base_path() . '/stubs/crud/view.show.stub');
        $showViewContent = str_replace("{{ model }}", strtolower($this->model), $showViewContent);
        $showViewContent = str_replace("{{ modelPlural }}", strtolower($this->modelPlural), $showViewContent);
        $showViewContent = str_replace("{{ ModelPlural }}", $this->modelPlural, $showViewContent);

        $createViewContent = file_get_contents(base_path() . '/stubs/crud/view.create.stub');
        $createViewContent = str_replace("{{ modelPlural }}", strtolower($this->modelPlural), $createViewContent);
        $createViewContent = str_replace("{{ ModelPlural }}", $this->modelPlural, $createViewContent);

        $editViewContent = file_get_contents(base_path() . '/stubs/crud/view.edit.stub');
        $editViewContent = str_replace("{{ model }}", strtolower($this->model), $editViewContent);
        $editViewContent = str_replace("{{ modelPlural }}", strtolower($this->modelPlural), $editViewContent);
        $editViewContent = str_replace("{{ ModelPlural }}", $this->modelPlural, $editViewContent);

        $this->makeDirectory($path);

        $this->createFile($indexViewPath, $indexViewContent);
        $this->createFile($showViewPath, $showViewContent);
        $this->createFile($createViewPath, $createViewContent);
        $this->createFile($editViewPath, $editViewContent);
    }

    protected function createFactory()
    {
        $path = base_path() . "/database/factories/" . implode("/", $this->path);
        $pathWithFilename = $path . "/" . $this->model . "Factory.php";

        $content = file_get_contents(base_path() . '/stubs/crud/factory.stub');
        $content = str_replace("{{ Namespace }}", $this->getNamespace("Database\\Factories"), $content);
        $content = str_replace("{{ Model }}", $this->model, $content);
        $content = str_replace("{{ Path }}", implode("\\", $this->path) . (!empty($this->path) ? "\\" : ""), $content);

        $this->makeDirectory($path);

        $this->createFile($pathWithFilename, $content);
    }

    protected function createSeeder()
    {
        $path = base_path() . "/database/seeders/" . implode("/", $this->path);
        $pathWithFilename = $path . "/" . $this->model . "Seeder.php";

        $content = file_get_contents(base_path() . '/stubs/crud/seeder.stub');
        $content = str_replace("{{ Namespace }}", $this->getNamespace("Database\\Seeders"), $content);
        $content = str_replace("{{ Model }}", $this->model, $content);
        $content = str_replace("{{ Path }}", implode("\\", $this->path) . (!empty($this->path) ? "\\" : ""), $content);

        $this->makeDirectory($path);

        $this->createFile($pathWithFilename, $content);
    }

    protected function makeDirectory($path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0700, true);
        }

        return $path;
    }

    protected function createFile($path, $content)
    {
        $pathArray = explode('/', $path);
        $filename = end($pathArray);

        if (!file_exists($path)) {
            file_put_contents($path, $content);
            $this->createdFiles[] = $filename;
        } else {
            $this->existingFiles[] = $filename;
        }
    }

    protected function flashResponse()
    {
        if (empty($this->createdFiles)) {
            $this->line('All CRUD files already exist');
            return;
        }

        $this->line('CRUD for model "' . $this->model . '" have been successfully created');
        $this->line($this->getCreatedFilesInfo());
        $this->line($this->getHereIsYourRouteLine());
    }

    protected function flashExtraResponseMessages()
    {
        foreach ($this->extraResponseMessages as $message) {
            $this->line($message);
        }
    }

    protected function getCreatedFilesInfo(): string
    {
        $prefix = (empty($this->existingFiles)) ? 'All ' : '';

        $createdFilesInfo = count($this->createdFiles) . ' files have been created';

        $notCreatedFilesInfo = (!empty($this->existingFiles))
            ? count($this->existingFiles) . ' files already exist'
            : '';

        return $prefix . $createdFilesInfo . (!empty($notCreatedFilesInfo) ? ', ' . $notCreatedFilesInfo : '');
    }

    protected function getHereIsYourRouteLine()
    {
        $controllerPath = $this->getNamespace("\\App\\Http\\Controllers") . "\\". $this->model . "Controller::class";

        return "Add this route to your routes file web.php: Route::resource('" . strtolower($this->modelPlural) . "', " . $controllerPath . ");";
    }

    protected function getSingularClassName(string $name): string
    {
        return ucwords(Pluralizer::singular($name));
    }

    protected function getPluralClassName(string $name): string
    {
        return ucwords(Pluralizer::plural($name));
    }

    protected function getNamespace(string $prefix, $includeModelName = false)
    {
        return $prefix . ((!empty($this->path) ? "\\" : "")) . implode("\\", $this->path) . (($includeModelName == true) ? "\\" . $this->modelPlural : "");
    }

    protected function migrationExists($path)
    {
        $filenames = scandir($path);

        foreach($filenames as $filename) {
            if (str_contains($filename, 'create_'. strtolower($this->modelPlural) .'_table')) {
                return true;
            }
        }

        return false;
    }
}
