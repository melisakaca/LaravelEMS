<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Leaves') }}
        </h2>
    </x-slot>
    {{-- @if (Auth::user()->role == 'admin')
        Admin
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 my-10 max-w-screen-xl mx-auto">
            @foreach ($users as $item)
                <div class="border shadow-lg bg-white p-4">
                    <div class="flex justify-between border-b">
                        <div class="font-bold capitalize">{{ $item->leave_type_name }}</div>
                        <div class="capitalize">{{ $item->name }}</div>
                    </div>
                    <div class="flex justify-between my-2">
                        <div>Start:{{ $item->start_date }}</div>
                        <div>End: {{ $item->end_date }}</div>
                    </div>
                    <div class="italic">{{ $item->comment }}</div>
                </div>
            @endforeach
        </div>
    @else --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 my-10 max-w-screen-xl mx-auto">
        @foreach ($users as $item)
            @if ($item->name == Auth::user()->name)
                <div class="border shadow-lg bg-white p-4">
                    <div class="flex justify-between border-b">
                        <div class="font-bold capitalize">{{ $item->leave_type_name }}</div>
                        <div class="capitalize">{{ $item->noOfWorkingDay }}
                            @if ($item->noOfWorkingDay == 1)
                                day
                            @else
                                days
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-between my-2">
                        <div>Start:{{ $item->start_date }}</div>
                        <div>End: {{ $item->end_date }}</div>
                    </div>
                    <div class="italic">{{ $item->comment }}</div>
                    <div>
                        @if ($item->leave_status == 0)
                            <div class="flex justify-end text-yellow-500">Pending</div>
                        @elseif($item->leave_status == 1)
                            <div class="flex justify-end text-green-500">Approved</div>
                        @else
                            <div class="flex justify-end text-red-500">Declined</div>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    {{-- @endif --}}

</x-app-layout>
