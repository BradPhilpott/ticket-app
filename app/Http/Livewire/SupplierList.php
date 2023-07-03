<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class SupplierList extends Component
{
    use WithPagination;

    public array $selected = [];

    public string $sortColumn = 'suppliers.name';

    public string $sortDirection = 'asc';

    public array $searchColumns = [
        'name' => ''
    ];

    protected $queryString = [
        'sortColumn' => [
            'except' => 'suppliers.name'
        ],
        'sortDirection' => [
            'except' => 'asc',
        ],
    ];

    protected $listeners = ['deleteSelected'];

    public function getSelectedCountProperty(): int
    {
        return count($this->selected);
    }

    public function deleteConfirm($method, $id = null): void
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'  => 'warning',
            'title' => 'Are you sure?',
            'text'  => '',
            'id'    => $id,
            'method' => $method,
        ]);
    }

    public function deleteSelected(): void
    {
        $suppliers = Supplier::whereIn('id', $this->selected)->get();

        foreach ($suppliers as $supplier) {
            if ($supplier->tickets()->exists()) {
                $this->addError("ticketexist", "Supplier <span class='font-bold'>{$supplier->name}</span> cannot be deleted, it's been assigned to a ticket");
                return;
            }
        }

        $suppliers->each->delete();

        $this->reset('selected');
    }

    public function sortByColumn($column): void
    {
        if ($this->sortColumn == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->reset('sortDirection');
            $this->sortColumn = $column;
        }
    }

    public function render(): View
    {
        $suppliers = Supplier::query()
            ->select(['suppliers.*']);

        foreach ($this->searchColumns as $column => $value) {
            if (!empty($value)) {
                $suppliers->when($column == 'name', fn($suppliers) => $suppliers->where('suppliers.' . $column, 'LIKE', '%' . $value . '%'));
            }
        }

        $suppliers->orderBy($this->sortColumn, $this->sortDirection);

        return view('livewire.supplier-list',  [
            'suppliers' => $suppliers->paginate(10)
        ]);
    }
}