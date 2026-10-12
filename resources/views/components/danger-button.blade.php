<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md shadow-red-600/20 active:scale-95 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-150']) }}>
    {{ $slot }}
</button>
