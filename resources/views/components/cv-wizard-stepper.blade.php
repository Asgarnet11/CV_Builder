@props(['current' => 'profile'])

@php
    $user = Auth::user();
    $hasProfile = $user->cvProfile !== null;
    $expCount = $user->experiences()->count();
    $eduCount = $user->education()->count();
    $skillCount = $user->skills()->count();

    $steps = [
        [
            'id' => 'profile',
            'num' => '1',
            'name' => 'Biodata & Foto',
            'sub' => $hasProfile ? 'Lengkap' : 'Belum diisi',
            'route' => route('cv-profile.edit'),
            'done' => $hasProfile,
            'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>',
        ],
        [
            'id' => 'experience',
            'num' => '2',
            'name' => 'Pengalaman Kerja',
            'sub' => $expCount . ' Catatan',
            'route' => route('experience.index'),
            'done' => $expCount > 0,
            'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
        ],
        [
            'id' => 'education',
            'num' => '3',
            'name' => 'Pendidikan',
            'sub' => $eduCount . ' Catatan',
            'route' => route('education.index'),
            'done' => $eduCount > 0,
            'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>',
        ],
        [
            'id' => 'skills',
            'num' => '4',
            'name' => 'Keahlian & Skill',
            'sub' => $skillCount . ' Terdaftar',
            'route' => route('skills.index'),
            'done' => $skillCount > 0,
            'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>',
        ],
        [
            'id' => 'preview',
            'num' => '5',
            'name' => 'Pratinjau & Unduh',
            'sub' => 'PDF • Word • Web',
            'route' => route('cv-preview.show'),
            'done' => ($hasProfile && ($expCount > 0 || $eduCount > 0 || $skillCount > 0)),
            'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>',
        ],
    ];

    $completed = ($hasProfile ? 1 : 0) + ($expCount > 0 ? 1 : 0) + ($eduCount > 0 ? 1 : 0) + ($skillCount > 0 ? 1 : 0);
    $percent = round(($completed / 4) * 100);
@endphp

<div class="mb-8 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-3xl shadow-sm border border-slate-200/80 dark:border-slate-800/80 p-5 sm:p-6 transition-all">
    <!-- Header with progress bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
        <div>
            <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                {{ __('Alur Penyusunan CV Terstandar') }}
            </h3>
            <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">
                {{ __('Lengkapi setiap tahapan untuk menghasilkan berkas CV yang kompetitif bagi rekruter.') }}
            </p>
        </div>
        <div class="flex items-center gap-3 self-start sm:self-auto">
            <div class="w-32 sm:w-44 bg-slate-100 dark:bg-slate-800 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 via-indigo-600 to-violet-600 h-2 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
            </div>
            <span class="text-xs font-extrabold text-indigo-600 dark:text-indigo-400 min-w-[45px] text-right">
                {{ $percent }}%
            </span>
        </div>
    </div>

    <!-- Steps Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
        @foreach ($steps as $step)
            @php
                $isActive = $current === $step['id'];
            @endphp
            <a href="{{ $step['route'] }}" 
               class="group relative flex flex-col p-3.5 rounded-2xl border transition-all duration-200 hover:-translate-y-0.5 {{ $isActive 
                    ? 'bg-gradient-to-b from-indigo-50/90 to-white dark:from-indigo-950/50 dark:to-slate-900/80 border-indigo-500 shadow-md shadow-indigo-500/10 ring-2 ring-indigo-500/20' 
                    : ($step['done']
                        ? 'bg-white dark:bg-slate-900/60 border-emerald-200 dark:border-emerald-900/50 hover:border-emerald-400 hover:shadow-sm'
                        : 'bg-white dark:bg-slate-900/40 border-slate-200/80 dark:border-slate-800 hover:border-slate-300 dark:hover:border-slate-700 hover:shadow-sm') }}">
                
                <div class="flex items-center justify-between mb-2">
                    <div class="w-7 h-7 rounded-xl flex items-center justify-center transition-colors {{ $isActive 
                        ? 'bg-indigo-600 text-white shadow-sm' 
                        : ($step['done'] ? 'bg-emerald-100 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400' : 'bg-slate-100 dark:bg-slate-800 text-slate-400 group-hover:text-indigo-600') }}">
                        {!! $step['icon'] !!}
                    </div>

                    @if ($step['done'])
                        <span class="w-4 h-4 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] font-bold shadow-sm" title="Sudah terisi">✓</span>
                    @elseif ($isActive)
                        <span class="w-2 h-2 rounded-full bg-indigo-500 animate-ping"></span>
                    @else
                        <span class="w-2 h-2 rounded-full bg-slate-300 dark:bg-slate-700"></span>
                    @endif
                </div>

                <div class="font-heading font-bold text-xs {{ $isActive ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-800 dark:text-slate-200 group-hover:text-indigo-600 dark:group-hover:text-indigo-400' }}">
                    {{ $step['name'] }}
                </div>
                <span class="text-[11px] text-slate-400 dark:text-slate-500 truncate mt-0.5">
                    {{ $step['sub'] }}
                </span>
            </a>
        @endforeach
    </div>
</div>
