<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md shadow-indigo-600/25 active:scale-95 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-150']) }}>
    {{ $slot }}
</button>
