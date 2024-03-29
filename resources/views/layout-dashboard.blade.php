<div class="sticky top-0 z-10 mb-2 shadow-lg navbar bg-base-100">
    <div class="flex-1">
        <a class="text-xl btn btn-ghost" href="{{ url('/dashboard') }}">Talent Insider</a>
    </div>
    <div class="flex-none gap-2">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img alt="Tailwind CSS Navbar component"
                        src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                </div>
            </div>
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                <li><a href="{{ url('/logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
