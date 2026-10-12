<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200/50 dark:border-emerald-800/50 text-emerald-600 dark:text-emerald-400 text-xs font-bold tracking-wide uppercase mb-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Pengalaman Profesional
                </div>
                <h2 class="font-extrabold text-2xl sm:text-3xl text-slate-900 dark:text-white tracking-tight">
                    {{ __('Kelola Pengalaman Kerja') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                    {{ __('Atur dan urutkan riwayat karir profesional Anda secara drag-and-drop.') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('experience.create') }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-xs rounded-xl shadow-md shadow-emerald-500/20 transition hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('Tambah Pengalaman') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Guided Workflow Stepper -->
            <x-cv-wizard-stepper current="experience" />

            <div class="bg-white dark:bg-slate-800/90 shadow-sm border border-slate-200/80 dark:border-slate-700 rounded-3xl p-6 sm:p-8">
                <div class="flex items-center justify-between pb-5 mb-6 border-b border-slate-100 dark:border-slate-700/80">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">Daftar Pengalaman Kerja</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Tarik ikon <span class="font-bold text-slate-700 dark:text-slate-300">⋮⋮</span> untuk mengubah urutan tampilan pada dokumen CV.</p>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-950/60 text-emerald-700 dark:text-emerald-300 text-xs font-bold border border-emerald-200/50 dark:border-emerald-800/50">
                        {{ $experiences->count() }} Data
                    </span>
                </div>

                @if ($experiences->isEmpty())
                    <div class="text-center py-12 px-4">
                        <div class="w-16 h-16 rounded-2xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-500 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">Belum Ada Pengalaman Kerja</h3>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1 max-w-sm mx-auto">Tampilkan portofolio karir Anda agar perekrut dapat melihat rekam jejak profesional Anda.</p>
                        <div class="mt-6">
                            <a href="{{ route('experience.create') }}" class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Tambah Pengalaman Sekarang
                            </a>
                        </div>
                    </div>
                @else
                    <div class="space-y-3" x-data="sortableList('{{ route('experience.reorder') }}')">
                        @foreach ($experiences as $exp)
                            <div data-id="{{ $exp->id }}" class="flex flex-col sm:flex-row sm:items-center justify-between p-4 sm:p-5 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 bg-slate-50/60 dark:bg-slate-900/40 hover:border-emerald-400 dark:hover:border-emerald-500 hover:bg-white dark:hover:bg-slate-800 transition duration-200 group shadow-xs">
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
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h4 class="text-base font-extrabold text-slate-900 dark:text-white">{{ $exp->position }}</h4>
                                            @if ($exp->is_current)
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950/70 dark:text-emerald-300">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Saat ini
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-xs font-bold text-emerald-600 dark:text-emerald-400 mt-0.5">{{ $exp->company_name }}</div>
                                        <div class="text-[11px] text-slate-400 dark:text-slate-500 mt-1 flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span>
                                                {{ \Carbon\Carbon::parse($exp->start_date)->translatedFormat('M Y') }} — 
                                                {{ $exp->is_current ? 'Sekarang' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('M Y') : '-') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 sm:mt-0 flex items-center gap-2 pl-9 sm:pl-0">
                                    <a href="{{ route('experience.edit', $exp) }}" class="inline-flex items-center justify-center px-3 py-1.5 rounded-xl bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 hover:border-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 text-xs font-bold shadow-xs transition" title="Edit Pengalaman">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('experience.destroy', $exp) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengalaman ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 rounded-xl bg-white dark:bg-slate-800 border border-rose-300 dark:border-rose-900/60 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-xs font-bold shadow-xs transition" title="Hapus Pengalaman">
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
