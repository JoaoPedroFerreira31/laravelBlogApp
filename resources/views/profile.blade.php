<x-app-layout>
    <div x-data="profileData()" class="mx-auto max-w-7xl sm:px-6 lg:px-8" x-cloak>
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
                            <h1 class="mr-1 font-bold text-center text-gray-900" x-text="user.first_name && user.last_name ? user?.first_name + ' ' + user?.last_name : user.name"></h1>
                            <svg @click="navigateTo('/profile/'+user_id+'/settings')" x-tooltip="ttp_profile_settings" x-show="user_id === user.id" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:opacity-50 hover:cursor-pointer focus:ring-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span x-if="user?.first_name && user?.last_name" x-text="'@'+user.name" class="text-sm font-semibold text-center text-gray-500 "></span>
                        <div class="inline-flex justify-center w-full mt-1 gap-x-2">
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

                {{-- Personal information --}}
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col w-full">
                        <div class="flex flex-wrap justify-between mb-2">
                            <div class="flex flex-col">
                                <h1 class="text-lg font-bold text-gray-900">@lang('personal_information')</h1>
                            </div>
                        </div>
                        <dl>
                            <div class="flex justify-between px-2 py-2">
                                <div class="flex-col">
                                    <dt class="text-sm font-bold">@lang('first_name')</dt>
                                    <dd class="mt-1 text-sm text-gray-900" x-text="user?.first_name"></dd>
                                </div>

                                <div class="flex-col text-right">
                                    <dt class="text-sm font-bold">@lang('last_name')</dt>
                                    <dd class="mt-1 text-sm text-gray-900" x-text="user?.last_name"></dd>
                                </div>
                            </div>
                            <div class="flex justify-between px-2 py-2">
                                <div class="flex-col">
                                    <dt class="text-sm font-bold">@lang('date_of_birth')</dt>
                                    <dd class="mt-1 text-sm text-gray-900" x-text="user?.dob ?? '--'"></dd>
                                </div>
                                <div class="flex-col text-right">
                                    <dt class="text-sm font-bold">@lang('country')</dt>
                                    <dd class="mt-1 text-sm text-gray-900" x-text="user?.country ?? '--'"></dd>
                                </div>
                            </div>
                            <div class="flex justify-between px-2 py-2">
                                <div class="flex-col">
                                    <dt class="text-sm font-bold">@lang('company')</dt>
                                    <dd class="mt-1 text-sm text-gray-900" x-text="user?.company ?? '--'"></dd>
                                </div>
                                <div class="flex-col text-right">
                                    <dt class="text-sm font-bold">@lang('website')</dt>
                                    <dd class="mt-1 text-sm text-gray-900 hover:cursor-pointer hover:opacity-80" x-text="user?.website ?? '--'" @click="user.website ? navigateTo(user.website) : null"></dd>
                                </div>
                            </div>
                            <div class="px-2 py-2">
                                <dt class="text-sm font-bold">@lang('description')</dt>
                                <dd class="mt-1 text-sm text-gray-900" x-text="user?.description ?? '--'"></dd>
                            </div>
                        </dl>
                    </div>
                </div>

                {{-- Followers section --}}
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
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
                </div>


                {{-- Followings section --}}
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
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
                                <button type="button" x-text="Lang.get('strings.unfollow')" x-show="user_id === user.id" @click.prevent="toggleFollowUser(`${following.id}`)" class="inline-flex items-center px-4 py-1.5 text-xs font-semibold tracking-widest text-black transition duration-150 ease-in-out border-2 border-gray-300 rounded-md hover:bg-gray-200 active:bg-gray-200 focus:outline-none focus:border-gray-500 disabled:opacity-25" > --}}
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

            </section>

            {{-- Page content --}}
            <section class="lg:col-span-2">
                {{-- Loading placeholder --}}
                <div x-show="isLoading" class="p-6 mx-auto border rounded-md shadow">
                    <div class="flex space-x-4 animate-pulse">
                        <div class="w-10 h-10 rounded-full bg-slate-300"></div>
                        <div class="flex-1 py-1 space-y-6">
                            <div class="h-2 rounded bg-slate-300"></div>
                            <div class="space-y-3">
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="h-2 col-span-2 rounded bg-slate-300"></div>
                                    <div class="h-2 col-span-1 rounded bg-slate-300"></div>
                                </div>
                                <div class="h-2 rounded bg-slate-300"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Posts --}}
                <template x-for="post in user.posts" :key="post.id">
                    <div class="flex justify-center w-full">
                        <div class="w-full px-6 py-4 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg hover:shadow-xl hover:cursor-pointer">
                            <div class="inline-flex justify-between w-full">
                                <div @click="navigateTo('/posts/'+post.id)" class="w-8/12">
                                    <h1 class="font-bold text-gray-900" x-text="post.title"></h1>
                                </div>
                                <div class="flex-col w-4/12 text-right">
                                    <div class="inline-flex">
                                        <a type="button" @click="navigateTo(`/profile/`+post.author)" class="text-sm text-gray-500 hover:cursor-pointer hover:text-gray-300" x-text="post.authorName"></a>
                                        <x-dropdown align="rigth" width="48">
                                            <x-slot name="trigger">
                                                <button x-show="post.author === user_id" x-tooltip="ttp_tools" type="button" class="inline-flex items-center ml-1 text-sm font-light text-gray-500 hover:border-gray-300 focus:border-gray-300 hover:bg-gray-200">
                                                    <x-fas-ellipsis-v class="w-4 h-4"/>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                <!-- Dropdown menu -->
                                                <ul class="py-1 text-gray-800" aria-labelledby="dropdownButton">
                                                    <li>
                                                        <span @click.prevent="editPost(`${post.id}`)" class="block px-4 py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                            @lang('edit_post')
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span @click.prevent="deletePost(`${post.id}`)" class="block px-4 py-2 text-sm text-red-600 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                            @lang('delete_post')
                                                        </span>
                                                    </li>
                                                </ul>
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                </div>
                            </div>
                            <div @click="navigateTo('/posts/'+post.id)" class="h-20 mt-2 overflow-hidden">
                                <p class="text-sm text-gray-500" x-text="post?.content"></p>
                            </div>
                            <div :class="post.created_at !== post.updated_at ? 'flex justify-between w-full mt-2' : 'flex justify-end w-full mt-2'">
                                <span class="text-xs text-gray-500 whitespace-nowrap" x-text="Lang.get('strings.published_at')+': '+ date_short(post.created_at)"></span>
                                <span x-tooltip="date_readable(post.updated_at)" x-show="post.created_at !== post.updated_at" class="text-xs text-gray-500 cursor-pointer">*@lang('edited')</span>
                            </div>
                            <hr class="mt-1 text-gray-500 border-1">
                            {{-- Post buttons --}}
                            <div class="flex flex-wrap justify-start w-full gap-3 mt-2">
                                <span class="inline-flex items-center">
                                    <x-fas-comment class="w-4 h-4 text-gray-300"/>
                                    <span class="ml-1 text-sm text-gray-400" x-text="post.comments_count">0</span>
                                </span>
                                <span class="inline-flex items-center">
                                    <x-fas-heart class="w-4 h-4 text-gray-300"/>
                                    <span class="ml-1 text-sm text-gray-400" >0</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </template>
            </section>

        </div>

        <x-modals.crud-post/>

    </div>
