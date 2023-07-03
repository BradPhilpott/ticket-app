<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $editing ? 'Edit ' . $ticket->name : 'Create Ticket' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form wire:submit.prevent="save">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input wire:model.defer="ticket.name" id="name" class="block mt-1 w-full" type="text" />
                            <x-input-error :messages="$errors->get('ticket.name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label class="mb-1" for="ticket.priority" :value="__('Priority')" />

                            <x-select-field class="mt-1" id="priority" name="priority" :options="$this->listsForFields['priority']" wire:model="ticket.priority" />
                            <x-input-error :messages="$errors->get('ticket.priority')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label class="mb-1" for="suppliers" :value="__('Supplier(s)')" />

                            <x-select-field class="mt-1" id="suppliers" name="suppliers" :options="$this->listsForFields['suppliers']" wire:model="suppliers" multiple />
                            <x-input-error :messages="$errors->get('suppliers')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="details" :value="__('Details')" />

                            <div wire:ignore>
                                <textarea wire:model.defer="ticket.details" data-details="@this" id="details" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('ticket.details')" class="mt-2" />
                        </div>


                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Cost to Fix(£)')" />

                            <x-text-input wire:model.defer="ticket.price" type="number" min="0" step="0.01" class="block mt-1 w-full" id="price" />
                            <x-input-error :messages="$errors->get('ticket.price')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="start_date" :value="__('Start Date')" />

                            <x-text-input wire:model.defer="ticket.start_date" type="date" class="block mt-1 w-full" id="start_date" />
                            <x-input-error :messages="$errors->get('ticket.start_date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="end_date" :value="__('End Date')" />

                            <x-text-input wire:model.defer="ticket.end_date" type="date" class="block mt-1 w-full" id="end_date" />
                            <x-input-error :messages="$errors->get('ticket.end_date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button type="submit">
                                Save
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
    <script>
        var ready = (callback) => {
            if (document.readyState != "loading") callback();
            else document.addEventListener("DOMContentLoaded", callback);
        }
        ready(() => {
            ClassicEditor
                .create(document.querySelector('#details'))
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.set('ticket.details', editor.getData());
                    })
                    Livewire.on('reinit', () => {
                        editor.setData('', '')
                    })
                })
                .catch(error => {
                    console.error(error);
                });
        })
    </script>
@endpush