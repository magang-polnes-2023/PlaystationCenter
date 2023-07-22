<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
            Order Transaction
        </h2>
    </x-slot>
    <div class="my-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center items-center">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 px-12 mb-5">
                    <h1 class="text-center font-bold pb-1 text-2xl text-green-500">Transaction Information!</h1>
                    <p class="pb-5 text-center">Pembayaran anda berstatus Pending <span
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
                        <div>: <span class="text-green-600 font-semibold">{{ $booking->status }}</span></div>
                    </div>
                    <p class="py-2 text-center text-gray-600 italic">Keterangan: Silahkan melakukan pembayaran jika belum melakukan pembayaran <span
                            class="font-bold text-black">qris</span> pada gambar dibawah ini dan menguploadnya di
                        history order!</p>
                    <div class="flex justify-center items-center mb-4">
                        <img src="{{ asset('assets/images/qris.jpg') }}" alt="" width="350px" class="mx-auto">
                    </div>
                    <a href="/order" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