</div>
</x-app-layout>
<script>
    let backendRecord = @json($user);

    function profileData() {
        return {
            ttp_tools: Lang.get('strings.options'),
            ttp_profile_settings: Lang.get('strings.profile_settings'),
            authHasFollowedRequestProfileUser: null,
            authIsFollowingProfileUser: null,
            isShowingPendingRequests: false,
            isCrudPostModalOpen: false,
            isPostEditing: false,
            editPostID: null,
            isLoading: true,
            postForm: {
                title: null,
                content: null,
                author: user_id,
            },
            posts: [],
            userPosts: [],
            filteredPosts: [],
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

                this.isLoading = false;

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
            editPost(record_id){
                console.log("edit",record_id);

                this.isPostEditing = true;
                this.editPostID = record_id;
                let post = this.user.posts.find(post => post.id === record_id);

                this.postForm.title = post.title;
                this.postForm.content = post.content;

                this.isCrudPostModalOpen = true;
            },
            isDeletePopUpOpen: false,
            isPostDeleting: false,
            postToDelete: null,
            deletePost(record_id){
                this.isPostDeleting = true;
                this.postToDelete = record_id;
                this.isDeletePopUpOpen = true;
            },
            filter(type) {
                switch(type) {
                    case 'all_posts':
                        this.filteredPosts = this.posts;
                        this.filterName = 'all_posts';
                        break;
                    case 'user_posts':
                        this.filteredPosts = this.userPosts;
                        this.filterName = 'user_posts';
                        break;
                }
            },
            deleteData() {
                if (this.isPostDeleting && this.postToDelete !== null) {
                    axios.delete('/api/posts/' + this.postToDelete)
                        .then(response => {
                            notyf.success('Deleted successfully!');
                            this.postToDelete = null;
                            this.isPostDeleting = false;
                            this.isDeletePopUpOpen = false;
                            this.fetchData();
                        })
                        .catch((error) => console.log(error.message));
                }
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
