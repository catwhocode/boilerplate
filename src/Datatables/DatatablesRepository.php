<?php

namespace Sebastienheyd\Boilerplate\Datatables;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

class DatatablesRepository
{
    protected $datatables = [];

    /**
     * Register a datatable class.
     *
     * @param ...$class
     * @return $this
     */
    public function registerDatatable(...$class)
    {
        foreach ($class as $c) {
            if (is_subclass_of($c, Datatable::class) && ! (new ReflectionClass($c))->isAbstract()) {
                $dt = (new $c());
                $slug = $dt->slug;

                if (empty($slug)) {
                    continue;
                }

                $this->datatables[$slug] = $dt;
            }
        }

        return $this;
    }

    /**
     * Get datatables classes.
     *
     * @return array
     */
    public function getDatatables()
    {
        return array_unique($this->datatables);
    }

    /**
     * @throws \ReflectionException
     */
    public function load($paths)
    {
        $paths = array_unique(Arr::wrap($paths));

        $paths = array_filter($paths, function ($path) {
            return is_dir($path);
        });

        if (empty($paths)) {
            return $this;
        }

        $namespace = app()->getNamespace();

        foreach ((new Finder())->in($paths)->files() as $datatable) {
            $datatable = $namespace.str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($datatable->getRealPath(), realpath(app_path()).DIRECTORY_SEPARATOR)
                );

            $this->registerDatatable($datatable);
        }

        return $this;
    }
}
