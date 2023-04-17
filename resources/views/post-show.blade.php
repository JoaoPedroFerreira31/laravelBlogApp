<x-app-layout>
    <div x-data="postData()" class="mx-auto max-w-7xl sm:px-6 lg:px-8" x-cloak>
        <div class="grid w-full gap-4 mt-2 lg:grid-cols-3 sm:grid-cols-1">
            {{-- Main section --}}
            <section class="col-span-2">

                {{-- Header --}}
                <div class="flex w-full sm:justify-center lg:justify-end">
                    <div class="inline-flex justify-between w-full max-w-lg p-3 mt-2 bg-white rounded-md gap-x-2">
                        <div class="inline-flex items-center">
                            <x-fas-arrow-left @click="navigateTo('/dashboard')" class="w-4 h-4 mr-2 text-gray-900 hover:opacity-50 hover:cursor-pointer"/>
                            <h1 class="text-lg font-bold">@lang('post')</h1>
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
                <div class="flex w-full sm:justify-center lg:justify-end">
                    <div class="w-full max-w-lg px-6 py-4 mt-4 overflow-hidden bg-white shadow-sm sm:rounded-lg hover:cursor-pointer">
                        <div class="inline-flex justify-between w-full">
                            <div class="w-8/12">
                                <h1 class="text-lg font-bold text-gray-900" x-text="post.title"></h1>
                            </div>
                            <div class="flex-col w-4/12 text-right">
                                <div class="inline-flex">
                                    <a type="button" @click="navigateTo(`/profile/`+post.author)" class="text-sm text-gray-500 hover:cursor-pointer hover:text-gray-300" x-text="post?.authorName"></a>
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
                        <div class="mt-2">
                            <p class="text-gray-500" x-text="post?.content"></p>
                        </div>
                        <div :class="post.created_at !== post.updated_at ? 'flex justify-between w-full mt-2' : 'flex justify-end w-full mt-2'">
                            <span class="text-xs text-gray-500 whitespace-nowrap" x-text="Lang.get('strings.published_at')+' '+ date_short(post.created_at)"></span>
                            <span x-tooltip="date_readable(post.updated_at)" x-show="post.created_at !== post.updated_at" class="text-xs text-gray-500 cursor-pointer">@lang('edited')*</span>
                        </div>

                        <hr class="mt-1 text-gray-500 border-1">

                        {{-- Post buttons --}}
                        <div class="flex flex-wrap justify-start w-full gap-3 my-2">
                            <span class="inline-flex items-center">
                                <x-fas-comment class="w-4 h-4 text-gray-300 hover:text-gray-500"/>
                                <span class="ml-1 text-sm text-gray-400" x-text="post.comments_count">0</span>
                            </span>
                            <span class="inline-flex items-center">
                                <x-fas-heart class="w-4 h-4 text-gray-300 hover:text-gray-500"/>
                                <span class="ml-1 text-sm text-gray-400">0</span>
                            </span>
                        </div>

                        <hr class="mt-1 text-gray-500 border-1">
                        {{-- Add new comment --}}
                        <div class="w-full my-2">
                            <form @submit.prevent="saveCommentData(`${post.id}`)" class="flex items-center px-3 py-2 bg-white rounded-lg dark:bg-gray-700">
                                <div class="inline-flex w-full overflow-hidden">
                                    <span class="p-2"><img loading="lazy" src="{{Auth::user()->image ? asset('storage'.Auth::user()->image) : asset('images\placeholder.png') }}" :alt="username" class="w-8 h-8 rounded-full"></span>
                                    <input x-model="commentForm.comment" class="w-full border-none placeholder:text-sm placeholder:font-bold placeholder:text-gray-400" :placeholder="Lang.get('strings.write_your_comment')" type="text"></input>
                                    <button type="submit" class="inline-flex items-center justify-center p-2 text-blue-600 cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                        <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                                        <span class="sr-only">@lang('comment')</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <hr class="mt-1 text-gray-500 border-1">

                        {{-- Comments --}}
                        <template x-if="post?.comments.length === 0 || !post?.comments">
                            <div class="w-full mt-2">
                                <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">
                                    <div class="inline-flex justify-between w-full">
                                        <div class="inline-flex">
                                            <span class="text-xs font-semibold text-gray-500" x-text="Lang.get('strings.no_comments_found')"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template x-for="comment in post.comments" :key="comment.id">
                            <div class="w-full mt-2">
                                <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">
                                    <div class="inline-flex justify-between w-full text-sm">
                                        <div class="inline-flex">
                                            <span @click="navigateTo('/profile/'+comment.user_id)" class="mr-2 font-bold hover:opacity-80" x-text="comment?.user?.name"></span>
                                            <span x-text="comment?.comment"></span>
                                        </div>
                                        <span x-text="date_readable(comment?.created_at)"></span>
                                    </div>
                                </div>
                            </div>
                        </template>

                    </div>
                </div>

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
                            <div class="inline-flex items-center p-2 hover:cursor-pointer" @click="navigateTo('/profile/'+post.author.id)">
                                <img loading="lazy" :src="post.author.image ? '/storage'+post.author.image : '{{ asset('images/placeholder.png')}}'" :alt="post.authorName" class="w-8 h-8 mr-2 rounded-full">
                                <h1 class="text-lg font-bold text-gray-900 hover:opacity-80" x-text="post.authorName"></h1>
                            </div>
                            <button x-show="user_id !== post.author.id" type="button" x-text="authHasFollowedRequestProfileUser ? Lang.get('strings.pending') : (authIsFollowingProfileUser ? Lang.get('strings.unfollow') : Lang.get('strings.follow'))" @click.prevent="toggleFollowUser(`${user.id}`)" class="inline-flex items-center px-6 py-1.5 mt-2 text-xs font-semibold tracking-widest text-black transition duration-150 ease-in-out border-2 border-gray-300 rounded-md hover:bg-gray-200 active:bg-gray-200 focus:outline-none focus:border-gray-500 disabled:opacity-25" >
                            </button>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <x-modals.crud-post/>
        <x-modals.delete-pop-up/>
    </div>
