<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;

#[Title('Products - FR3ON GYM')]
class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_brands = [];

    #[Url]
    public $in_stock = false;

    #[Url]
    public $on_sale = false;

    #[Url]
    public $price = null;

    #[Url]
    public $sortBy = 'latest';


    public function mount()
    {
        if ($this->price === null) {
            $this->price = Product::max('price') ?? 100000;
        }
    }

    #[Computed]
    public function minPrice(): float
    {
        return Product::min('price') ?? 0;
    }

    #[Computed]
    public function maxPrice(): float
    {
        return Product::max('price') ?? 100000; // Fallback if no products
    }

    public function render()
    {
        $productsQuery = Product::query()->where('is_active', 1);

        if (!empty($this->selected_categories)) {
            $productsQuery->whereIn('category_id', $this->selected_categories);
        }

        if (!empty($this->selected_brands)) {
            $productsQuery->whereIn('brand_id', $this->selected_brands);
        }

        if ($this->in_stock) {
            $productsQuery->where('in_stock', true);
        }

        if ($this->on_sale) {
            $productsQuery->where('on_sale', true);
        }

        if ($this->price) {
            $productsQuery->where('price', '<=', $this->price);
        }

        if ($this->sortBy === 'price') {
            $productsQuery->orderBy('price', 'asc');
        } else {
            $productsQuery->latest();
        }

        return view('livewire.products-page', [
            'products' => $productsQuery->paginate(9),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
