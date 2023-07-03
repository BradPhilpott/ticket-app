<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Country;
use App\Models\Supplier;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class TicketList extends Component
{
    use WithPagination;

    public array $suppliers = [];

    public array $countries = [];

    public array $selected = [];

    public string $sortColumn = 'tickets.name';

    public string $sortDirection = 'asc';

    public array $searchColumns = [
        'name' => '',
        'price' => ['', ''],
        'description' => '',
        'category_id' => 0,
        'country_id' => 0,
    ];

    protected $queryString = [
        'sortColumn' => [
            'except' => 'tickets.name'
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
        $tickets = Ticket::whereIn('id', $this->selected)->get();
        $tickets->each->delete();

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
        $tickets = Ticket::query()
            ->select(['tickets.*', 'priorities.id as priorityId', 'priorities.name as priorityName'])
            ->leftjoin('priorities', 'priorities.id', '=', 'tickets.priority')
            ->with('suppliers');

        foreach ($this->searchColumns as $column => $value) {
            if (!empty($value)) {
                $tickets->when($column == 'price', function ($tickets) use ($value) {
                    if (is_numeric($value[0])) {
                        $tickets->where('tickets.price', '>=', $value[0] * 100);
                    }
                    if (is_numeric($value[1])) {
                        $tickets->where('tickets.price', '<=', $value[1] * 100);
                    }
                })
                ->when($column == 'priority', fn($tickets) => $tickets->whereRelation('priority', 'order', $value))
                ->when($column == 'name', fn($tickets) => $tickets->where('tickets.' . $column, 'LIKE', '%' . $value . '%'));
            }
        }

        $tickets->orderBy($this->sortColumn, $this->sortDirection);

        return view('livewire.ticket-list',  [
            'tickets' => $tickets->paginate(10)
        ]);
    }
}