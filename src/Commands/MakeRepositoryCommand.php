<?php
namespace Aboaisheh\LaravelRepository\Commands;

use Illuminate\Console\Command;
use Aboaisheh\LaravelRepository\Generators\RepositoryGenerator;
use Aboaisheh\LaravelRepository\Generators\ServiceGenerator;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name} {--service}';
    protected $description = 'Create a new repository and its corresponding service';

    public function handle()
    {
        $name = $this->argument('name');
        $repositoryPath = app_path("Repositories/{$name}Repository.php");
        $servicePath = app_path("Services/{$name}Service.php");

        RepositoryGenerator::generate($name, $repositoryPath);
        $this->info("Repository '{$name}Repository' created successfully!");

        if ($this->option('service')) {
            ServiceGenerator::generate($name, $servicePath);
            $this->info("Service '{$name}Service' created successfully!");
        }
    }
}
