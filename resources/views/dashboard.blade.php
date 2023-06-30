<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (Session::has('winner'))
                    <div class="alert alert-success" role="alert">
                        The winner is {{ Session::get('winner')->brand }}
                    </div>
                @endif
                <form action="{{ route('start-race') }}" method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Type</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Performance</th>
                                <th scope="col">Production date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $car)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{ $car->id }}" /></td>
                                    <td>{{ $car->brand }}</td>
                                    <td>{{ $car->type }}</td>
                                    <td>{{ $car->weight }}</td>
                                    <td>{{ $car->performance }}</td>
                                    <td>{{ date('Y-m-d', strtotime($car->production_date)) }}</td>
                                    <td class="companies-header-td d-flex justify-content-center">
                                        <a href="{{ route('car-details', $car->id) }}">

                                                Details
                                                <i class='far fa-paper-plane'></i>

                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Start Race</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
