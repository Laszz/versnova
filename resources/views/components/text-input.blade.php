@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full bg-surface-bright border border-outline rounded-btn px-4 py-2.5 text-gray-100 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 outline-none transition-colors']) }}>

