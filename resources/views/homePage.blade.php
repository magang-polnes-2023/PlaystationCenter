<x-app-layout>
    <section class="container mx-auto py-12">
        <div class="flex flex-col-reverse md:flex-row">
            <div
                class="mx-4 md:w-1/2 text-white my-8 md:my-44 md:ml-40 animate__animated animate__fadeInUp animate__delay-1s">
                <h2 class="text-3xl md:text-5xl pb-2">Gaming</h2>
                <h1 class="font-bold text-5xl md:text-7xl pb-2">Playstation <span
                        class="animate-pulse duration-300">Center</span></h1>
                <p class="pb-3 animate__animated animate__fadeInLeft animate__delay-1s">Kami adalah layanan rental
                    PlayStation terkemuka yang menawarkan pengalaman gaming yang
                    tak terlupakan bagi para pecinta game. Di sini, Anda dapat menikmati beragam koleksi game terbaru
                    dan klasik dari berbagai genre yang dapat memuaskan hasrat gaming Anda.</p>
                <a href="/home"
                    class="bg-gray-100 hover:bg-white text-slate-900 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline block w-32 text-center mx-auto md:mx-0 md:w-auto">Booking</a>
            </div>
            <div class="md:w-1/2 mt-8 md:mt-24 animate__animated animate__zoomIn animate__delay-2s">
                <img src="{{ asset('assets/images/Playstation.png') }}" alt=""
                    class="w-52 h-auto mx-auto hover:scale-150 hover:-rotate-12 transition duration-500">
            </div>
        </div>
    </section>
    <section class="container mx-auto mt-5 pt-11 bg-white" id="listPlaystation">
        <h1 class="font-bold text-4xl pb-2 text-center text-black" data-aos="fade-down" data-aos-easing="linear"
            data-aos-duration="1500">
            List Playstation</h1>
        <h2 class="text-sm text-center text-black pb-14" data-aos="fade-down" data-aos-easing="linear"
            data-aos-duration="1500">Book your
            playstation here!</h2>
        <div class="flex flex-wrap mx-auto gap-6 pb-12 max-w-7xl" data-aos="fade-up" data-aos-easing="linear"
            data-aos-duration="2000">
            @foreach ($playstation as $ps)
                @if ($ps->status === 'tersedia')
                    <div x-data="{ 'isModalOpen': false }" x-on:keydown.escape="isModalOpen=false"
                        class="mx-auto sm:max-w-md md:max-w-xs bg-white bg-opacity-80 rounded-lg shadow-xl">
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
                                    class="w-full sm:h-full object-cover rounded-t-lg">
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
    </section>
</x-app-layout>
