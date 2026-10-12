<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-primary hover:bg-primary-dark active:bg-primary-dark text-white font-bold text-xs uppercase tracking-wider rounded-lg shadow-sm hover:shadow active:scale-95 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all duration-150']) }}>
    {{ $slot }}
</button>
