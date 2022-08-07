<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Livewire;

class LivewireServiceProvider extends Livewire\LivewireServiceProvider
{
    protected function registerBladeDirectives()
    {
        // Blade::directive('js', [Livewire\LivewireBladeDirectives::class, 'js']);
        Blade::directive('this', [Livewire\LivewireBladeDirectives::class, 'this']);
        Blade::directive('entangle', [Livewire\LivewireBladeDirectives::class, 'entangle']);
        Blade::directive('livewire', [Livewire\LivewireBladeDirectives::class, 'livewire']);
        Blade::directive('livewireStyles', [Livewire\LivewireBladeDirectives::class, 'livewireStyles']);
        Blade::directive('livewireScripts', [Livewire\LivewireBladeDirectives::class, 'livewireScripts']);
    }
}
