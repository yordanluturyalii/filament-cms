<div class="navbar bg-white shadow border-b px-8">
    <div class="navbar-start">
        <div class="flex-none lg:hidden">
            <button class="btn btn-square btn-ghost" wire:click="toggleDrawer">
                <x-mary-icon name="heroicon.m.bars.3" class="w-6 h-6 text-neutral-800" />
            </button>
        </div>
        <a href="{{ route('home') }}" class="text-neutral-800 font-bold text-xl" wire:navigate>
            {{ config('app.name') }}
        </a>
    </div>
    <div class="navbar-end space-x-2">
        @guest
            <a href="{{ route('login') }}" class="btn btn-primary text-white" wire:navigate>
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-secondary text-white" wire:navigate>
                Register
            </a>
        @endguest
        @auth
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component" src="{!! auth()->user()->profile_photo_url !!}" />
                    </div>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content bg-white rounded-box z-[1] mt-3 w-52 p-2 shadow">
                    <li>
                        <a wire:navigate href="{{ route('profile.show') }}" class="text-neutral-800">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a href="/admin" class="text-neutral-800">
                            Admin Panel
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post" x-data>
                            @csrf
                            <a wire:navigate.url="{{ route('logout') }}" @click.prevent="$root.submit()" class="text-neutral-800">
                                Logout
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </div>

    <x-mary-drawer wire:model="responsiveMenu" class="w-full bg-white text-neutral-800" title="SimpleCMS" separator
        with-close-button close-on-escape>
        <x-mary-menu class="p-0 m-0 text-neutral-800">
            <x-mary-menu-item href="{{ route('home') }}" label="Home" icon="heroicon.m.home" />
        </x-mary-menu>
    </x-mary-drawer>
</div>
