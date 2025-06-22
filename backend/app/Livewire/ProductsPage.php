<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - FR3ON GYM')]
class ProductsPage extends Component
{
    use WithPagination;
    public function render()
    {
        $productsQuery = Product::query()->where('is_active', 1);
        return view('livewire.products-page', [
            'products' => $productsQuery->paginate(6),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
