<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Suppliers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @error('ticketexist')
                        <div class="p-3 mb-4 text-green-700 bg-green-200">
                            {!! $message !!}
                        </div>
                    @enderror

                    <div class="mb-4">
                        <a href="{{ route('suppliers.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent hover:bg-gray-700">
                            Create supplier
                        </a>

                        <button type="button"
                                wire:click="deleteConfirm('deleteSelected')"
                                wire:loading.attr="disabled"
                                @disabled(! $this->selectedCount)
                                class="px-4 py-2 mr-5 text-xs text-red-500 uppercase bg-red-200 rounded-md border border-transparent hover:text-red-700 hover:bg-red-300 disabled:opacity-50 disabled:cursor-not-allowed">
                            Delete Selected
                        </button>
                    </div>

                    <div class="overflow-hidden overflow-x-auto mb-4 min-w-full align-middle sm:rounded-md">
                        <table class="min-w-full border divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left bg-gray-50">
                                    </th>
                                    <th wire:click="sortByColumn('suppliers.name')" class="px-6 py-3 text-left bg-gray-50">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 uppercase">Name</span>
                                        @if ($sortColumn == 'supplier.name')
                                            @include('svg.sort-' . $sortDirection)
                                        @else
                                            @include('svg.sort')
                                        @endif
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50">
                                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 uppercase">Create At</span>
                                    </th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="px-2 py-2">
                                        <input wire:model="searchColumns.name" type="text" placeholder="Search..."
                                               class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    </td>
                                    <td class="px-2 py-1">
                                    </td>
                                    <td class="px-2 py-1">
                                    </td>
                                    <td class="px-2 py-1 text-sm">
                                    </td>
                                    <td></td>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach($suppliers as $supplier)
                                    <tr class="bg-white">
                                        <td class="px-4 py-2 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            <input type="checkbox" value="{{ $supplier->id }}" wire:model="selected">
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 whitespace-no-wrap">
                                            <a href="{{ route('suppliers.edit', $supplier) }}">
                                                {{ $supplier->name }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ date('d/m/Y', strtotime($supplier->created_at)); }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>