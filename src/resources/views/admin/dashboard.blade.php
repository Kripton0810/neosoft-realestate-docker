<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('admin.addproperty') }}"
                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                        Add Property
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column mt-3 mx-5">
        @foreach ($my_properties as $property)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4 align-center d-flex">
                        <img src="{{ Storage::url($property->default_image) }}" class="img-fluid rounded-start"
                            alt="...">
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
                            <a href="{{ route('admin.mymessages', $property->id) }}" class="btn btn-primary">Show
                                Messages</a>
                            <a href="{{ route('admin.property.edit', $property->id) }}" class="btn btn-info">Edit</a>

                            <form action="{{ route('admin.property.destroy', $property->id) }}" method="post"
                                class="form-group">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="show_confirm"
                                    style="padding:10px;background: rgb(255, 60, 60); margin:2px; color:white; border-radius: 4px">Delete</button>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this record?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>

</x-admin-layout>
