<x-app-layout>
    <div x-data="profileSettingsData()" class="mx-auto max-w-7xl sm:px-6 lg:px-8" x-cloak>
        <div class="grid w-full gap-2 mt-2 lg:grid-cols-3 sm:grid-cols-1">

            {{-- User information --}}
            <section>
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">

                    {{-- User header --}}
                    <div class="flex flex-col w-full">
                        <div class="flex flex-wrap justify-center w-full mb-2">
                            <img class="w-20 h-20 rounded-full" src="{{ asset('images\placeholder.png') }}" alt="">
                        </div>
                        <div class="inline-flex items-center justify-center w-full">
                            <h1 class="mr-1 font-bold text-center text-gray-900" x-text="user_id === user.id ? Lang.get('strings.welcome')+ ' ' + username : user.name"></h1>
                        </div>
                        <div class="inline-flex justify-center w-full gap-x-2">
                            <span class="text-sm font-bold"><span x-text="user.posts_count" class="mr-1"></span> @lang('posts')</span>
                            <span class="text-sm font-bold"><span x-text="user.followers_count" class="mr-1"></span> @lang('followers')</span>
                            <span class="text-sm font-bold"><span x-text="user.followings_count" class="mr-1"></span> @lang('followings')</span>
                        </div>

                        {{-- Follow btn --}}
                        <template x-if="user_id !== user.id">
                            <div class="flex justify-center w-full mt-1">
                                <button type="button" x-text="authHasFollowedRequestProfileUser ? Lang.get('strings.pending') : (authIsFollowingProfileUser ? Lang.get('strings.unfollow') : Lang.get('strings.follow'))" @click.prevent="toggleFollowUser(`${user.id}`)" class="inline-flex items-center px-6 py-1.5 mt-2 text-xs font-semibold tracking-widest text-black transition duration-150 ease-in-out border-2 border-gray-300 rounded-md hover:bg-gray-200 active:bg-gray-200 focus:outline-none focus:border-gray-500 disabled:opacity-25" >
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Followers section --}}
                {{-- <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col w-full">
                        <div class="flex flex-wrap justify-between">
                            <div class="flex flex-col">
                                <h1 class="text-lg font-bold text-gray-900">@lang('followers') (<span class="text-md" x-text="user.followers_count"></span>)</h1>
                                <span x-show="user.pending_requests_count > 0 && user_id === user.id" @click.prevent="isShowingPendingRequests = !isShowingPendingRequests" type="button" class="text-xs text-gray-500 hover:cursor-pointer hover:text-gray-300"><span x-text="user.pending_requests_count"></span> Pending requests</span>
                            </div>
                        </div>
                        <template x-for="pendingUser in user.pending_requests">
                            <div x-show="isShowingPendingRequests" class="inline-flex justify-between w-full mt-3">
                                <div class="flex flex-col items-center">
                                    <h6 class="text-sm font-bold hover:cursor-pointer hover:text-gray-500" @click="navigateTo(`/profile/`+pendingUser.id)" x-text="pendingUser.name"></h6>
                                </div>
                                <div class="flex flex-wrap" x-show="user_id === user.id">
                                    <x-fas-check-circle @click.prevent="acceptPendingRequest(`${pendingUser.id}`)" class="w-5 h-5 mr-2 text-green-500 cursor-pointer hover:text-green-200"/>
                                    <x-fas-times-circle @click.prevent="rejectPendingRequest(`${pendingUser.id}`)" class="w-5 h-5 text-red-500 cursor-pointer hover:text-red-200"/>
                                </div>
                            </div>
                        </template>
                        <template x-for="follower in user.followers">
                            <div x-show="!isShowingPendingRequests" class="flex justify-between w-full mt-4">
                                <div class="inline-flex items-center">
                                    <img loading="lazy" src="{{ asset('images\placeholder.png') }}" :alt="follower.name" class="w-8 h-8 mx-auto mr-2 rounded-full">
                                    <h6 class="text-sm font-bold align-middle hover:cursor-pointer hover:text-gray-500" @click="navigateTo(`/profile/`+follower.id)" x-text="follower.name"></h6>
                                </div>
                                <button type="button" x-text="Lang.get('strings.remove')" x-show="user_id === user.id" @click.prevent="removeFollower(`${follower.id}`)" class="inline-flex items-center px-4 py-1.5 text-xs font-semibold tracking-widest text-black transition duration-150 ease-in-out border-2 border-gray-300 rounded-md hover:bg-gray-200 active:bg-gray-200 focus:outline-none focus:border-gray-500 disabled:opacity-25" >
                                </button>
                            </div>
                        </template>
                    </div>
                </div> --}}


                {{-- Followings section --}}
                {{-- <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col w-full">
                        <div class="flex flex-wrap justify-between">
                            <div class="inline-flex">
                                <h1 class="text-lg font-bold text-gray-900">@lang('followings') (<span class="text-md" x-text="user.followings_count"></span>)</h1>
                            </div>
                        </div>
                        <template x-for="following in user.followings">
                            <div class="flex justify-between w-full mt-4">
                                <div class="inline-flex items-center">
                                    <img loading="lazy" src="{{ asset('images\placeholder.png') }}" :alt="following.name" class="w-8 h-8 mx-auto mr-2 rounded-full">
                                    <h6 class="text-sm font-bold align-middle hover:cursor-pointer hover:text-gray-500" @click="navigateTo(`/profile/`+following.id)" x-text="following.name"></h6>
                                </div>
                                <button type="button" x-text="Lang.get('strings.unfollow')" x-show="user_id === user.id" @click.prevent="toggleFollowUser(`${following.id}`)" class="inline-flex items-center px-4 py-1.5 text-xs font-semibold tracking-widest text-black transition duration-150 ease-in-out border-2 border-gray-300 rounded-md hover:bg-gray-200 active:bg-gray-200 focus:outline-none focus:border-gray-500 disabled:opacity-25" >
                                </button>
                            </div>
                        </template>
                    </div>
                </div> --}}

            </section>

            {{-- Page content --}}
            <section class="lg:col-span-2">
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col ">
                        <div class="inline-flex items-center justify-center w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <h1 class="ml-1 font-bold text-center text-gray-900"><span x-text="user.name"></span> profile settings page</h1>
                        </div>
                        <span x-show="user_id === user.id" class="text-sm text-center text-gray-500">Aqui nesta pagina pode gerir todo o conteudo relacionado com o seu perfil</sp>
                    </div>
                </div>

                {{-- Settings --}}
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col w-full">
                        <h1 class="font-bold text-gray-900">@lang('account_settings')</h1>
                        <span class="text-sm text-gray-400">@lang('change_your_profile_and_account_settings')</span>

                        <form class="mt-5">
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="password" name="floating_password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="password" name="repeat_password" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm password</label>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="text" name="floating_first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First name</label>
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="text" name="floating_last_name" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last name</label>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="floating_phone" id="floating_phone" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_phone" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone number (123-456-7890)</label>
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="text" name="floating_company" id="floating_company" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="floating_company" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Company (Ex. Google)</label>
                                </div>
                            </div>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </form>

                    </div>
                </div>

            </section>
        </div>
    </div>
