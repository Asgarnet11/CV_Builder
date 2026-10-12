<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-violet-50 dark:bg-violet-950/60 border border-violet-200/50 dark:border-violet-800/50 text-violet-600 dark:text-violet-400 text-xs font-bold tracking-wide uppercase mb-1">
                    <span class="w-2 h-2 rounded-full bg-violet-500"></span>
                    Akademik & Studi
                </div>
                <h2 class="font-extrabold text-2xl sm:text-3xl text-slate-900 dark:text-white tracking-tight">
                    {{ __('Kelola Riwayat Pendidikan') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                    {{ __('Atur urutan dan data latar belakang studi akademik Anda.') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('education.create') }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white font-bold text-xs rounded-xl shadow-md shadow-violet-500/20 transition hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('Tambah Pendidikan') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Guided Workflow Stepper -->
            <x-cv-wizard-stepper current="education" />

            <div class="bg-white dark:bg-slate-800/90 shadow-sm border border-slate-200/80 dark:border-slate-700 rounded-3xl p-6 sm:p-8">
                <div class="flex items-center justify-between pb-5 mb-6 border-b border-slate-100 dark:border-slate-700/80">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">Daftar Riwayat Pendidikan</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Tarik ikon <span class="font-bold text-slate-700 dark:text-slate-300">⋮⋮</span> untuk mengatur prioritas urutan tampil pada CV.</p>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-violet-50 dark:bg-violet-950/60 text-violet-700 dark:text-violet-300 text-xs font-bold border border-violet-200/50 dark:border-violet-800/50">
                        {{ $education->count() }} Data
                    </span>
                </div>

                @if ($education->isEmpty())
                    <div class="text-center py-12 px-4">
                        <div class="w-16 h-16 rounded-2xl bg-violet-50 dark:bg-violet-950/50 text-violet-500 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">Belum Ada Riwayat Pendidikan</h3>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1 max-w-sm mx-auto">Tambahkan sekolah, perguruan tinggi, maupun pelatihan formal yang pernah Anda tempuh.</p>
                        <div class="mt-6">
                            <a href="{{ route('education.create') }}" class="inline-flex items-center px-4 py-2.5 bg-violet-600 hover:bg-violet-700 text-white font-bold text-xs rounded-xl shadow-md transition">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Tambah Pendidikan Sekarang
                            </a>
                        </div>
                    </div>
                @else
                    <div class="space-y-3" x-data="sortableList('{{ route('education.reorder') }}')">
                        @foreach ($education as $edu)
                            <div data-id="{{ $edu->id }}" class="flex flex-col sm:flex-row sm:items-center justify-between p-4 sm:p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 bg-slate-50/60 dark:bg-slate-900/40 hover:border-violet-400 dark:hover:border-violet-500 hover:bg-white dark:hover:bg-slate-800 transition duration-200 group shadow-xs">
                                <div class="flex items-center gap-3.5">
                                    <div class="drag-handle cursor-grab active:cursor-grabbing p-1.5 rounded-lg text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 hover:bg-slate-200/60 dark:hover:bg-slate-700 transition" title="Tahan & geser untuk mengubah urutan">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="9" cy="6" r="1.5" fill="currentColor"></circle>
                                            <circle cx="15" cy="6" r="1.5" fill="currentColor"></circle>
                                            <circle cx="9" cy="12" r="1.5" fill="currentColor"></circle>
                                            <circle cx="15" cy="12" r="1.5" fill="currentColor"></circle>
                                            <circle cx="9" cy="18" r="1.5" fill="currentColor"></circle>
                                            <circle cx="15" cy="18" r="1.5" fill="currentColor"></circle>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-base font-extrabold text-slate-900 dark:text-white">{{ $edu->institution }}</h4>
                                        <div class="text-xs font-bold text-violet-600 dark:text-violet-400 mt-0.5">{{ $edu->degree }}</div>
                                        <div class="text-[11px] text-slate-400 dark:text-slate-500 mt-1 flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span>{{ $edu->start_year }} — {{ $edu->end_year ?? 'Sekarang' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 sm:mt-0 flex items-center gap-2 pl-9 sm:pl-0">
                                    <a href="{{ route('education.edit', $edu) }}" class="inline-flex items-center justify-center px-3 py-1.5 rounded-xl bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 hover:border-violet-500 hover:text-violet-600 dark:hover:text-violet-400 text-xs font-bold shadow-xs transition" title="Edit Pendidikan">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('education.destroy', $edu) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendidikan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 rounded-xl bg-white dark:bg-slate-800 border border-rose-300 dark:border-rose-900/60 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-xs font-bold shadow-xs transition" title="Hapus Pendidikan">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Hapus
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
