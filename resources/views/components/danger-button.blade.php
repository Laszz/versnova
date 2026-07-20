<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 bg-red-600 text-white rounded-btn font-semibold text-xs hover:bg-red-500 transition-colors']) }}>
    {{ $slot }}
</button>
