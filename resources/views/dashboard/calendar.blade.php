<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>
    @if (Auth::user()->role == "admin")
    <div class="container mx-auto px-32 mt-16">
        <div id="calendar"></div>
    </div>
    @else
    {{-- @if (Auth::user()->role == "user") --}}
    <div class="container mx-auto px-32 mt-16">
        <div id="calendar1"></div>
    </div>
    @endif
    {{-- <div id="calendar"></div> --}}
</x-app-layout>