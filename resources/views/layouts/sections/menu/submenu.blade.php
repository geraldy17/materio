<ul class="menu-sub">
  @if (isset($menu))
    @foreach ($menu as $submenu)

      {{-- Determine active menu method --}}
      @php
        $activeClass = null;
        $active = 'active open';
        $currentRouteName = Route::currentRouteName();

        if ($currentRouteName === $submenu->slug) {
          $activeClass = 'active';
        } elseif (isset($submenu->submenu)) {
          if (is_array($submenu->slug)) {
            foreach ($submenu->slug as $slug) {
              if (str_contains($currentRouteName, $slug) && strpos($currentRouteName, $slug) === 0) {
                $activeClass = $active;
              }
            }
          } else {
            if (str_contains($currentRouteName, $submenu->slug) && strpos($currentRouteName, $submenu->slug) === 0) {
              $activeClass = $active;
            }
          }
        }
      @endphp

      <li class="menu-item {{ $activeClass }}">
        <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}" 
           class="{{ isset($submenu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" 
           @if (isset($submenu->target) && !empty($submenu->target)) target="_blank" @endif>
          
          {{-- Icon --}}
          @if (isset($submenu->icon))
            <i class="{{ $submenu->icon }}"></i>
          @endif
          
          {{-- Name --}}
          <div>{{ isset($submenu->name) ? __($submenu->name) : '' }}</div>
          
          {{-- Badge --}}
          @isset($submenu->badge)
            <div class="badge bg-{{ $submenu->badge[0] }} rounded-pill ms-auto">{{ $submenu->badge[1] }}</div>
          @endisset
        </a>

        {{-- Submenu --}}
        @if (isset($submenu->submenu))
          @include('layouts.sections.menu.submenu', ['menu' => $submenu->submenu])
        @endif
      </li>

    @endforeach
  @endif
</ul>
