<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Priority;
use App\Models\Company;
use App\Models\Supplier;
use App\Models\MapFeature;
use Livewire\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SupplierForm extends Component
{
    public Supplier $supplier;

    public bool $editing = false;

    public function mount(Supplier $supplier): void
    {
        $this->supplier = $supplier;

        if ($this->supplier->exists) {
            $this->editing = true;
        }
    }

    public function save(): RedirectResponse|Redirector
    {
        $this->validate();

        $this->supplier->save();

        return redirect()->route('suppliers.index');
    }

    public function render(): View
    {
        return view('livewire.supplier-form');
    }

    protected function rules(): array
    {
        return [
            'supplier.name' => ['required', 'string']
        ];
    }
}
