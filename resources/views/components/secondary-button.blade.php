<button {{ $attributes->merge(['type' => 'button', 'class' => 'px-4 py-2 bg-surface-bright border border-outline text-gray-300 rounded-btn font-semibold text-xs hover:bg-surface-container-high transition-colors']) }}>
    {{ $slot }}
</button>

