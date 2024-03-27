<?php

namespace Sebastienheyd\Boilerplate\Console;

use FilesystemIterator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Scaffold extends BoilerplateCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'boilerplate:scaffold {--r|remove : restore configuration and files to the original state}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold all files to Laravel application';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->title();

        return $this->option('remove') ? $this->remove() : $this->install();
    }

    private function install()
    {
        $warn = 'This command will install files in your project and configure your project to customize the use of sebastienheyd/boilerplate.';
        $alert = "<fg=red>\u{26a0} BY DOING THIS, ALL UPDATES FROM FUTURE VERSIONS OF BOILERPLATE WILL BE IGNORED \u{26a0}</>";
        $line = str_repeat('-', strlen($warn) + 6);
        $this->warn($line);
        $this->warn(str_repeat(' ', (strlen($line) - strlen($warn)) / 2).$warn);
        $this->line(str_repeat(' ', (strlen($line) - strlen($alert)) / 2).$alert);
        $this->warn($line);

        if (! $this->confirm('Continue?')) {
            return 0;
        }

        $this->publishRoutes();
        $this->publishControllers();
        $this->publishModels();
        $this->publishEvents();
        $this->publishNotifications();
        $this->publishDatatables();
        $this->call('vendor:publish', ['--tag' => ['boilerplate', 'boilerplate-views', 'boilerplate-lang']]);

        try {
            if (Schema::hasTable('role_user')) {
                $this->info('Updating user_type in database complete');
                DB::table('role_user')
                    ->where('user_type', 'Sebastienheyd\Boilerplate\Models\User')
                    ->update(['user_type' => 'App\Models\Boilerplate\User']);
            }
        } catch (\Exception $e) {
            $this->error('Database is not available');
        }
    }

    private function remove()
    {
        $this->warn('---------------------------------------------------------------------------------------');
        $this->warn(' This command will remove all files published by boilerplate:scaffold in your project. ');
        $this->warn('---------------------------------------------------------------------------------------');

        if (! $this->confirm('Continue?')) {
            return 0;
        }

        $backupDashboard = [];
        if (! $this->confirm('Remove custom dashboard?')) {
            $backupDashboard = [
                app_path('Http/Controllers/Boilerplate/DashboardController.php') => storage_path('scaffold/DashboardController.php'),
                resource_path('views/vendor/boilerplate/dashboard.blade.php')    => storage_path('scaffold/dashboard.blade.php'),
            ];

            $this->fileSystem->makeDirectory(storage_path('scaffold'));

            foreach ($backupDashboard as $from => $to) {
                $this->copy($from, $to, false);
            }
        } else {
            $this->replaceInFile([
                '\App\Http\Controllers\Boilerplate' => '\Sebastienheyd\Boilerplate\Controllers',
            ], config_path('boilerplate/menu.php'));
        }

        $this->delete([
            base_path('routes/boilerplate.php'),
            app_path('Http/Controllers/Boilerplate'),
            app_path('Models/Boilerplate'),
            app_path('Events/Boilerplate'),
            app_path('Notifications/Boilerplate'),
            app()->langPath().'/vendor/boilerplate',
            resource_path('views/vendor/boilerplate'),
        ]);

        $this->replaceInFile([
            'App\Models\Boilerplate' => 'Sebastienheyd\Boilerplate\Models',
        ], config_path('boilerplate/laratrust.php'));

        $this->replaceInFile([
            'App\Models\Boilerplate' => 'Sebastienheyd\Boilerplate\Models',
        ], config_path('boilerplate/auth.php'));

        if (! empty($backupDashboard)) {
            $this->fileSystem->makeDirectory(app_path('Http/Controllers/Boilerplate'));
            $this->fileSystem->makeDirectory(resource_path('views/vendor/boilerplate'));
            foreach (array_flip($backupDashboard) as $from => $to) {
                $this->copy($from, $to);
            }
            $this->fileSystem->deleteDirectory(storage_path('scaffold'));
        }

        try {
            if (Schema::hasTable('role_user')) {
                $this->info('Updating user_type in database complete');
                DB::table('role_user')
                    ->where('user_type', 'App\Models\Boilerplate\User')
                    ->update(['user_type' => 'Sebastienheyd\Boilerplate\Models\User']);
            }
        } catch (\Exception $e) {
            $this->error('Database is not available');
        }
    }

    private function publishRoutes()
    {
        $to = base_path('routes/boilerplate.php');
        $this->copy(__DIR__.'/../routes/boilerplate.php', $to);
        $this->replaceInFile(['Sebastienheyd\Boilerplate\Controllers' => 'App\Http\Controllers\Boilerplate'], $to);
    }

    private function publishControllers()
    {
        $to = app_path('Http/Controllers/Boilerplate');
        $this->copy(__DIR__.'/../Controllers', $to);

        $files = $this->fileSystem->allFiles($to);

        foreach ($files as $file) {
            $this->replaceInFile([
                'Sebastienheyd\Boilerplate\Controllers' => 'App\Http\Controllers\Boilerplate',
                'Sebastienheyd\Boilerplate\Models'      => 'App\Models\Boilerplate',
            ], $file->getRealPath());
        }

        $configFile = config_path('boilerplate/menu.php');

        if (! $this->fileSystem->exists($configFile)) {
            $this->callSilent('vendor:publish', ['--tag' => 'boilerplate-config']);
        }

        $this->replaceInFile([
            'Sebastienheyd\Boilerplate\Controllers' => 'App\Http\Controllers\Boilerplate',
        ], $configFile);
    }

    private function publishModels()
    {
        $to = app_path('Models/Boilerplate');
        $this->copy(__DIR__.'/../Models', $to);

        $files = $this->fileSystem->allFiles($to);

        foreach ($files as $file) {
            $this->replaceInFile([
                'Sebastienheyd\Boilerplate\Models'        => 'App\Models\Boilerplate',
                'Sebastienheyd\Boilerplate\Events'        => 'App\Events\Boilerplate',
                'Sebastienheyd\Boilerplate\Notifications' => 'App\Notifications\Boilerplate',
            ], $file->getRealPath());
        }

        $this->replaceInFile([
            'Sebastienheyd\Boilerplate\Models' => 'App\Models\Boilerplate',
        ], config_path('boilerplate/laratrust.php'));

        $this->replaceInFile([
            'Sebastienheyd\Boilerplate\Models' => 'App\Models\Boilerplate',
        ], config_path('boilerplate/auth.php'));
    }

    private function publishEvents()
    {
        $to = app_path('Events/Boilerplate');
        $this->copy(__DIR__.'/../Events', $to);

        $files = $this->fileSystem->allFiles($to);

        foreach ($files as $file) {
            $this->replaceInFile([
                'Sebastienheyd\Boilerplate\Events' => 'App\Events\Boilerplate',
                'Sebastienheyd\Boilerplate\Models' => 'App\Models\Boilerplate',
            ], $file->getRealPath());
        }
    }

    private function publishNotifications()
    {
        $to = app_path('Notifications/Boilerplate');
        $this->copy(__DIR__.'/../Notifications', $to);

        $files = $this->fileSystem->allFiles($to);

        foreach ($files as $file) {
            $this->replaceInFile([
                'Sebastienheyd\Boilerplate\Notifications' => 'App\Notifications\Boilerplate',
            ], $file->getRealPath());
        }
    }

    private function publishDatatables()
    {
        $to = app_path('Datatables');
        $this->copy(__DIR__.'/../Datatables/Admin', $to);

        $files = $this->fileSystem->allFiles($to);

        foreach ($files as $file) {
            $this->replaceInFile([
                'Sebastienheyd\Boilerplate\Datatables\Admin' => 'App\Datatables',
            ], app_path('Datatables/'.$file->getFilename()));
        }
    }

    /**
     * Replace content in the given file.
     *
     * @param  array  $values
     * @param  string  $file
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    private function replaceInFile($values, $file)
    {
        $content = $this->fileSystem->get($file);
        foreach ($values as $from => $to) {
            $content = str_replace($from, $to, $content);
        }
        $this->fileSystem->put($file, $content);
    }

    /**
     * Delete files or directories.
     *
     * @param  array  $fileOrDirectory  Array of files or directories to delete
     */
    private function delete(array $fileOrDirectory)
    {
        foreach ($fileOrDirectory as $path) {
            if ($this->fileSystem->isFile($path)) {
                $type = 'File';
                $this->fileSystem->delete($path);
            } else {
                $type = 'Directory';
                $this->fileSystem->deleteDirectory($path);
            }

            $this->line('<info>Deleted '.$type.'</info> <comment>['.$path.']</comment>');
        }
    }

    /**
     * Copy a file or a directory and display a message.
     *
     * @param  string  $from
     * @param  string  $to
     */
    private function copy($from, $to, $log = true)
    {
        if (is_dir($from)) {
            $type = 'Directory';
            $this->copyDirectory($from, $to);
        } else {
            $type = 'File';
            if (! $this->fileSystem->exists($to)) {
                // For Laravel 6
                if (! $this->fileSystem->isDirectory($this->fileSystem->dirname($to))) {
                    $this->fileSystem->makeDirectory($this->fileSystem->dirname($to), 0755, true);
                }

                $this->fileSystem->copy($from, $to);
            }
        }

        if ($log) {
            $from = str_replace(base_path(), '', realpath($from));
            $to = str_replace(base_path(), '', realpath($to));
            $this->line('<info>Copied '.$type.'</info> <comment>['.$from.']</comment> <info>To</info> <comment>['.$to.']</comment>');
        }
    }

    /**
     * Secure copy that will not override existing files.
     *
     * @param  string  $directory
     * @param  string  $destination
     * @return bool
     */
    private function copyDirectory($directory, $destination)
    {
        $this->fileSystem->ensureDirectoryExists($destination, 0777);

        $items = new FilesystemIterator($directory, FilesystemIterator::SKIP_DOTS);

        foreach ($items as $item) {
            $target = $destination.'/'.$item->getBasename();

            if ($item->isDir()) {
                $path = $item->getPathname();

                if (! $this->copyDirectory($path, $target)) {
                    return false;
                }
            } else {
                if (! $this->fileSystem->exists($target)) {
                    $this->fileSystem->copy($item->getPathname(), $target);
                }
            }
        }

        return true;
    }
}
