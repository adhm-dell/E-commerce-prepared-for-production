<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home - FR3ON GYM')]
class HomePage extends Component
{
    public function render()
    {
        $brands = Brand::where('is_featured', 1)->limit(4)->get();
        $categories = Category::where('is_featured', 1)->limit(4)->get();
        $products = Product::where('is_featured', 1)->limit(4)->get();
        return view('livewire.home-page', ['brands' => $brands, 'categories' => $categories, 'products' => $products]);
    }
}
