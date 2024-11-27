<?php
namespace Aboaisheh\LaravelRepository\Generators;

use Illuminate\Support\Facades\File;

class RepositoryGenerator
{
    public static function generate($name, $path)
    {
        $modelName = $name; // Assuming the repository name matches the model
        $variableName = lcfirst($modelName);

        $stub = <<<EOT
<?php

namespace App\Repositories;

use App\Models\\{$modelName};
use Aboaisheh\LaravelRepository\Contracts\RepositoryContract;

class {$name}Repository implements RepositoryContract
{
    protected \${$variableName};

    public function __construct({$modelName} \${$variableName})
    {
        \$this->{$variableName} = \${$variableName};
    }

    public function all()
    {
        return \$this->{$variableName}->all();
    }

    public function find(\$id)
    {
        return \$this->{$variableName}->findOrFail(\$id);
    }

    public function create(array \$data)
    {
        return \$this->{$variableName}->create(\$data);
    }

    public function update(\$id, array \$data)
    {
        \$record = \$this->{$variableName}->findOrFail(\$id);
        \$record->update(\$data);
        return \$record;
    }

    public function delete(\$id)
    {
        \$record = \$this->{$variableName}->findOrFail(\$id);
        return \$record->delete();
    }
}
EOT;

        File::ensureDirectoryExists(dirname($path));
        if (!File::exists($path)) {
            File::put($path, $stub);
        } else {
            echo "Repository '{$name}Repository' already exists.\n";
        }
    }
}
