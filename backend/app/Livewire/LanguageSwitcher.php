<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class LanguageSwitcher extends Component
{
    public $locale;

    public function mount()
    {
        $this->locale = app()->getLocale();
    }

    public function switch($lang)
    {
        app()->setLocale($lang);
        session()->put('locale', $lang);
        $this->locale = $lang;
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
