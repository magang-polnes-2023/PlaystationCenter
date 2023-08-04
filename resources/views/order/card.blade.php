<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-black leading-tight">
            Order Transaction
        </h2>
    </x-slot>
    <div class="mt-7 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center items-center">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 px-12 mb-5">
                    <h1 class="text-center font-bold pb-1 text-2xl">Transaction Information!</h1>
                    <p class="pb-5 text-center">Pembayaran anda berstatus <span
                            class="font-bold">{{ $booking->status }}</span></p>
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="font-bold">Booking Code</div>
                        <div>: {{ $booking->booking_code }}</div>
                        <div class="font-semibold">Order Name</div>
                        <div>: {{ auth()->user()->name }}</div>
                        <div class="font-semibold">Booking Duration</div>
                        <div>: {{ $booking->booking_duration }} jam</div>
                        <div class="font-semibold">Start Time</div>
                        <div>: {{ $booking->start_time }}</div>
                        <div class="font-semibold">End Time</div>
                        <div>: {{ $booking->end_time }}</div>
                        <div class="font-semibold">Total Pay</div>
                        <div>: {{ $booking->total_pay }}</div>
                        <div class="font-semibold">Status</div>
                        <div>: <span class="font-semibold">{{ $booking->status }}</span></div>
                    </div>
                    @if ($booking->payment)
                        @if ($booking->status == 'Belum dibayar')
                            <p class="pb-2 text-center text-gray-600 italic">Keterangan: Silahkan menunggu response
                                admin jika anda suda
                                melakukan pembayaran</p>
                            <div class="flexjustify-center items-center pt-2">
                                <img src="{{ asset('storage/' . $booking->payment) }}" alt="" width="350px"
                                    class="mx-auto">
                            </div>
                            <p class="pb-6 text-center text-black italic">bukti pembayaran</p>
                        @endif
                        @if ($booking->status == 'Sudah dibayar')
                            <p class="py-2 text-center text-gray-600 italic">Keterangan: Anda sudah melakukan
                                pembayaran
                                <span class="font-bold text-black">qris</span> silahkan datang tepat waktu!
                            </p>
                            <p class="text-center text-gray-600 italic">Jika anda ingin membatalkan pesanan maka
                                hubungi admin <span class="font-bold text-black">089603874890</span> di nomor wa
                                tersebut!
                            </p>
                            <div class="flexjustify-center items-center pt-2">
                                <img src="{{ asset('storage/' . $booking->payment) }}" alt="" width="350px"
                                    class="mx-auto">
                            </div>
                            <p class="pb-6 text-center text-black italic">bukti pembayaran</p>
                        @endif
                        @if ($booking->status == 'Digunakan')
                            <p class="pb-2 text-center text-gray-600 italic font-semibold">Keteranga: Anda sedang
                                memainkan
                                playstation yang anda booking
                            </p>
                            <div class="flexjustify-center items-center pt-2">
                                <img src="{{ asset('storage/' . $booking->payment) }}" alt="" width="350px"
                                    class="mx-auto">
                            </div>
                            <p class="pb-6 text-center text-black italic">bukti pembayaran</p>
                        @endif
                        @if ($booking->status == 'Selesai')
                            <p class="pb-2 text-center text-gray-600 italic font-semibold">Keterangan: Anda Telah
                                Menyelesaikan
                                booking
                            </p>
                            <div class="flexjustify-center items-center pt-2">
                                <img src="{{ asset('storage/' . $booking->payment) }}" alt="" width="350px"
                                    class="mx-auto">
                            </div>
                            <p class="pb-6 text-center text-black italic">bukti pembayaran</p>
                        @endif
                    @else
                        <div class="pt-2 pb-6">
                            <p class="text-center text-gray-600 italic">Keterangan: Silahkan melakukan pembayaran
                                jika
                                belum melakukan pembayaran <span class="font-bold text-black">qris</span> pada gambar
                                dibawah ini dan menguploadnya di
                                history order!</p>
                            <p class="text-center text-gray-600 italic">Silahkan anda melakukan pembayaran dalam waktu
                                maksimal <span class="font-bold text-black">10 menit</span> jika tidak, admin akan
                                menghapus bookingan anda!</p>
                            <p class="text-center text-gray-600 italic">Setelah melakukan pembayaran anda tidak
                                dapat menghapus bookingan yang anda buat</p>
                        </div>
                        <div class="flex justify-center items-center pb-10">
                            <img src="{{ asset('assets/images/qris.jpg') }}" alt="" width="350px"
                                class="mx-auto">
                        </div>
                    @endif
                    <a href="/order"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
