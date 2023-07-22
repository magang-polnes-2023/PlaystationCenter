<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
            Input Form to order
        </h2>
    </x-slot>
    <div class="my-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                        <input type="text" id="user_id" name="user_id"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500"
                            placeholder="Enter your name" value="{{ auth()->user()->name }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Playstation Type:</label>
                        <input type="text" name="playstation_type"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500"
                            placeholder="Enter the Playstation Type" value="{{ $playstation->playstation_type }}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                        <input type="text" name="price" id="price"
                            class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500"
                            placeholder="Enter the Playstation Type" value="{{ $playstation->price }}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                        <div class="flex items-center justify-center h-full">
                            <img src="{{ asset('storage/' . $playstation->image) }}" alt="" width="350px"
                                class="">
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                    <form action="{{ route('card') }}" method="POST">
                        @if ($errors->any())
                            <div class="bg-red-500 text-white p-4 mt-3 rounded" role="alert" id="danger-alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <script>
                                setTimeout(function() {
                                    var successAlert = document.getElementById('danger-alert');
                                    successAlert.style.display = 'none';
                                }, 5000);
                            </script>
                        @endif
                        @csrf
                        @method('POST')
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="playstation_id" id="playstation_id" value="{{ $playstation->id }}">
                        <div class="mb-4">
                            <label for="booking_code" class="block text-gray-700 text-sm font-bold mb-2">Booking
                                Code:</label>
                            <input type="text" id="booking_code" name="booking_code"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500"
                                placeholder="Enter the Booking Date" required value="{{ $bookingCode }}" readonly>
                        </div>
                        <div class="mb-4">
                            <label for="booking_date" class="block text-gray-700 text-sm font-bold mb-2">Booking
                                Date:</label>
                            <input type="date" id="booking_date" name="booking_date"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500"
                                placeholder="Enter the Booking Date" required value="{{ old('booking_date') }}">
                        </div>
                        <div class="mb-4">
                            <label for="booking_duration" class="block text-gray-700 text-sm font-bold mb-2">Booking
                                Duration: /jam</label>
                            <input type="text" pattern="[1-9]" maxlength="1" id="booking_duration"
                                name="booking_duration"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500"
                                placeholder="Enter the Booking Duration" required
                                value="{{ old('booking_duration') }}">
                        </div>
                        <div class="mb-4">
                            <label for="start_time" class="block text-gray-700 text-sm font-bold mb-2">Start
                                Time:</label>
                            <input type="time" id="start_time" name="start_time"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500"
                                placeholder="Enter the Start Time" required value="{{ old('start_time') }}">
                        </div>
                        <div class="mb-4">
                            <label for="end_time" class="block text-gray-700 text-sm font-bold mb-2">End Time:</label>
                            <input type="time" id="end_time" name="end_time"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500"
                                placeholder="Enter the End Time" required value="{{ old('end_time') }}">
                        </div>
                        <div class="mb-4">
                            <label for="total_pay" class="block text-gray-700 text-sm font-bold mb-2">Total Pay:</label>
                            <input type="text" id="total_pay" name="total_pay"
                                class="w-full border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500"
                                placeholder="Enter the Total Pay" required value="{{ old('total_pay') }}">
                        </div>
                        <div class="flex justify-left">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-4">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ... kode sebelumnya ... -->

    <script>
        document.getElementById('start_time').addEventListener('input', validateBookingTime);
        document.getElementById('end_time').addEventListener('input', validateBookingTime);

        function validateBookingTime() {
            const startTime = document.getElementById('start_time').value;
            const endTime = document.getElementById('end_time').value;

            if (startTime && endTime) {
                // Periksa apakah waktu yang diminta sudah terpakai
                const isTimeBooked = checkIfTimeIsBooked(startTime, endTime);

                if (isTimeBooked) {
                    alert("The selected time is already booked. Please choose another time.");
                    document.getElementById('end_time').value = '';
                }
            }
        }

        // Simpan data waktu yang sudah terpakai dari server dalam variabel
        const bookedTimes =
            @json($bookedTimes); // Pastikan Anda sudah mengirim data waktu yang sudah terpakai dari server

        function checkIfTimeIsBooked(startTime, endTime) {
            for (const bookedTime of bookedTimes) {
                const bookedStartTime = bookedTime.start_time;
                const bookedEndTime = bookedTime.end_time;

                if (isTimeOverlap(startTime, endTime, bookedStartTime, bookedEndTime)) {
                    return true; // Waktu yang diminta sudah terpakai
                }
            }
            return false; // Waktu yang diminta belum terpakai
        }

        function isTimeOverlap(startTime1, endTime1, startTime2, endTime2) {
            const start1 = new Date(`2000-01-01 ${startTime1}`);
            const end1 = new Date(`2000-01-01 ${endTime1}`);
            const start2 = new Date(`2000-01-01 ${startTime2}`);
            const end2 = new Date(`2000-01-01 ${endTime2}`);

            return (start1 < end2 && end1 > start2); // Cek apakah waktu tumpang tindih
        }
    </script>

    <!-- ... kode selanjutnya ... -->

    <script>
        document.getElementById('booking_duration').addEventListener('input', updateEndTime);
        document.getElementById('start_time').addEventListener('input', updateEndTime);

        function updateEndTime() {
            const bookingDuration = parseInt(document.getElementById('booking_duration').value) || 0;
            const startTime = document.getElementById('start_time').value;

            if (startTime && bookingDuration) {
                const startTimeObj = new Date(`2000-01-01 ${startTime}`);
                const endTimeObj = new Date(startTimeObj.getTime() + bookingDuration * 60 * 60 * 1000);

                let endTime =
                    `${endTimeObj.getHours().toString().padStart(2, '0')}:${endTimeObj.getMinutes().toString().padStart(2, '0')}`;
                document.getElementById('end_time').value = endTime;
            } else {
                document.getElementById('end_time').value = '';
            }
        }
    </script>
    <script>
        document.getElementById('booking_duration').addEventListener('input', calculateTotalPay);
        document.getElementById('price').addEventListener('input', calculateTotalPay);

        function calculateTotalPay() {
            const bookingDuration = parseInt(document.getElementById('booking_duration').value) || 0;
            const price = parseFloat(document.getElementById('price').value) || 0;

            const totalPay = bookingDuration * price;
            document.getElementById('total_pay').value = totalPay;
        }
    </script>
</x-app-layout>
