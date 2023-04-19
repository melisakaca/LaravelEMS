<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <div class="font-sans text-gray-900 antialiased">
        <div class="flex flex-col sm:justify-center items-center pt-5 pb-5 mt-20">
            <h2 class="font-bold text-2xl">Application Form</h2>

            <div class="w-full sm:max-w-xl mt-6 mb-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div>
                    <form method="POST" class="border-b-2 pb-10 ml-16">
                        @csrf
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
                            <div>
                                <label class="block font-medium text-sm text-gray-700">
                                    Duration
                                </label>
                                <select name="duration_id" id="duration_id" type="text"
                                    class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-96 py-2 focus:outline-none focus:border-blue-400"
                                    onchange="EndDate('hidden', this)" placeholder="Duration" required>
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
                            <div id="hidden" style=" display: none;">
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
                            <div class="mr-16 ">
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
                                            20 Days
                                        </div>

                                    </div>
                                    <div class="flex-none flex items-center justify-center text-black  ">
                                        19 Days
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center mt-4">
                                <button type="submit"
                                    class="mt-2 text-sm sm:text-base pl-2 pr-4 bg-teal-500 hover:bg-teal-700  rounded-lg border border-gray-400 w-96 py-2 focus:outline-none focus:border-blue-400">
                                    Book off time
                                </button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>


    <script>
        function EndDate(divId, element) {
        document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none';
    }
    </script>


</x-app-layout>