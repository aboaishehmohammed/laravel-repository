<?php
namespace Aboaisheh\LaravelRepository\Generators;

use Illuminate\Support\Facades\File;

class ServiceGenerator
{
    public static function generate($name, $path)
    {
        // Ensure the Services directory exists
        $serviceDirectory = app_path('Services');
        File::ensureDirectoryExists($serviceDirectory);

        // Convert repository name to a dynamic variable (camel case)
        $variableName = lcfirst($name) . 'Repository';

        // Stub for the service class
        $stub = <<<EOT
<?php

namespace App\Services;

use App\Repositories\\{$name}Repository;

class {$name}Service
{
    protected \${$variableName};

    public function __construct({$name}Repository \${$variableName})
    {
        \$this->{$variableName} = \${$variableName};
    }

    public function all()
    {
        return \$this->{$variableName}->all();
    }

    public function find(\$id)
    {
        return \$this->{$variableName}->find(\$id);
    }

    public function create(array \$data)
    {
        return \$this->{$variableName}->create(\$data);
    }

    public function update(\$id, array \$data)
    {
        return \$this->{$variableName}->update(\$id, \$data);
    }

    public function delete(\$id)
    {
        return \$this->{$variableName}->delete(\$id);
    }
}
EOT;

        // Create the file
        if (!File::exists($path)) {
            File::put($path, $stub);
        } else {
            echo "Service '{$name}Service' already exists.\n";
        }
    }
}
