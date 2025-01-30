<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full h-[60px] bg-orange-500 text-white rounded-full focus:outline-none hover:bg-orange-600']) }}>
    {{ $slot }}
</button>
