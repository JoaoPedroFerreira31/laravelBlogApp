<x-app-layout>
    <div x-data="dashboardData()" class="mx-auto max-w-7xl sm:px-6 lg:px-8" x-cloak>
        <div class="grid w-full gap-4 mt-2 lg:grid-cols-3 sm:grid-cols-1">
            {{-- Main section --}}
            <section class="col-span-2">

                {{-- Filters --}}
                <div class="flex w-full sm:justify-center lg:justify-end">
                    <div class="inline-flex justify-between w-full max-w-lg p-3 mt-2 bg-white rounded-md gap-x-2">
                        <h1 class="text-lg font-bold">@lang('homepage')</h1>
                        <div class="inline-flex gap-2">
                            <div :class="filterName === 'all_posts' ? 'px-4 py-1 text-xs text-white bg-gray-300 border border-gray-300 rounded-md shadow-lg cursor-pointer hover:bg-gray-400 hover:shadow-none whitespace-nowrap' : 'px-4 py-1 text-xs text-white bg-blue-500 border border-blue-500 rounded-md shadow-sm cursor-pointer hover:bg-blue-400 hover:shadow-none'"  @click.prevent="filter('all_posts')"  x-text="Lang.get('strings.all_posts')"></div>
                            <div :class="filterName === 'friends_posts' ? 'px-4 py-1 text-xs text-white bg-gray-300 border border-gray-300 rounded-md shadow-lg cursor-pointer hover:bg-gray-400 hover:shadow-none whitespace-nowrap' : 'px-4 py-1 text-xs text-white bg-blue-500 border border-blue-500 rounded-md shadow-sm cursor-pointer hover:bg-blue-400 hover:shadow-none'"  @click.prevent="filter('friends_posts')"  x-text="Lang.get('strings.friends_posts')"></div>
                            <div :class="filterName === 'user_posts' ? 'px-4 py-1 text-xs text-white bg-gray-300 border border-gray-300 rounded-md shadow-lg cursor-pointer hover:bg-gray-400 hover:shadow-none whitespace-nowrap' : 'px-4 py-1 text-xs text-white bg-blue-500 border border-blue-500 rounded-md shadow-sm cursor-pointer hover:bg-blue-400 hover:shadow-none'"  @click.prevent="filter('user_posts')" x-text="Lang.get('strings.my_posts')"></div>
                        </div>
                    </div>
                </div>

                {{-- Loading placeholder --}}
                {{-- <div x-show="!isLoading" class="max-w-lg mt-2 border rounded-md shadow ">
                    <div class="flex p-6 space-x-4 animate-pulse">
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
                </div> --}}

                {{-- Posts --}}
                <template x-for="post in filteredPosts" :key="post.id">

                    <div class="flex w-full sm:justify-center lg:justify-end">
                        <div class="w-full max-w-lg px-6 py-4 mt-4 overflow-hidden bg-white shadow-sm sm:rounded-lg hover:shadow-xl hover:cursor-pointer">
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
                            <div class="h-20 mt-2 overflow-hidden" @click="navigateTo('/posts/'+post.id)">
                                <p class="text-sm text-gray-500" x-text="post?.content"></p>
                            </div>
                            <div @click="navigateTo('/posts/'+post.id)" :class="post.created_at !== post.updated_at ? 'flex justify-between w-full mt-2' : 'flex justify-end w-full mt-2'">
                                <span class="text-xs text-gray-500 whitespace-nowrap" x-text=" Lang.get('strings.published_at') +':  '+ date_short(post.created_at)"></span>
                                <span x-tooltip="date_readable(post.updated_at)" x-show="post.created_at !== post.updated_at" class="text-xs text-gray-500 cursor-pointer">*@lang('edited')</span>
                            </div>

                            <hr class="mt-1 text-gray-500 border-1">

                            {{-- Post buttons --}}
                            <div class="flex flex-wrap justify-start w-full gap-3 mt-2">
                                <span class="inline-flex items-center">
                                    <x-fas-comment @click.prevent="showCommentModal(`${post.id}`)" class="w-4 h-4 text-gray-300 hover:text-gray-500"/>
                                    <span class="ml-1 text-sm text-gray-400" x-text="post.comments_count">0</span>
                                </span>
                                <span class="inline-flex items-center">
                                    <x-fas-heart class="w-4 h-4 text-gray-300 hover:text-gray-500"/>
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
            </section>

            {{-- Right section --}}
            <section class="hidden lg:block">
                {{-- Search --}}
                <div class="relative w-full pt-2 mx-auto text-gray-600">
                    <input class="w-full h-10 px-5 pr-16 text-sm bg-white border-none rounded-lg focus:outline-none"
                      type="search" name="search" :placeholder="Lang.get('strings.search')">
                    <button type="submit" class="absolute top-0 right-0 mt-5 mr-4">
                      <svg class="w-4 h-4 text-gray-600 fill-current" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                        viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                        width="512px" height="512px">
                        <path
                          d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                      </svg>
                    </button>
                </div>

                {{-- Header --}}
                <div class="flex flex-wrap justify-center">
                    <div class="w-full max-w-lg p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div class="inline-flex items-center justify-between w-full">
                            <h1 class="text-lg font-bold text-gray-900 ">@lang('welcome') <span class="" x-text="username"></span></h1>
                            <button type="button" @click.prevent="isCrudPostModalOpen = true" class="px-4 py-1 mt-2 text-xs text-white bg-blue-500 border border-blue-500 rounded-md shadow-sm cursor-pointer hover:bg-blue-300 hover:border-blue-300">@lang('create_new_post')</button>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <x-modals.crud-post/>
        <x-modals.create-comment/>
        <x-modals.delete-pop-up/>
    </div>
