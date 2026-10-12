@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-slate-300 dark:border-slate-700/80 bg-white dark:bg-slate-900/90 text-slate-800 dark:text-slate-100 placeholder-slate-400 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 rounded-xl shadow-sm text-sm transition']) }}>
