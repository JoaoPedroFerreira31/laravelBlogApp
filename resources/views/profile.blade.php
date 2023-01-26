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
                        <h1 class="font-bold text-center text-gray-900" x-text="user_id === user.id ? 'Welcome '+username : user.name"></h1>
                        <div class="inline-flex justify-center w-full gap-x-2">
                            <span class="text-sm font-bold"><span x-text="user.posts_count" class="mr-1"></span> Posts</span>
                            <span class="text-sm font-bold"><span x-text="user.followers_count" class="mr-1"></span> Followers</span>
                            <span class="text-sm font-bold"><span x-text="user.followings_count" class="mr-1"></span> Following</span>
                        </div>

                        {{-- Follow btn --}}
                        <template x-if="user_id !== user.id">
                            <div class="flex justify-center w-full mt-1">
                                <button type="button" x-text="authHasFollowedRequestProfileUser ? 'Pending' : (authIsFollowingProfileUser ? 'Unfollow' : 'Follow')" @click.prevent="toggleFollowUser(`${user.id}`)" class="inline-flex items-center px-6 py-1.5 mt-2 text-xs font-semibold tracking-widest text-black transition duration-150 ease-in-out border-2 border-gray-300 rounded-md hover:bg-gray-200 active:bg-gray-200 focus:outline-none focus:border-gray-500 disabled:opacity-25" >
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Followers section --}}
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col w-full">
                        <div class="flex flex-wrap justify-between">
                            <div class="flex flex-col">
                                <h1 class="text-lg font-bold text-gray-900">Followers (<span class="text-md" x-text="user.followers_count"></span>)</h1>
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
                                <button type="button" x-text="'Remove'" x-show="user_id === user.id" @click.prevent="removeFollower(`${follower.id}`)" class="inline-flex items-center px-4 py-1.5 text-xs font-semibold tracking-widest text-black transition duration-150 ease-in-out border-2 border-gray-300 rounded-md hover:bg-gray-200 active:bg-gray-200 focus:outline-none focus:border-gray-500 disabled:opacity-25" >
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
                                <h1 class="text-lg font-bold text-gray-900">Followings (<span class="text-md" x-text="user.followings_count"></span>)</h1>
                            </div>
                        </div>
                        <template x-for="following in user.followings">
                            <div class="flex justify-between w-full mt-4">
                                <div class="inline-flex items-center">
                                    <img loading="lazy" src="{{ asset('images\placeholder.png') }}" :alt="following.name" class="w-8 h-8 mx-auto mr-2 rounded-full">
                                    <h6 class="text-sm font-bold align-middle hover:cursor-pointer hover:text-gray-500" @click="navigateTo(`/profile/`+following.id)" x-text="following.name"></h6>
                                </div>
                                <button type="button" x-text="'Unfollow'" x-show="user_id === user.id" @click.prevent="toggleFollowUser(`${following.id}`)" class="inline-flex items-center px-4 py-1.5 text-xs font-semibold tracking-widest text-black transition duration-150 ease-in-out border-2 border-gray-300 rounded-md hover:bg-gray-200 active:bg-gray-200 focus:outline-none focus:border-gray-500 disabled:opacity-25" > --}}
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

            </section>

            {{-- Page content --}}
            <section class="lg:col-span-2">
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col w-full">
                        <h1 class="font-bold text-center text-gray-900">This is <span class="" x-text="user.name"></span> profile page</h1>
                        <span x-show="user_id === user.id" class="text-sm text-center text-gray-500">Aqui nesta pagina pode gerir todo o conteudo relacionado com o seu perfil</sp>
                    </div>
                </div>

                {{-- Loading placeholder --}}
                <div x-show="isLoading" class="p-6 mx-auto mt-2 border rounded-md shadow">
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
                    <div @click="navigateTo('/posts/'+post.id)" class="flex justify-center w-full">
                        <div class="w-full px-6 py-4 mt-3 overflow-hidden bg-white shadow-sm sm:rounded-lg hover:shadow-xl hover:cursor-pointer">
                            <div class="inline-flex justify-between w-full">
                                <div class="w-8/12">
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
                                                            Edit post
                                                        </span>
                                                    </li>
                                                    <li>
                                                        <span @click.prevent="deletePost(`${post.id}`)" class="block px-4 py-2 text-sm text-red-600 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                            Delete post
                                                        </span>
                                                    </li>
                                                </ul>
                                            </x-slot>
                                        </x-dropdown>
                                    </div>
                                </div>
                            </div>
                            <div class="h-20 mt-2 overflow-hidden">
                                <p class="text-sm text-gray-500" x-text="post?.content"></p>
                            </div>
                            <div :class="post.created_at !== post.updated_at ? 'flex justify-between w-full mt-2' : 'flex justify-end w-full mt-2'">
                                <span class="text-xs text-gray-500 whitespace-nowrap" x-text="'Publicado em: ' + date_short(post.created_at)"></span>
                                <span x-tooltip="date_readable(post.updated_at)" x-show="post.created_at !== post.updated_at" class="text-xs text-gray-500 cursor-pointer">*Editado</span>
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
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    let backendRecord = @json($user);

    function profileData() {
        return {
            ttp_tools: 'Options',
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
                const post = this.posts.find(post => post.id === record_id);

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