</x-app-layout>
<script>
    let backendRecord = @json($post);

    function postData() {
        return {
            ttp_tools: 'Options',
            isCrudPostModalOpen: false,
            authHasFollowedRequestProfileUser: false,
            authIsFollowingProfileUser: false,
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
            init() {
                try {
                    this.post = backendRecord;
                    this.authHasFollowedRequestProfileUser = "{{ Auth::user()->hasRequestedToFollow($author) }}";
                    this.authIsFollowingProfileUser = "{{ Auth::user()->isFollowing($author) }}";

                    console.log('backendRecord', this.post);
                    console.log(username+' has request to follow '+this.post.authorName+'?', this.authHasFollowedRequestProfileUser ? 'Yes' : 'No');
                    console.log(username+' is following '+this.post.authorName+'?', this.authIsFollowingProfileUser ? 'Yes' : 'No');

                } catch (err) {
                    console.log(err);
                }

                // load data from localStorage
                if (typeof Storage !== 'undefined') {
                     //Post
                     localForage.getItem('post-'+this.post.id)
                    .then((value) => {
                        this.post = value;
                    })
                    .catch((err) => { console.log(err) });
                }

                console.log(user_id);

                this.fetchData();
            },
            fetchData() {
                axios.get('/api/posts/' + this.post.id)
                .then((response) => {
                    this.post = response.data.data;
                    console.log('api-record', this.post);
                    saveStorage('post-'+this.post.id, response.data.data);
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
            clearCommentsForm() {
                this.commentForm.post_id = null;
                this.commentForm.user_id = user_id;
                this.commentForm.comment = null;
            },
            saveCommentData(record_id) {
                if(this.commentForm.comment !== null) {
                    this.commentForm.post_id = record_id;
                    axios.post('/api/comments',this.commentForm)
                    .then(response => {
                        this.clearCommentsForm();
                        this.fetchData();
                    }).catch(error => {
                        console.log(error.message)
                    });
                }
            },
        }
    }
</script>
