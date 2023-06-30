<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Modal Win Race -->
    @if (Session::has('winner'))
        <x-modal name="confirm-user-deletion" :show="Session::has('winner')" focusable>
            <div class="p-2">
                <h1 class="text-xl font-medium text-gray-900 p-2">
                    {{ __('Winner car details')}}
                </h1>
                <div class="d-flex justify-center">
                    <img
                        src="{{ Session::get('winner')->image ? asset('images/'. Session::get('winner')->image) : asset('image/no-photo-car.jpg') }}"
                        class="p-2"/>
                </div>
                <table class="table table-striped table-light">
                    <tbody>
                    <tr>
                        <td>Brand</td>
                        <td class="word-break">{{ Session::get('winner')->brand }}</td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td class="word-break">{{ Session::get('winner')->type }}</td>
                    </tr>
                    <tr>
                        <td>Weight</td>
                        <td class="word-break">{{ Session::get('winner')->weight }}</td>
                    </tr>
                    <tr>
                        <td>Performance</td>
                        <td class="word-break">{{ Session::get('winner')->performance }}</td>
                    </tr>
                    <tr>
                        <td>Production date</td>
                        <td class="word-break">{{ date('Y-m-d', strtotime(Session::get('winner')->production_date)) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </x-modal>
    @endif
    <!-- Draw race -->
    @if (Session::has('draw'))
        <div class="alert alert-success" role="alert">
            Draw race! Winners
            @foreach (Session::get('draw') as $car)
                , {{ $car->brand . ' ' . $car->type }}
            @endforeach .
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="d-flex justify-end sm:p-4 p-2">
                    <a href="{{ route('car-create-page') }}">
                        <x-primary-button>
                            {{ __('Add new car') }}
                        </x-primary-button>
                    </a>
                </div>
                <form action="{{ route('start-race') }}" method="POST">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Type</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Performance</th>
                            <th scope="col">Production date</th>
                            <th scope="col"/>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cars as $car)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ intval($car->id) }}"/></td>
                                <td>
                                    <img
                                        src="{{ $car->image ? asset('images/'. $car->image) : asset('image/no-photo-car.jpg') }}"
                                        alt="" width="100" height="100"/>
                                </td>
                                <td>{{ $car->brand }}</td>
                                <td>{{ $car->type }}</td>
                                <td>{{ $car->weight }} kg</td>
                                <td>{{ $car->performance }} Le</td>
                                <td>{{ date('Y-m-d', strtotime($car->production_date)) }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('car-details', $car->id) }}" class="d-flex">
                                        Details
                                        <img src="{{ asset('image/paper-plane-solid.svg') }}"
                                             width="15"
                                             height="15"
                                             class="ml-2"
                                             alt="paper plane"/>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="list-unstyled m-0">
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3 d-flex justify-center">
                        <div>
                            <x-primary-button type="submit">{{ __('Start Race') }}</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
