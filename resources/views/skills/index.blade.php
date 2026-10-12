<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-rose-50 dark:bg-rose-950/60 border border-rose-200/50 dark:border-rose-800/50 text-rose-600 dark:text-rose-400 text-xs font-bold tracking-wide uppercase mb-1">
                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                    Kompetensi & Keahlian
                </div>
                <h2 class="font-extrabold text-2xl sm:text-3xl text-slate-900 dark:text-white tracking-tight">
                    {{ __('Kelola Keahlian & Skill') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                    {{ __('Tambahkan keahlian teknis, tools, maupun soft skill dan urutkan sesuai prioritas.') }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('skills.create') }}" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 text-white font-bold text-xs rounded-xl shadow-md shadow-rose-500/20 transition hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('Tambah Keahlian') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Guided Workflow Stepper -->
            <x-cv-wizard-stepper current="skills" />

            <div class="bg-white dark:bg-slate-800/90 shadow-sm border border-slate-200/80 dark:border-slate-700 rounded-3xl p-6 sm:p-8">
                <div class="flex items-center justify-between pb-5 mb-6 border-b border-slate-100 dark:border-slate-700/80">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900 dark:text-white">Daftar Keahlian</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Tarik kartu untuk mengatur urutan penayangan skill pada berkas CV.</p>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-rose-50 dark:bg-rose-950/60 text-rose-700 dark:text-rose-300 text-xs font-bold border border-rose-200/50 dark:border-rose-800/50">
                        {{ $skills->count() }} Data
                    </span>
                </div>

                @if ($skills->isEmpty())
                    <div class="text-center py-12 px-4">
                        <div class="w-16 h-16 rounded-2xl bg-rose-50 dark:bg-rose-950/50 text-rose-500 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">Belum Ada Data Keahlian</h3>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1 max-w-sm mx-auto">Tambahkan kompetensi Anda seperti bahasa pemrograman, keahlian desain, atau bahasa asing.</p>
                        <div class="mt-6">
                            <a href="{{ route('skills.create') }}" class="inline-flex items-center px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs rounded-xl shadow-md transition">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Tambah Keahlian Sekarang
                            </a>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3.5" x-data="sortableList('{{ route('skills.reorder') }}')">
                        @foreach ($skills as $skill)
                            <div data-id="{{ $skill->id }}" class="flex items-center justify-between p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 dark:border-slate-700/80 bg-slate-50/60 dark:bg-slate-900/40 hover:border-rose-400 dark:hover:border-rose-500 hover:bg-white dark:hover:bg-slate-800 transition duration-200 group shadow-xs">
                                <div class="flex items-center gap-3">
                                    <div class="drag-handle cursor-grab active:cursor-grabbing p-1 rounded-lg text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 hover:bg-slate-200/60 dark:hover:bg-slate-700 transition" title="Tahan & geser untuk mengubah urutan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="9" cy="6" r="1.5" fill="currentColor"></circle>
                                            <circle cx="15" cy="6" r="1.5" fill="currentColor"></circle>
                                            <circle cx="9" cy="12" r="1.5" fill="currentColor"></circle>
                                            <circle cx="15" cy="12" r="1.5" fill="currentColor"></circle>
                                            <circle cx="9" cy="18" r="1.5" fill="currentColor"></circle>
                                            <circle cx="15" cy="18" r="1.5" fill="currentColor"></circle>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 dark:text-white text-sm">{{ $skill->skill_name }}</h4>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 dark:bg-rose-950/70 dark:text-rose-300 border border-rose-200/60 dark:border-rose-800/60 mt-1">
                                            {{ $skill->level }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1.5 opacity-80 group-hover:opacity-100 transition">
                                    <a href="{{ route('skills.edit', $skill) }}" class="p-1.5 text-slate-500 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition" title="Edit Keahlian">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form method="POST" action="{{ route('skills.destroy', $skill) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus keahlian ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-500 hover:text-rose-600 dark:hover:text-rose-400 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-950/40 transition" title="Hapus Keahlian">
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
