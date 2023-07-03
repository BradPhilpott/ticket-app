<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Priority;
use App\Models\Company;
use App\Models\Supplier;
use App\Models\MapFeature;
use Livewire\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TicketForm extends Component
{
    public Ticket $ticket;

    public bool $editing = false;

    public array $listsForFields = [];

    public array $suppliers = [];

    public function mount(Ticket $ticket): void
    {
        $this->ticket = $ticket;

        $this->initListsForFields();

        if ($this->ticket->exists) {
            $this->editing = true;

            $this->ticket->end_date = date('Y-m-d', strtotime($this->ticket->end_date));

            $this->ticket->start_date = date('Y-m-d', strtotime($this->ticket->start_date));

            $this->ticket->price = number_format($this->ticket->price, 2);

            $this->suppliers = $this->ticket->suppliers()->pluck('id')->toArray();
        }
    }

    public function save(): RedirectResponse|Redirector
    {
        $this->validate();

        $this->ticket->save();

        $this->ticket->suppliers()->sync($this->suppliers);

        return redirect()->route('tickets.index');
    }

    public function render(): View
    {
        return view('livewire.ticket-form');
    }

    protected function rules(): array
    {
        return [
            'ticket.name' => ['required', 'string'],
            'ticket.priority' => [],
            'suppliers' => [],
            'ticket.details' => [],

            'ticket.price' => [],
            'ticket.start_date' => [],
            'ticket.end_date' => []
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['priority'] = Priority::pluck('name', 'id')->toArray();

        $this->listsForFields['suppliers'] = Supplier::pluck('name', 'id')->toArray();
    }
}
