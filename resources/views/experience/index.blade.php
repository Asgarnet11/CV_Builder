<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                    {{ __('Kelola Pengalaman') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    {{ __('Tambahkan dan atur riwayat pengalaman kerja Anda.') }}
                </p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-sm font-medium rounded-lg transition duration-150 ease-in-out">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                {{ __('Dashboard') }}
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Guided Workflow Stepper -->
            <x-cv-wizard-stepper current="experience" />


            <div class="flex justify-end">
                <a href="{{ route('experience.create') }}" class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-md transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('Tambah Pengalaman') }}
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm border border-gray-100 dark:border-gray-700/60 rounded-2xl p-6 sm:p-8">
                @if ($experiences->isEmpty())
                    <div class="text-center py-10">
                        <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Belum ada pengalaman kerja</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Mulai tambahkan perjalanan karir Anda.</p>
                    </div>
                @else
                    <div class="space-y-4" x-data="sortableList('{{ route('experience.reorder') }}')">
                        @foreach ($experiences as $exp)
                            <div data-id="{{ $exp->id }}" class="flex flex-col sm:flex-row sm:items-center justify-between p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 hover:border-emerald-300 dark:hover:border-emerald-600 transition group">
                                <div class="flex items-center gap-3">
                                    <div class="drag-handle cursor-grab text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                                    </div>
                                    <div>
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $exp->position }}</h4>
                                    <div class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">{{ $exp->company_name }}</div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ \Carbon\Carbon::parse($exp->start_date)->translatedFormat('F Y') }} - 
                                        {{ $exp->is_current ? 'Sekarang' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('F Y') : '-') }}
                                    </div>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0 flex items-center gap-2 pl-8 sm:pl-0">
                                    <a href="{{ route('experience.edit', $exp) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form method="POST" action="{{ route('experience.destroy', $exp) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white dark:bg-gray-700 border border-red-300 dark:border-red-800 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/50 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('sortableList', (endpoint) => ({
                init() {
                    new Sortable(this.$el, {
                        handle: '.drag-handle',
                        animation: 150,
                        ghostClass: 'opacity-50',
                        onEnd: (evt) => {
                            let items = Array.from(this.$el.children);
                            let orders = items.map((item, index) => ({
                                id: item.dataset.id,
                                order_index: index
                            }));
                            
                            fetch(endpoint, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ orders: orders })
                            }).then(res => res.json()).then(data => {
                                // Optional: show toast or indication of save
                            });
                        }
                    });
                }
            }));
        });
    </script>
@endpush
