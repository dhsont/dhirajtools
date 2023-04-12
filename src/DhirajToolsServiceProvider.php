<?php

namespace Dhirajsont\DhirajTools;

use Illuminate\Support\ServiceProvider;
use Dhirajsont\DhirajTools\Commands\DhirajToolsCommand;

class DhirajToolsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            DhirajToolsCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
