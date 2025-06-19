<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Categories - FR3ON GYM')]
class CategoriesPage extends Component
{
    public function render()
    {
        $categories = \App\Models\Category::where('is_active', 1)
            ->orderBy('name')
            ->get();
        return view('livewire.categories-page', [
            'categories' => $categories,
        ]);
    }
}
