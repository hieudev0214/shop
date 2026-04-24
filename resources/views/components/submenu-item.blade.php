@props([
    'href' => '#',
    'icon' => null,
    'label' => null,
    'isActive' => false,
    'target' => '_self',
])

<li>
  <a href="{{ $href }}" target="{{ $target }}" class="submenu-link transition-all hover:scale-[105%] {{ $isActive ? 'active' : '' }}">
    <div class="flex items-start space-x-2 rtl:space-x-reverse">
      @if ($icon)
        <iconify-icon icon="{{ $icon }}" class="text-base leading-[1]"></iconify-icon>
      @endif
      <span class="leading-[1]">{{ $label }}</span>
    </div>
  </a>
</li>
