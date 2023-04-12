<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DhirajToolsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dhirajtools:generate-routes';
    protected $description = 'Generate a routes_list.php file with clickable controller names, and searchable route names';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $routes = \Route::getRoutes();

      //  dd($routes);
        $output = "<?php\n\n";

        $output .= "     /**[\n";
        $output .= "     * Created By :- DhirajToolsCommand \n";
        $output .= "     * Author :- Dhirajkumar Sontakke \n";
        $output .= "     */\n\n";
//        // Extract and append the "use" statements from the "web.php" file
//        $webFileContent = file_get_contents(base_path('routes/web.php'));
//        preg_match_all('/^use (.*?);$/m', $webFileContent, $useStatements);
//        $output .= implode("\n", $useStatements[0]) . "\n\n";

        $output .= "\$routes = [\n";

        foreach ($routes as $route) {
            $action = $route->getAction();
            $controller = $action['controller'] ?? null;

            if ($controller) {
                $controllerArray = explode('@', $controller);
                if (isset($controllerArray[1])) {
                    $controller = $controllerArray[0] . '::class, \'' . $controllerArray[1] . '\'';
                } else {
                    $controller = $controllerArray[0] . '::class';
                }
            }

            $package = $action['namespace'] ?? '';

            $output .= "    [";

            $output .= " 'uri' => '" . $route->uri() . "',";
            $output .= "     'name' => '" . ($route->getName() ?: '') . "',";
            $output .= "     'package' => '" . $package . "',\n"; // Add the package name
            $output .= "      'controller' => [" . ($controller ?: '') . "],";
            $output .= "      'method' => '" . implode('|', $route->methods()) . "',";
            $output .= "    ],\n";
        }

        $output .= "];\n";

        file_put_contents('routes/routes_list.php', $output);

        $this->info('Routes list generated to routes_list.php');
    }

}
