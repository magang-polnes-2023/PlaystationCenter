<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-black leading-tight text-center">
            Booking History
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto mt-8">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white bg-opacity-80 overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="table-auto w-11/12 mx-auto my-10 border-collapse">
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
                                <th class="border border-black px-auto py-2">No</th>
                                <th class="border border-black px-auto py-2">Booking Code</th>
                                <th class="border border-black px-auto py-2">Name</th>
                                <th class="border border-black px-auto py-2">Playstation</th>
                                <th class="border border-black px-auto py-2">Date and Time</th>
                                <th class="border border-black px-auto py-2">Order Proofen</th>
                                <th class="border border-black px-auto py-2">Status</th>
                                <th class="border border-black px-auto py-2">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($booking as $book)
                                <tr>
                                    <td class="border border-black px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                    <td class="border border-black px-4 py-2 text-center">{{ $book->booking_code }}</td>
                                    <td class="border border-black px-4 py-2 text-center">{{ $book->user->name }}</td>
                                    <td class="border border-black px-4 py-2 text-center">{{ $book->playstation->name }}
                                    </td>
                                    <td class="border border-black px-4 py-2 text-center">{{ $book->booking_date }},
                                        {{ $book->start_time }} - {{ $book->end_time }}</td>
                                    <td class="border border-black px-4 py-2 text-center align-middle">
                                        <!-- File Upload Form -->
                                        @if ($book->payment)
                                            <!-- Tampilkan gambar payment jika ada -->
                                            <img src="{{ asset('storage/' . $book->payment) }}" width="100"
                                                height="100" class="mx-auto">
                                        @elseif ($book->status == 'Cancel')
                                        @else
                                            <form action="{{ route('upload', ['id' => $book->id]) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex">
                                                    <div>
                                                        <input type="file" name="payment" id="payment"
                                                            class="rounded-md p-2 w-full" required>
                                                        @error('payment')
                                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <button type="submit" id="submit"
                                                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-4 mt-2 rounded">
                                                            Submit
                                                        </button>
                                                        <script>
                                                            document.getElementById("submit").onclick = function(event) {
                                                                if (!confirm("Apakah bukti pembayaran sudah benar?")) {
                                                                    event.preventDefault();
                                                                } else {
                                                                }
                                                            };
                                                        </script>
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
                                    <td class="border border-black px-4 py-2 text-center">{{ $book->status }}</td>
                                    <td class="border border-black px-4 py-2 text-center">
                                        @if ($book->payment)
                                            <a href="{{ route('order.view', ['id' => $book->id]) }}"
                                                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">View</a>
                                        @elseif ($book->status == 'Cancel')
                                        @else
                                            <div class="flex">
                                                <a href="{{ route('order.view', ['id' => $book->id]) }}"
                                                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-1 px-4 rounded mr-3">View</a>
                                                <form id="delete-form"
                                                    action="{{ route('order.cancle', ['id' => $book->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirmDelete()"
                                                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-4 rounded">Cancle</button>
                                                </form>

                                                <script>
                                                    function confirmDelete() {
                                                        var result = confirm("Are you sure you want to cancel this booking?");
                                                        return result;
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
