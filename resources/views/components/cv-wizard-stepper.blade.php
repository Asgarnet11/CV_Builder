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
            'name' => '1. Biodata',
            'sub' => $hasProfile ? 'Lengkap' : 'Belum diisi',
            'route' => route('cv-profile.edit'),
            'done' => $hasProfile,
            'icon' => 'user',
        ],
        [
            'id' => 'experience',
            'name' => '2. Pengalaman',
            'sub' => $expCount . ' Catatan',
            'route' => route('experience.index'),
            'done' => $expCount > 0,
            'icon' => 'briefcase',
        ],
        [
            'id' => 'education',
            'name' => '3. Pendidikan',
            'sub' => $eduCount . ' Catatan',
            'route' => route('education.index'),
            'done' => $eduCount > 0,
            'icon' => 'academic-cap',
        ],
        [
            'id' => 'skills',
            'name' => '4. Keahlian',
            'sub' => $skillCount . ' Terdaftar',
            'route' => route('skills.index'),
            'done' => $skillCount > 0,
            'icon' => 'sparkles',
        ],
        [
            'id' => 'preview',
            'name' => '5. Pratinjau & Unduh',
            'sub' => 'PDF, Word, Web',
            'route' => route('cv-preview.show'),
            'done' => ($hasProfile && ($expCount > 0 || $eduCount > 0 || $skillCount > 0)),
            'icon' => 'document-download',
        ],
    ];
@endphp

<div class="mb-8 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 p-4 sm:p-5">
    <div class="flex items-center justify-between mb-3 px-1">
        <h3 class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
            {{ __('Alur Pembuatan CV (CV Builder Stepper):') }}
        </h3>
        <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400">
            @php
                $completed = ($hasProfile ? 1 : 0) + ($expCount > 0 ? 1 : 0) + ($eduCount > 0 ? 1 : 0) + ($skillCount > 0 ? 1 : 0);
                $percent = round(($completed / 4) * 100);
            @endphp
            {{ $percent }}% Lengkap
        </span>
    </div>

    <!-- Steps Grid / Flex -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-2 sm:gap-3">
        @foreach ($steps as $step)
            @php
                $isActive = $current === $step['id'];
            @endphp
            <a href="{{ $step['route'] }}" 
               class="group relative flex flex-col p-3 rounded-xl border transition-all duration-150 {{ $isActive 
                    ? 'bg-indigo-50/80 dark:bg-indigo-950/40 border-indigo-500 ring-2 ring-indigo-500/20' 
                    : ($step['done']
                        ? 'bg-gray-50/50 dark:bg-gray-800/40 border-emerald-300/60 dark:border-emerald-800/60 hover:border-emerald-400'
                        : 'bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600') }}">
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-xs font-bold {{ $isActive ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-800 dark:text-gray-200 group-hover:text-indigo-600' }}">
                        {{ $step['name'] }}
                    </span>
                    @if ($step['done'])
                        <span class="w-4 h-4 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] shadow-sm" title="Sudah diisi">✓</span>
                    @else
                        <span class="w-2 h-2 rounded-full bg-gray-300 dark:bg-gray-600" title="Belum diisi"></span>
                    @endif
                </div>
                <span class="text-[11px] text-gray-500 dark:text-gray-400 truncate">
                    {{ $step['sub'] }}
                </span>
            </a>
        @endforeach
    </div>
</div>
