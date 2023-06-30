<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(request('car') ? 'Edit Car' : 'Add New Car') }}
        </h2>
    </x-slot>
    <!-- Edit or Add part -->
    <div class="row mx-0 justify-content-center mt-sm-0 mt-3">
        <div class="col-sm-6 px-4 py-4">
            <div class="card">
                <div class="card-body">
                    <!-- Success message -->
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <!-- Error message -->
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="list-unstyled m-0">
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Image -->
                    @if (request('car') && !$car->image)
                        <div id="image-upload-part" class="p-2 border text-center">
                            <h1 class="text-center">Image Upload</h1>

                            <form method="POST" action="{{ route('car-image-upload', $car->id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                <x-text-input type="file" class="form-control my-4" name="image"/>

                                <x-primary-button type="submit" class="btn btn-sm">{{ __('Upload') }}</x-primary-button>
                            </form>

                        </div>
                    @elseif (request('car') && $car->image)
                        <div class="d-flex justify-center">
                            <img src="{{ asset('images/' . $car->image) }}" class="p-2"/>
                        </div>
                    @endif
                    <!-- Data -->
                    <form
                        action="{{ request('car') ? route('car-edit', $car->id) : route('car-create') }}"
                        method="POST">
                        @csrf
                        {{ request('car') ? method_field('PUT') : method_field('POST') }}
                        <div class="mb-3">
                            <x-input-label for="brand" :value="__('Brand')"/>
                            <x-text-input name="brand"
                                          class="form-control"
                                          id="brand"
                                          placeholder="Toyota"
                                          value="{{ request('car') ? $car->brand : '' }}"
                                          required/>
                        </div>
                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Type')"/>
                            <x-text-input name="type"
                                          class="form-control"
                                          id="type"
                                          placeholder="Supra"
                                          value="{{ request('car') ? $car->type : '' }}"
                                          required/>
                        </div>
                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Weight')"/>
                            <x-text-input name="weight"
                                          class="form-control"
                                          id="weight"
                                          placeholder="800 kg"
                                          value="{{ request('car') ? $car->weight : '' }}"
                                          required/>
                        </div>
                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Performance')"/>
                            <x-text-input name="performance"
                                          class="form-control"
                                          id="performance"
                                          placeholder="1000 Le"
                                          value="{{ request('car') ? $car->performance : '' }}"
                                          required/>
                        </div>
                        <div class="mb-3">
                            <x-input-label for="production_date" :value="__('Production date')"/>
                            <x-text-input type="date"
                                          id="production_date"
                                          class="form-control"
                                          name="production_date"
                                          max="{{ date('Y-m-d') }}"
                                          min="1940-01-01"
                                          value="{{request('car') ? date('Y-m-d', strtotime($car->production_date)) : ''}}"
                                          required/>
                        </div>
                        <div class="mb-3">
                            <div class="d-grid">
                                <button class="btn btn-primary">{{ request('car') ? 'Edit' : 'Add new' }}</button>
                            </div>
                        </div>
                    </form>
                    <div class="mb-3">
                        <a class="d-grid"
                           href="{{ request('car') ? route('car-details', request('car'))  : route('dashboard') }} ">
                            <button class="btn btn-secondary">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
