<?php
namespace Aboaisheh\LaravelRepository\Providers;

use Illuminate\Support\ServiceProvider;
use Aboaisheh\LaravelRepository\Commands\MakeRepositoryCommand;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeRepositoryCommand::class,
            ]);
        }
    }
}
