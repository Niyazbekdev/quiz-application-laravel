<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class MakeServiceClass extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service  {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected function getStub(): string
    {
        return __DIR__.'/../../../stubs/service.stub';
    }
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Services';
    }
}
