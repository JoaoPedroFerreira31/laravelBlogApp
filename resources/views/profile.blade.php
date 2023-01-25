<x-app-layout>
    <div x-data="profilData()" class="mx-auto max-w-7xl sm:px-6 lg:px-8" x-cloak>
        <div class="grid w-full gap-2 mt-2 lg:grid-cols-3 sm:grid-cols-1">

            {{-- User information --}}
            <div>
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
                                <button type="button" x-text="authHasfollowedRequestProfileUser ? 'Pending' : (authIsFollowingProfileUser ? 'Unfollow' : 'Follow')" @click.prevent="toggleFollowUser(`${user.id}`)" class="inline-flex items-center px-6 py-1.5 mt-2 text-xs font-semibold tracking-widest text-black transition duration-150 ease-in-out border-2 border-gray-300 rounded-md hover:bg-gray-200 active:bg-gray-200 focus:outline-none focus:border-gray-500 disabled:opacity-25" >
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

            </div>

            {{-- Page content --}}
            <div class="lg:col-span-2">
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col w-full">
                        <h1 class="font-bold text-center text-gray-900">This is <span class="" x-text="user.name"></span> profile page</h1>
                        <span x-show="user_id === user.id" class="text-sm text-center text-gray-500">Aqui nesta pagina pode gerir todo o conteudo relacionado com o seu perfil</sp>
                    </div>
                </div>
                   {{-- Posts --}}
                    <template x-for="post in userPosts" :key="post.id">

                        <div class="flex justify-center w-full">
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
                                {{-- Comments --}}
                                {{-- <template x-for="comment in post.comments" :key="comment.id">
                                    <div class="w-full mt-2">
                                        <div class="flex items-center px-3 py-1 rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <div class="inline-flex justify-between w-full text-xs">
                                                <div class="inline-flex">
                                                    <span class="mr-2 font-bold" x-text="comment.user.name"></span>
                                                    <span x-text="comment?.comment"></span>
                                                </div>
                                                <span x-text="date_readable(comment?.created_at)"></span>
                                            </div>
                                        </div>
                                    </div>
                                </template> --}}

                                {{-- Add Comments --}}
                                {{-- <div class="w-full mt-2">
                                    <form @submit.prevent="saveCommentData(`${post.id}`)">
                                        <label for="chat" class="sr-only">Add a comment...</label>
                                        <div class="flex items-center px-3 py-1 rounded-lg bg-gray-50 dark:bg-gray-700">
                                            <textarea id="chat" rows="1" class="block w-full p-2 mx-4 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Add a comment..." x-model="commentForm.comment"></textarea>
                                                <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                                <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                                                <span class="sr-only">Send message</span>
                                            </button>
                                        </div>
                                    </form>
                                </div> --}}

                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    let backendRecord = @json($user);

    function profilData() {
        return {
            ttp_tools: 'Options',
            filterName: 'all_posts',
            authHasfollowedRequestProfileUser: null,
            authIsFollowingProfileUser: null,
            isShowingPendingRequests: false,
            isCrudPostModalOpen: false,
            isPostEditing: false,
            editPostID: null,
            postForm: {
                title: null,
                content: null,
                author: user_id,
            },
            commentForm: {
                post_id: null,
                user_id: user_id,
                comment: null,
            },
            posts: [],
            comments: [],
            userPosts: [],
            filteredPosts: [],
            user: null,
            init() {
                try {
                    this.user = backendRecord;
                    this.authHasfollowedRequestProfileUser = "{{ Auth::user()->hasRequestedToFollow($user) }}";
                    this.authIsFollowingProfileUser = "{{ Auth::user()->isFollowing($user) }}";

                    console.log('profile user', this.user);
                    console.log('has request to follow', this.authHasfollowedRequestProfileUser);
                    console.log('is following', this.authIsFollowingProfileUser);
                } catch(err) {
                    console.log(err);
                }

                // load data from localStorage
                if (typeof Storage !== 'undefined') {

                    //Posts
                    localForage.getItem('posts')
                    .then((value) => {
                        this.posts = value;
                        this.filteredPosts = value;
                    })
                    .catch((err) => { console.log(err) });

                    //Comments
                    localForage.getItem('comments')
                    .then((value) => {
                        this.comments = value;
                    })
                    .catch((err) => { console.log(err) });

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

                axios.get('/api/posts/')
                .then((response) => {
                    console.log('posts', response.data.data);
                    this.posts = response.data.data;
                    this.filteredPosts = response.data.data;
                    this.userPosts = this.posts.filter(post => post.author === user_id);
                    saveStorage('posts', response.data.data);
                }).catch((error) => {
                    console.log(error);
                });

                axios.get('/api/users/'+this.user.id)
                .then((response) => {
                    console.log('user', response.data.data);
                    this.user = response.data.data;
                    saveStorage('user-'+this.user.id, response.data.data);
                }).catch((error) => {
                    console.log(error);
                });

                axios.get('/api/comments/')
                .then((response) => {
                    console.log('comments', response.data.data);
                    this.comments = response.data.data;
                    saveStorage('comments', response.data.data);
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
                        this.authHasfollowedRequestProfileUser = !this.authHasfollowedRequestProfileUser;
                        if(this.authIsFollowingProfileUser) {
                            this.authIsFollowingProfileUser = !this.authIsFollowingProfileUser;
                            this.authHasfollowedRequestProfileUser = !this.authHasfollowedRequestProfileUser;
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
            clearCommentsForm() {
                this.commentForm.post_id = null;
                this.commentForm.user_id = user_id;
                this.commentForm.comment = null;
            },
            saveCommentData(record_id) {
                let post = this.posts.find(post => post.id === record_id);

                this.commentForm.post_id = post.id;

                axios.post('api/comments',this.commentForm)
                .then(response => {
                    this.clearCommentsForm();
                    this.fetchData();
                }).catch(error => {
                    console.log(error.message)
                });

            },
        }
    }
</script>
