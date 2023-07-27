<x-app-layout>
    <div>
        <x-slot name="header">
            <h2 class="font-bold text-2xl text-black leading-tight text-center">
                Choose your Playstation!
            </h2>
        </x-slot>
        <div class="my-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white bg-opacity-80 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-black">
                        <h1 class="text-center text-xl font-semibold pb-2">Website Booking Playstation</h1>
                        <p class="text-center">Menyediakan layanan untuk booking secara online dengan menggunkaan website
                        </p>
                        <p class="text-center">Silahkan pilih playstations yang akan kalian mainkan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap items-center gap-7 pb-12">
            @foreach ($playstation as $ps)
                @if ($ps->status === 'tersedia')
                    <div x-data="{ 'isModalOpen': false }" x-on:keydown.escape="isModalOpen=false"
                        class="max-w-xl mx-auto sm:max-w-md md:max-w-xs bg-white bg-opacity-80 rounded-lg shadow-md">
                        <img src="{{ asset('storage/' . $ps->image) }}"
                            class="w-full h-32 sm:h-40 object-cover rounded-t-lg">
                        <div class="p-4">
                            <h5 class="font-bold text-2xl">{{ $ps->name }}</h5>
                            <p class="text-gray-600 mt-2">Rp.{{ $ps->price }}/jam</p>
                            <button x-on:click="isModalOpen = true"
                                class="mt-4 inline-block px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800">View</button>
                        </div>
                        <!-- Modal -->
                        <div x-show="isModalOpen" x-on:click.away="isModalOpen = false" x-cloak x-transition
                            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
                            <div class="bg-white rounded-lg p-4 w-full sm:w-96">
                                <h2 class="text-lg font-semibold mb-2 text-center">{{ $ps->name }}</h2>
                                <img src="{{ asset('storage/' . $ps->image) }}"
                                    class="w-full h-32 sm:h-40 object-cover rounded-t-lg">
                                <p class="text-gray-700 mb-2">Rp.{{ $ps->price }}/jam</p>
                                <p class="text-black mb-2 font-semibold">Type : {{ $ps->playstation_type }}</p>
                                <ul class="text-black mb-2">
                                    <p class="font-semibold">List Game</p>
                                    @php
                                        $gameNames = $ps->listgame->pluck('name')->toArray();
                                        $gamesText = implode(', ', $gameNames);
                                    @endphp
                                    <li>{{ $gamesText }}</li>
                                </ul>

                                <p class="text-black mb-4 text-center font-semibold italic">{{ $ps->desc }}</p>
                                <button x-on:click="isModalOpen = false"
                                    class="inline-block px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-900">Close</button>
                                @if (Auth::check())
                                    <a href="{{ route('booking', ['id' => $ps->id]) }}"
                                        class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-900">Booking</a>
                                @else
                                    <a onclick="checkIfLoggedIn()"
                                        class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-900">Booking</a>
                                    <script>
                                        function checkIfLoggedIn() {
                                            var userLoggedIn = false;

                                            if (userLoggedIn) {
                                                window.location.href = "/register";
                                            } else {
                                                var confirmation = confirm("You must login or register to place an order.");

                                                if (confirmation) {
                                                    window.location.href = "/register";
                                                } else {}
                                            }
                                        }
                                    </script>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