</x-app-layout>
<script>
    let backendPosts = @json($posts);
    let backendUserPosts = @json($userPosts);
    let backendUserFriendsPosts = @json($userFriendsPosts);

    function dashboardData() {
        return {
            ttp_tools: Lang.get('strings.options'),
            filterName: 'all_posts',
            isCrudPostModalOpen: false,
            isCommentModalOpen: false,
            isPostEditing: false,
            editPostID: null,
            isLoading: true,
            postForm: {
                title: null,
                content: null,
                author: user_id,
            },
            // commentForm: {
            //     post_id: null,
            //     user_id: user_id,
            //     comment: null,
            // },
            posts: [],
            userPosts: [],
            friendsPosts: [],
            filteredPosts: [],
            init() {

                try {
                    this.posts = backendPosts;
                    this.userPosts = backendUserPosts;
                    this.friendsPosts = backendUserFriendsPosts;
                } catch (err) {
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

                    //Friends Posts
                    localForage.getItem('fetch-friend-posts-'+user_id)
                    .then((value) => {
                        this.friendsPosts = value;
                    })
                    .catch((err) => { console.log(err) });

                    //User Posts
                    localForage.getItem('fetch-user-posts-'+user_id)
                    .then((value) => {
                        this.userPosts = value;
                    })
                    .catch((err) => { console.log(err) });
                }

                console.log(user_id);

                this.$watch('posts', (value) => {
                    this.isLoading = false;
                });

                this.fetchData();
            },
            fetchData() {
                axios.get('api/posts/')
                .then((response) => {
                    console.log('posts', response.data.data);
                    this.posts = response.data.data;
                    this.filteredPosts = response.data.data;
                    saveStorage('posts', response.data.data);
                }).catch((error) => {
                    console.log(error);
                });

                axios.get('api/fetch-friends-posts/')
                .then((response) => {
                    console.log('friends-posts', response.data.data);
                    this.friendsPosts = response.data.data;
                    saveStorage('fetch-friend-posts-'+user_id, response.data.data);
                }).catch((error) => {
                    console.log(error);
                });

                axios.get('api/fetch-user-posts/')
                .then((response) => {
                    console.log('user-posts', response.data.data);
                    this.userPosts = response.data.data;
                    saveStorage('fetch-user-posts-'+user_id, response.data.data);
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
                    case 'friends_posts':
                        this.filteredPosts = this.friendsPosts;
                        this.filterName = 'friends_posts';
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
            selectedPost: null,
            showCommentModal(record_id) {
                this.selectedPost = this.posts.find(post => record_id === post.id);
                console.log('post selected', this.selectedPost);
                this.isCommentModalOpen = true;
            },
            // clearCommentsForm() {
            //     this.commentForm.post_id = null;
            //     this.commentForm.user_id = user_id;
            //     this.commentForm.comment = null;
            // },
            // saveCommentData(record_id) {
            //     let post = this.posts.find(post => post.id === record_id);

            //     this.commentForm.post_id = post.id;

            //     axios.post('api/comments',this.commentForm)
            //     .then(response => {
            //         this.clearCommentsForm();
            //         this.fetchData();
            //     }).catch(error => {
            //         console.log(error.message)
            //     });

            // },
        }
    }
</script>
