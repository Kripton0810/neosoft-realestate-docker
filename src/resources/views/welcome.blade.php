@include('layouts.header')
<nav class="navbar navbar-light bg-light mt-2">
    <div class="container-fluid d-flex flex-row-reverse">

        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
            aria-controls="offcanvasExample">
            <i class="fa-solid fa-filter"></i>&nbsp; Filter
        </button>
    </div>
</nav>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filter</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            You can filter using pricing, place
        </div>
        <div class="m-3"></div>
        <form method="POST" action="{{ route('sort') }}">
            @csrf
            <div class="input-group mb-3">
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect02">City</label>
                <select class="form-select" id="inputGroupSelect02" name="city">
                    <option value="">Choose...</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->name }}">{{ $city->name }}</option>
                    @endforeach
                </select>

            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect02">Number of bedroom</label>
                <input class="form-control" type="number" name="bedroom" id="">

            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect02">Max price</label>
                <input class="form-control" type="number" name="price" id="">
            </div>
            <button class="btn btn-outline-secondary" type="submit">Search</button>

    </div>
</div>
<div class="d-flex flex-column mt-3 mx-5">
    @foreach ($info as $property)
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4 align-center d-flex">
                    <img src="{{ Storage::url($property->default_image) }}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        <p class="card-text">{{ $property->description }}</p>
                        <p class="card-text">Address: {{ $property->address }}</p>
                        <h6>Specification</h6>
                        <p>Bedroom: {{ $property->bedroom }}, Bathroom: {{ $property->bathroom }}</p>
                        <p>Area {{ $property->floor_area }} sq ft.</p>
                        <p class="card-text"><small class="text-muted"><i
                                    class="fa-solid fa-location-pin"></i>&nbsp;{{ $property->city }}</small></p>
                        <p class="card-text">Price: ₹{{ $property->price }}</p>
                        <a href="/testme/{{ $property->id }}" class="btn btn-primary">Show more...</a>

                    </div>

                </div>
            </div>
        </div>
    @endforeach

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@include('layouts.footer')
