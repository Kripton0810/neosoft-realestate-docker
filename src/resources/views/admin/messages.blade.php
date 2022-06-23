<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12 mx-3">
        @foreach ($messages as $message)
            <div class="card">
                <div class="card-header">
                    Message
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ $message->message }}</p>
                        <footer class=" mt-3 blockquote-footer">{{ $message->name }}
                        </footer>
                    </blockquote>
                </div>
            </div>
        @endforeach
    </div>
</x-admin-layout>
