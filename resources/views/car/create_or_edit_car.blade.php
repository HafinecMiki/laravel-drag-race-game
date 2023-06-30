<x-app-layout>
    <div class="row mx-0 justify-content-center mt-sm-0 mt-3">
        <div class="col-sm-6 px-4 py-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ request('car') ? 'Edit' : 'Add new' }} car</h3>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="list-unstyled m-0">
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form
                        action="{{ request('car') ? route('car-edit', $car->id) : route('car-create') }}"
                        method="POST">
                        @csrf
                        {{ request('car') ? method_field('PUT') : method_field('POST') }}
                        <div class="mb-3">
                            <x-input-label for="brand" :value="__('Brand')" />
                            <x-text-input name="brand"
                                          class="form-control"
                                          id="brand"
                                          placeholder="Toyota"
                                          value="{{ request('car') ? $car->brand : '' }}"
                                          required />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Type')" />
                            <x-text-input name="type"
                                          class="form-control"
                                          id="type"
                                          placeholder="Supra"
                                          value="{{ request('car') ? $car->type : '' }}"
                                          required />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Weight')" />
                            <x-text-input name="weight"
                                          class="form-control"
                                          id="weight"
                                          placeholder="800"
                                          value="{{ request('car') ? $car->weight : '' }}"
                                          required />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="name" :value="__('Performance')" />
                            <x-text-input name="performance"
                                          class="form-control"
                                          id="performance"
                                          placeholder="1000"
                                          value="{{ request('car') ? $car->performance : '' }}"
                                          required />
                        </div>
                        <div class="mb-3">
                            <x-input-label for="production_date" :value="__('Production date')" />
                            <x-text-input type="date"
                                          id="production_date"
                                          class="form-control"
                                          name="production_date"
                                          required
                                          value="{{date('Y-m-d', strtotime($car->production_date))}}"
                                          required />
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
