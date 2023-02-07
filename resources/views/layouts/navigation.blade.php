<nav x-data="dataNav()" class="bg-blue-400 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block w-auto h-10 text-white fill-current" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link x-tooltip="ttp_dashboard" :href="route('dashboard')" class="hover:opacity-80" :active="request()->routeIs('dashboard')">
                        <x-fas-home class="w-6 h-6 text-white "/>
                    </x-nav-link>
                    <x-nav-link x-tooltip="ttp_profile" :href="route('profile', Auth::user())" class="hover:opacity-80" :active="request()->routeIs('profile')">
                        <x-fas-user-alt class="w-5 h-5 text-white "/>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <x-fas-bell class="w-5 h-5 mr-3 text-white hover:opacity-80 hover:cursor-pointer"/>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-white transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                            <div>{{ ucfirst(Auth::user()->name) }}</div>

                            <div class="ml-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile', Auth::user())">
                            <span class="inline-flex items-center">
                                <x-fas-user-alt class="w-3 h-3 mr-3 text-gray-500 hover:text-gray-300"/>
                                <span>{{ __('profile') }}</span>
                            </span>
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile-settings', Auth::user())">
                            <span class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="items-center w-5 h-5 mr-3 text-gray-500 hover:text-gray-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ __('profile_settings') }}</span>
                            </span>
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <span class="inline-flex items-center">
                                    <x-fas-sign-out-alt class="w-4 h-4 mr-3 text-gray-500 hover:text-gray-300"/>
                                    <span>{{ __('logout') }}</span>
                                </span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

                <div class="relative inline-flex">
                    <!-- Language -->
                    <div class="" @click.away="menuToggle=false">
                        <button class="py-2 pl-5 pr-3 text-gray-500 focus:outline-none" @click.prevent="menuToggle=!menuToggle">
                            <span class="w-6 flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> <i class="mdi mdi-chevron-down"></i>
                        </button>
                        <div class="absolute right-0 w-48 mt-2 text-sm text-gray-700 origin-top-right bg-white rounded-md shadow-lg z-300" x-show="menuToggle" x-transition:enter="transition ease duration-300 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease duration-300 transform" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4">
                            <span class="absolute top-0 right-0 w-3 h-3 mr-3 -mt-1 transform rotate-45 bg-white"></span>
                            <div class="relative w-full overflow-auto bg-white rounded-md ring-1 ring-black ring-opacity-5 z-300">
                                <ul class="list-reset">
                                    @foreach (Config::get('languages') as $lang => $language)
                                        <li>
                                            <a href="{{ route('lang.switch', $lang) }}" class="flex px-4 py-2 no-underline transition-colors duration-100 hover:bg-gray-100 hover:no-underline">
                                                <span class="inline-block mr-2 flag-icon flag-icon-{{$language['flag-icon']}}"></span>
                                                <span class="inline-block">{{$language['display']}}</span>
                                                @if($lang === App::getLocale())
                                                    <span class="ml-auto text-gray-700">
                                                        <x-fas-check class="flex-shrink-0 w-4 h-4 mr-1"/>
                                                    </span>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-white transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('homepage') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile', Auth::user())" :active="request()->routeIs('profile')">
                {{ __('profile') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 border-t border-gray-200">
            <div class="space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
<script>
    function dataNav() {
        return {
            ttp_dashboard: Lang.get('strings.homepage'),
            ttp_profile: Lang.get('strings.profile'),
            open: false,
            menuToggle: false,
            init() {

            },
        }
    }
</script>
