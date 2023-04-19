<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leaves to Approve') }}
        </h2>
    </x-slot>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 my-10 max-w-screen-xl mx-auto">
        @foreach ($users as $item)
            <div class="border shadow-lg bg-white p-4 grid grid-cols-2 gap-y-3">
                <div class="flex gap-x-2 border-b">
                    <div class="font-bold capitalize">{{ $item->leave_type_name }}</div>
                    <div class="capitalize">{{ $item->noOfWorkingDay }}
                        @if ($item->noOfWorkingDay == 1)
                            day
                        @else
                            days
                        @endif
                    </div>
                </div>
                <div class="font-bold capitalize border-b">
                    <div class="flex justify-end">
                        {{ $item->name }}
                    </div>
                </div>
                <div>Start:{{ $item->start_date }}</div>
                <div>End: {{ $item->end_date }}</div>
                <div class="italic col-span-2">{{ $item->comment }}</div>
                <div class="col-span-2">
                    <div class="flex justify-center gap-x-2">
                        <form method="POST" action="{{ route('leaves-to-approve.approveLeave', $item->id) }}">
                            @csrf
                            <div class="flex justify-center gap-x-2">
                                <button type="submit"
                                    class="flex justify-end items-center bg-green-500 hover:bg-green-600 text-white p-2 rounded-md">
                                    <x-core.icons.thumb-up />Approve
                                </button>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('leaves-to-approve.declineLeave', $item->id) }}">
                            @csrf
                            <div class="flex justify-center gap-x-2">
                                <button type="submit"
                                    class="flex justify-end items-center bg-red-500 hover:bg-red-600 text-white p-2 rounded-md">
                                    <x-core.icons.thumb-down />Decline
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
