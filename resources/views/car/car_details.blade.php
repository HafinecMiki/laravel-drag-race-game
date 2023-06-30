<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Car Details') }}
        </h2>
    </x-slot>
    <!-- Modal -->
    <x-modal name="confirm-user-deletion" focusable>
        <form method="post" action="{{ route('car-delete', $car->id) }}" class="p-6">
            @csrf
            @method('delete')

            <h6 class="text-md font-medium text-gray-900">
                {{ __('Are you sure you want to delete this Car?') }}
            </h6>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
    <!-- Details -->
    <div class="row mx-0 justify-content-center mt-sm-0 mt-3">
        <div class="col-sm-6 px-4 py-4">
            <div class="card">
                <div class="card-body">
                    @if (request('car'))
                        <div class="d-flex justify-center">
                            <img
                                src="{{ $car->image ? asset('storage/' . $car->image) : asset('image/no-photo-car.jpg') }}"
                                class="p-2"/>
                        </div>
                    @endif
                    <table class="table table-striped table-light">
                        <tbody>
                        <tr>
                            <td>Brand</td>
                            <td class="word-break">{{ $car->brand }}</td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td class="word-break">{{ $car->type }}</td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td class="word-break">{{ $car->weight }} kg</td>
                        </tr>
                        <tr>
                            <td>Performance</td>
                            <td class="word-break">{{ $car->performance }} Le</td>
                        </tr>
                        <tr>
                            <td>Production date</td>
                            <td class="word-break">{{ date('Y-m-d', strtotime($car->production_date)) }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="d-flex align-items-center justify-content-around">
                        <a href="{{ route('car-edit-page', $car->id) }}">
                            <button class="btn btn-primary px-4">Edit</button>
                        </a>
                        <!-- Button trigger modal -->
                        <x-danger-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        >{{ __('Delete Account') }}</x-danger-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
