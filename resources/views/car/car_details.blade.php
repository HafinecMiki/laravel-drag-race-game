<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Car Details') }}
        </h2>
    </x-slot>
    <!-- Modal -->
    <div class="modal fade" id="CarDeleteModal" tabindex="-1" aria-labelledby="CarDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="CarDeleteModalLabel">Confirm Deletion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure you want to delete this Car?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('car-delete', $car->id) }}" method="POST" class="d-flex">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Details -->
    <div class="row mx-0 justify-content-center mt-sm-0 mt-3">
        <div class="col-sm-6 px-4 py-4">
            <div class="card">
                <div class="card-body">
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
                                <td class="word-break">{{ $car->weight }}</td>
                            </tr>
                            <tr>
                                <td>Performance</td>
                                <td class="word-break">{{ $car->performance }}</td>
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
                        <button class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#CarDeleteModal">Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