</div>

</x-app-layout>
<script>
    let backendRecord = @json($user);

    function profileSettingsData() {
        return {
            ttp_tools: Lang.get('strings.options'),
            ttp_profile_settings: Lang.get('strings.profile_settings'),
            authHasFollowedRequestProfileUser: null,
            authIsFollowingProfileUser: null,
            isShowingPendingRequests: false,
            user: null,
            init() {
                try {
                    this.user = backendRecord;
                    this.authHasFollowedRequestProfileUser = "{{ Auth::user()->hasRequestedToFollow($user) }}";
                    this.authIsFollowingProfileUser = "{{ Auth::user()->isFollowing($user) }}";

                    console.log('profile user', this.user);
                    console.log(username+' has request to follow '+this.user.name+'?', this.authHasFollowedRequestProfileUser ? 'Yes' : 'No');
                    console.log(username+' is following '+this.user.name+'?', this.authIsFollowingProfileUser ? 'Yes' : 'No');
                } catch(err) {
                    console.log(err);
                }

                // load data from localStorage
                if (typeof Storage !== 'undefined') {
                    //User
                    localForage.getItem('user-'+this.user.id)
                    .then((value) => {
                        this.user = value;
                    })
                    .catch((err) => { console.log(err) });
                }

                console.log(user_id);

                this.fetchData();
            },
            fetchData() {

                axios.get('/api/users/'+this.user.id)
                .then((response) => {
                    console.log('user', response.data.data);
                    this.user = response.data.data;
                    saveStorage('user-'+this.user.id, response.data.data);
                }).catch((error) => {
                    console.log(error);
                });

            },
            toggleFollowUser(record_id) {
                axios.post('/api/users/toggle-follow-user/'+record_id)
                    .then(response => {
                        this.fetchData();
                        this.authHasFollowedRequestProfileUser = !this.authHasFollowedRequestProfileUser;
                        if(this.authIsFollowingProfileUser) {
                            this.authIsFollowingProfileUser = !this.authIsFollowingProfileUser;
                            this.authHasFollowedRequestProfileUser = !this.authHasFollowedRequestProfileUser;
                        }
                    })
                    .catch((error) => console.log(error.message));
            },
            acceptPendingRequest(record_id) {
                axios.post('/api/users/accept-pending-request/'+record_id)
                .then(response => {
                    this.fetchData();
                    this.isShowingPendingRequests = false;
                })
                .catch((error) => console.log(error.message));
            },
            rejectPendingRequest(record_id) {
                axios.post('/api/users/reject-pending-request/'+record_id)
                .then(response => {
                    this.fetchData();
                    this.isShowingPendingRequests = false;
                })
                .catch((error) => console.log(error.message));
            },
            removeFollower(record_id) {
                axios.post('/api/users/remove-follower/'+record_id)
                .then(response => {
                    this.fetchData();
                })
                .catch((error) => console.log(error.message));
            },
        }
    }
</script>
