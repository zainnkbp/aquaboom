<x-layout>
  <x-slot:title>{{ App::getLocale() === 'en' ? 'Book Tickets - Aquaboom Waterpark' : 'Pesan Tiket Online - Aquaboom Waterpark' }}</x-slot:title>

  <!-- Checkout Container -->
  <main class="flex-1 max-w-4xl mx-auto w-full p-4 md:p-8 pt-32">
      <div class="bg-white rounded-3xl shadow-xl overflow-hidden min-h-[600px]">
          @livewire('checkout')
      </div>
  </main>

</x-layout>
