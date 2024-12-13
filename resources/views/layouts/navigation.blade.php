<nav x-data="{ open: false, profileDropdownOpen: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">  <!-- Align items vertically in the container -->
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">  <!-- Link to the home page -->
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="block h-9 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">  <!-- Add items-center to align content -->
                    <!-- Common links for all users -->
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        Home
                    </x-nav-link>

                    <x-nav-link :href="route('clubs.discover')" :active="request()->routeIs('clubs.discover')">
                        Discover Clubs
                    </x-nav-link>
                    

                    @if(Auth::check())  <!-- User is logged in -->
                        <!-- Common links for logged-in users -->
                        
                        @if(Auth::user()->role == 1)  <!-- Role 1: Regular User -->
                        <x-nav-link :href="route('clubs.my')" :active="request()->routeIs('clubs.my')">
                            My Clubs
                        </x-nav-link>  

                        @elseif(Auth::user()->role == 2)  <!-- Role 2: Club Owner -->
                            <x-nav-link :href="route('clubowner.dashboard')" :active="request()->routeIs('clubowner.dashboard')">
                                Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('clubs.register')" :active="request()->routeIs('clubs.register')">
                                Register Club
                            </x-nav-link>
                            <x-nav-link :href="route('events.create')" :active="request()->routeIs('events.create')">
                                Create Event
                            </x-nav-link>
                            <x-nav-link :href="route('equipment.book')" :active="request()->routeIs('equipment.book')">
                                Equipment Booking
                            </x-nav-link>
                            
                        @endif

                        <!-- Profile Dropdown -->
                        <div class="relative inline-flex items-center">
                            <button @click="profileDropdownOpen = !profileDropdownOpen" class="flex items-center text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                                Profile
                                <svg class="h-5 w-5 inline ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div x-show="profileDropdownOpen" @click.away="profileDropdownOpen = false" class="absolute left-0 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-20 mt-2" style="top: 100%; padding-top: 10px;">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Edit Profile
                                </a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Log Out
                                </a>
                            </div>
                        </div>

                        <!-- Hidden logout form for the logout link -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    @else  <!-- User is not logged in -->
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            Login
                        </x-nav-link>
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            Register
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Hamburger for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Repeat the same links for the responsive menu -->
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                Home
            </x-responsive-nav-link>

            @if(Auth::check())
                <!-- Common links for logged-in users -->
                <x-responsive-nav-link :href="route('clubs.discover')" :active="request()->routeIs('clubs.discover')">
                    Discover Clubs
                </x-responsive-nav-link>

                @if(Auth::user()->role == 1)
                    <x-responsive-nav-link :href="route('clubs.my')" :active="request()->routeIs('clubs.my')">
                        My Clubs
                    </x-responsive-nav-link>
                @elseif(Auth::user()->role == 2)
                    <x-responsive-nav-link :href="route('clubs.register')" :active="request()->routeIs('clubs.register')">
                        Register Club
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('events.create')" :active="request()->routeIs('events.create')">
                        Create Event
                    </x-responsive-nav-link>
                @endif

                <!-- Profile and Logout -->
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    Profile
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('logout')" :active="request()->routeIs('logout')" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Log Out
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    Login
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    Register
                </x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>
