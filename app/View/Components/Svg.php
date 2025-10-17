<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Svg extends Component
{
    public $icon;
    public $attributes;
    public function __construct($icon, $attributes = [])
    {
        $this->icon = $icon;
        $this->attributes = $attributes;
    }
    
    public function render(): View|Closure|string
    {
        $path = resource_path("svg/{$this->icon}.svg");
        if (file_exists($path)) {
            $fileContent = file_get_contents($path);
            foreach ($this->attributes as $key => $value) {
                $fileContent =  preg_replace(
                    '/<svg/',
                    "<svg {$key}=\"{$value}\"",
                    $fileContent,
                    1
                );
            }
            return $fileContent;
        }
        return "";
    }
}
