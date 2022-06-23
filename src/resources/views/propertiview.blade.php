@include('layouts.header')
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
</svg>
@if (session('success'))
    <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        @php
            $i = 1;
        @endphp
        @foreach ($info->images as $url)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i++ }}"
                aria-label="Slide {{ $i }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ Storage::url($info->default_image) }}" height="500" width="900" class="d-block w-100"
                alt="...">
        </div>
        @foreach ($info->images as $url)
            <div class="carousel-item">
                <img src="{{ Storage::url($url->url) }}" height="500" width="900" class="d-block w-100"
                    alt="...">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<h2 class="text-center">{{ $info->title }} </h2>
<h6 class="text-center"><i class="fa-solid fa-location-pin"></i>&nbsp;{{ $info->city }}</small></h6>
<h4 class="p-2">Description</h4>
<p class="px-4">
    {{ $info->description }}
</p>
<div class="mx-4">
    <u>
        <h5>No. of Bedroom</h5>
    </u> <span>
        {{ $info->bedroom }}</span>
    <u>
        <h5>No. of Bathroom</h5>
    </u> <span>
        {{ $info->bathroom }}</span>

    <u>
        <h5>Area in sq. ft.</h5>
    </u> <span>
        {{ $info->floor_area }}</span>

    <u>
        <h5>Cost </h5>
    </u> <span>₹
        {{ $info->price }}</span>
</div>
@auth
    <form action="{{ route('sendmassage') }}" method="post">
        @csrf
        <input type="number" class="d-none" name="property" value="{{ $info->id }}">
        <h3 class="mx-3">Send Message</h3>
        <div class="form-floating mx-5">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
                name="message"></textarea>
            <label for="floatingTextarea2">Comments</label>
        </div>
        <button type="submit" class="mb-5 mt-1 mx-5 btn btn-primary">Send Message</button>
    </form>
@endauth
<div class="mb-5"></div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@include('layouts.footer')
