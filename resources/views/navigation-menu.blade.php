<div class="navbar bg-base-100">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <x-mary-icon name="heroicon.c.bars.3"  />
            </div>
            <ul tabindex="0" class="menu menu-sm bg-base-100 dropdown-content rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li><a>Homepage</a></li>
                <li><a>Portfolio</a></li>
                <li><a>About</a></li>
            </ul>
        </div>
    </div>
    <div class="navbar-center">
        <a class="btn btn-ghost text-xl">
            {{ config("app.name")}}
        </a>
    </div>
    <div class="navbar-end">
        <button class="btn btn-ghost btn-circle">
            <x-mary-icon name="heroicon.o.magnifying.glass" />
        </button>
        <button class="btn btn-ghost btn-circle">
            <div class="indicator">
                <x-mary-icon name="heroicon.o.bell" />
                <span class="badge badge-xs badge-primary indicator-item"></span>
            </div>
        </button>
    </div>
</div>
