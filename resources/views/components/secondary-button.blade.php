<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 border border-slate-300/80 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold text-xs uppercase tracking-wider rounded-xl active:scale-95 transition-all duration-150 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
