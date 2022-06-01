<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-ocean-green border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-keppel active:bg-metallic-blue focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
