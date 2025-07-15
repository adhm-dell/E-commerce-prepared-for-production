<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
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

    public $step = 100;
    public $adjustedMaxPrice = 10000;
    public $adjustedMinPrice = 0;


    public function mount()
    {
        $minProductPrice = Product::min('price') ?? 0;
        $maxProductPrice = Product::max('price') ?? 0;

        // Round them to the nearest step
        $this->adjustedMinPrice = floor($minProductPrice / $this->step) * $this->step;
        $this->adjustedMaxPrice = ceil($maxProductPrice / $this->step) * $this->step;
        // Set price only if it's null (to respect filters from URL)
        if ($this->price === null) {
            $this->price = $this->adjustedMaxPrice;
        }
    }

    #[Computed]
    public function minPrice(): float
    {
        return $this->adjustedMinPrice;
    }

    #[Computed]
    public function maxPrice(): float
    {
        return $this->adjustedMaxPrice;
    }

    //add product to cart method
    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCart($product_id);
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        LivewireAlert::title('Product Added to Cart Successfully!')
            ->success()
            ->position('bottom-end')
            ->toast(true)
            ->show();
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
            'products' => $productsQuery->paginate(6),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
