<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire;

class LivewireServiceProvider extends Livewire\LivewireServiceProvider
{
    /**
     * Specify Blade directives that should never be overwritten.
     *
     * @var string[][]
     */
    protected $bladeDirectivesToRegisterIfMissing = [
        'js' => [Livewire\LivewireBladeDirectives::class, 'js'],
    ];

    protected function registerBladeDirectives()
    {
        foreach ($this->bladeDirectivesToRegisterIfMissing as $name => $callable) {
            $this->registerBladeDirectiveIfNotRegistered($name, $callable);
        }

        Blade::directive('this', [Livewire\LivewireBladeDirectives::class, 'this']);
        Blade::directive('entangle', [Livewire\LivewireBladeDirectives::class, 'entangle']);
        Blade::directive('livewire', [Livewire\LivewireBladeDirectives::class, 'livewire']);
        Blade::directive('livewireStyles', [Livewire\LivewireBladeDirectives::class, 'livewireStyles']);
        Blade::directive('livewireScripts', [Livewire\LivewireBladeDirectives::class, 'livewireScripts']);
    }

    protected function registerBladeDirectiveIfNotRegistered(string $name, callable $callable)
    {
        if (! $this->bladeDirectiveAlreadyRegistered($name)) {
            Blade::directive($name, $callable);
        }
    }

    protected function bladeDirectiveAlreadyRegistered(string $name): bool
    {
        if (method_exists(BladeCompiler::class, Str::start($name, 'compile'))) {
            return true;
        }

        if (array_key_exists($name, Blade::getCustomDirectives())) {
            return true;
        }

        return false;
    }
}
