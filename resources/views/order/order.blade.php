<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Order History
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container mx-auto mt-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="table-auto w-11/12 mx-auto my-10">
                        @if (Session::has('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                role="alert">
                                <strong class="font-bold">Error!</strong>
                                <span class="block sm:inline">{{ Session::get('error') }}</span>
                            </div>
                        @endif
                        <!-- Jika berhasil -->
                        @if (Session::has('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                                role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{ Session::get('success') }}</span>
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th class="border px-auto py-2">No</th>
                                <th class="border px-auto py-2">Booking Code</th>
                                <th class="border px-auto py-2">Name</th>
                                <th class="border px-auto py-2">Playstation</th>
                                <th class="border px-auto py-2">Date</th>
                                <th class="border px-auto py-2">Duration</th>
                                <th class="border px-auto py-2">Start Time</th>
                                <th class="border px-auto py-2">End Time</th>
                                <th class="border px-auto py-2">Order Proofen</th>
                                <th class="border px-auto py-2">Status</th>
                                <th class="border px-auto py-2">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($booking as $book)
                                <tr>
                                    <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $book->booking_code }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $book->user->name }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $book->playstation->name }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $book->booking_date }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $book->booking_duration }} jam</td>
                                    <td class="border px-4 py-2 text-center">{{ $book->start_time }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $book->end_time }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <!-- File Upload Form -->
                                        @if ($book->payment)
                                            <!-- Tampilkan gambar payment jika ada -->
                                            <img src="{{ asset('storage/' . $book->payment) }}" width="100"
                                                height="100" class="mx-auto">
                                        @else
                                            <form action="{{ route('upload', ['id' => $book->id]) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="playstation_id"
                                                    value="{{ $book->playstation->id }}" required>
                                                <input type="hidden" name="user_id" value="{{ $book->user->id }}"
                                                    required>
                                                <input type="hidden" name="booking_code"
                                                    value="{{ $book->booking_code }}" required>
                                                <input type="hidden" name="booking_date"
                                                    value="{{ $book->booking_date }}" required>
                                                <input type="hidden" name="booking_duration"
                                                    value="{{ $book->booking_duration }}" required>
                                                <input type="hidden" name="start_time" value="{{ $book->start_time }}"
                                                    required>
                                                <input type="hidden" name="end_time" value="{{ $book->end_time }}"
                                                    required>
                                                <input type="hidden" name="total_pay" value="{{ $book->total_pay }}"
                                                    required>
                                                <div class="flex gap-4">
                                                    <div class="mb-4 flex-1">
                                                        <input type="file" name="payment" id="payment"
                                                            class="rounded-md p-2 w-full" required>
                                                        @error('payment')
                                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <button type="submit"
                                                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-4 rounded">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                                @if ($errors->any())
                                                    <div class="mt-4 bg-red-200 text-red-700 p-2 rounded">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </form>
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2 text-center">{{ $book->status }}</td>
                                    <td class="border px-4 py-2">
                                        @if ($book->payment)
                                            <a href="{{ route('order.view', ['id' => $book->id]) }}"
                                                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">View</a>
                                        @else
                                            <div class="flex">
                                                <a href="{{ route('order.view', ['id' => $book->id]) }}"
                                                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-1 px-4 rounded mr-3">View</a>
                                                <!-- Form untuk menghapus data booking -->
                                                <form id="delete-form"
                                                    action="{{ route('order.delete', ['id' => $book->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirmDelete()"
                                                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-4 rounded">Hapus</button>
                                                </form>

                                                <!-- JavaScript untuk konfirmasi sebelum menghapus -->
                                                <script>
                                                    function confirmDelete() {
                                                        var result = confirm("Are you sure you want to delete this booking?");
                                                        return result; // akan return true jika user menekan OK, dan false jika user menekan Cancel
                                                    }
                                                </script>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
