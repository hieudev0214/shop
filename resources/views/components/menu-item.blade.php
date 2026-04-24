@props([
    'href' => 'javascript:void(0)',
    'icon' => null,
    'label' => null,
    'hasSubmenu' => false,
    'isActive' => false,
    'target' => '_self',
])

<li class="menu-item-has-children {{ $isActive ? 'active' : '' }}">
  <a href="{{ $href }}" target="{{ $target }}" class="menu-link transition-all hover:scale-[105%]" @if ($hasSubmenu) aria-expanded="false" role="button" @endif>
    <div class="flex flex-1 items-center space-x-[6px] rtl:space-x-reverse">
      @if ($icon)
        <span class="icon-box">
          <iconify-icon icon="{{ $icon }}"></iconify-icon>
        </span>
      @endif
      <div class="text-box">{{ $label }}</div>
    </div>
    @if ($hasSubmenu)
      <div class="relative top-1 flex-none text-sm leading-[1] ltr:ml-3 rtl:mr-3">
        <iconify-icon icon="heroicons-outline:chevron-down"></iconify-icon>
      </div>
    @endif
  </a>

  @if ($hasSubmenu)
    <ul class="sub-menu">
      {{ $slot }}
    </ul>
  @endif
</li>
