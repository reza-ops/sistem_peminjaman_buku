<a class="dropdown-item" href="{{ URL::to('profile/'.Auth::user()->id.'/edit') }}">
    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
    Profile
</a>
<div class="dropdown-divider"></div>
<form method="POST" action="{{ route('logout') }}">
    @csrf

    <x-jet-dropdown-link href="{{ route('logout') }}"
             onclick="event.preventDefault();
                    this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-jet-dropdown-link>
</form>
