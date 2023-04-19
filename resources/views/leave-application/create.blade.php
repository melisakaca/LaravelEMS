<x-app-layout>
    <x-slot name="header">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
    </x-slot>
    <div class="font-sans text-gray-900 antialiased">
        <div class="flex flex-col sm:justify-center items-center pt-5 pb-5 mt-20">
            <h2 class="font-bold text-2xl">Application Form</h2>
            <div class="w-full sm:max-w-xl mt-6 mb-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div>
                    <x-auth-validation-errors class="ml-16 mb-5" :errors="$errors" />
                    <form method="POST" action="{{ route('leave_application.store') }}" class="border-b-2 pb-10 ml-16">
                        @csrf
                        @if (session()->has('message'))
                            <div class="bg-green-200 border-t-4 border-green-400 rounded-b text-green-500 px-4 py-3 shadow-md flex items-center mb-3"
                                role="alert">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                    </svg></div>
                                <div>
                                    <p class="font-bold">{{ session()->get('message') }}</p>
                                </div>
                            </div>
                        @endif
                        <div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">
                                    Leave Type
                                </label>
                                <select name="leave_type_id" id="leave_type_id" type="text"
                                    class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-96 py-2 focus:outline-none focus:border-blue-400"
                                    placeholder="leave Type" required>
                                    <option value="">-- Select a leave type --</option>
                                    @foreach ($leaveTypes as $leaveType)
                                        <option class="text-sm text-black" value="{{ $leaveType->id }}">
                                            {{ $leaveType->leave_type_name }}

                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <br />
                            <label class="block font-medium text-sm text-gray-700">
                                Duration
                            </label>
                            <select name="duration_id" id="duration_id" type="text"
                                class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-96 py-2 focus:outline-none focus:border-blue-400"
                                placeholder="Duration" required>
                                <option value="">-- Select duration--</option>
                                <option value="0">One Day</option>
                                <option value="1">Range</option>
                            </select>
                        </div>
                        <br />

                        <div>

                            <label class="block font-medium text-sm text-gray-700">
                                StartDate
                            </label>
                            <input type="date" value="{{ old('start_date') }}"
                                class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-96 py-2 focus:outline-none focus:border-blue-400 @error('startDate') is-invalid @enderror"
                                id="start_date" name="start_date" aria-describedby="emailHelp">
                        </div> <br />
                        <div>
                            <label class="block font-medium text-sm text-gray-700">
                                EndDate
                            </label>
                            <input type="date" value="{{ old('end_date') }}"
                                class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-96 py-2 focus:outline-none focus:border-blue-400 @error('startDate') is-invalid @enderror"
                                id="end_date" name="end_date" aria-describedby="emailHelp">
                        </div>
                        <div class="mt-4">
                            <input name="comment" type="text"
                                class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-96 py-2 focus:outline-none focus:border-blue-400"
                                placeholder="Comment" required>
                        </div> <br />
                        @foreach ($all_leave_applications as $item)
                            {{ $item->day_of_aplication }}
                        @endforeach
                        {{-- <div class="mr-16 ">
                            <div class="flex space-x-4 mb-4 text-sm font-medium pb-3 border-b border-slate-200">
                                <div class="flex-auto flex space-x-4">
                                    <div class="text-black">
                                        Allowance
                                    </div>
                                </div>
                                <div class="flex-none flex items-center justify-center text-black  ">
                                    If approved
                                </div>
                            </div>
                            <div class="flex space-x-4 mb-6 text-sm font-medium">
                                <div class="flex-auto flex space-x-4">
                                    <div class="text-black">
                                        {{ $allEntitlements }}
                                    </div>
                                </div>
                                <div class="flex-none flex items-center justify-center text-black  ">
                                
                                </div>
                            </div>
                        </div> --}}
                        <div class="flex items-center mt-4">
                            <button type="submit"
                                class="mt-2 text-sm sm:text-base pl-2 pr-4 bg-teal-500 hover:bg-teal-700  rounded-lg border border-gray-400 w-96 py-2 focus:outline-none focus:border-blue-400">
                                Book time Off
                            </button>
                        </div>
</x-app-layout>
