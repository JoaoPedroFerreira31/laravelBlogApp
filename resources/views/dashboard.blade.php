<x-app-layout>
    <div x-data="dashboardData()" class="mx-auto max-w-7xl sm:px-6 lg:px-8" x-cloak>

        <div class="flex justify-center w-full">
            <div class="w-full max-w-lg p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="inline-flex justify-between w-full">
                    <h1 class="text-lg font-bold text-gray-900 align-center">Welcome <span class="" x-text="username"></span></h1>
                    <div class="flex-col text-right gap-y-1">
                        <div class="text-sm text-gray-500">You have<span class="mx-1" x-text="userPosts.length">0</span>post</div>
                        <span @click.prevent="isCrudPostModalOpen = true" class="text-xs text-left text-blue-700 cursor-pointer hover:text-blue-500">Create new post</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="flex justify-center w-full">
            <div class="inline-flex justify-start w-full max-w-lg mt-2 gap-x-2">
                <div :class="filterName === 'all_posts' ? 'px-4 py-1 text-xs text-white bg-gray-300 border border-gray-300 rounded-md shadow-lg cursor-pointer hover:bg-gray-400 hover:shadow-none' : 'px-4 py-1 text-xs text-white bg-gray-500 border border-gray-500 rounded-md shadow-sm cursor-pointer hover:bg-gray-400 hover:shadow-none'"  @click.prevent="filter('all_posts')"  x-text="'All posts'"></div>
                <div :class="filterName === 'user_posts' ? 'px-4 py-1 text-xs text-white bg-gray-300 border border-gray-300 rounded-md shadow-lg cursor-pointer hover:bg-gray-400 hover:shadow-none' : 'px-4 py-1 text-xs text-white bg-gray-500 border border-gray-500 rounded-md shadow-sm cursor-pointer hover:bg-gray-400 hover:shadow-none'"  @click.prevent="filter('user_posts')" x-text="'My posts'"></div>
            </div>
        </div>

        {{-- Posts --}}
        <template x-for="post in filteredPosts" :key="post.id">

            <div class="flex justify-center w-full">
                <div class="w-full max-w-lg px-6 py-4 mt-4 overflow-hidden bg-white shadow-sm sm:rounded-lg">
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
                    <div class="mt-2">
                        <p class="text-sm text-gray-500" x-text="post?.content"></p>
                    </div>
                    <div :class="post.created_at !== post.updated_at ? 'flex justify-between w-full mt-2' : 'flex justify-end w-full mt-2'">
                        <span class="text-xs text-gray-500 whitespace-nowrap" x-text="'Publicado em: ' + date_short(post.created_at)"></span>
                        <span x-tooltip="date_readable(post.updated_at)" x-show="post.created_at !== post.updated_at" class="text-xs text-gray-500 cursor-pointer">*Editado</span>
                    </div>

                    <hr class="mt-1 text-gray-500 border-1">

                    <template x-for="comment in post.comments" :key="comment.id">
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
                    </template>

                    {{-- Add Comments --}}
                    <div class="w-full mt-2">
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
                    </div>

                </div>
            </div>
        </template>

        <x-modals.crud-post/>
        <x-modals.delete-pop-up/>
    </div>
</x-app-layout>
<script>
    function dashboardData() {
        return {
            ttp_tools: 'Options',
            filterName: 'all_posts',
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
            init() {

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
                }

                console.log(user_id);

                this.fetchData();
            },
            fetchData() {
                axios.get('api/posts/')
                .then((response) => {
                    console.log('posts', response.data.data);
                    this.posts = response.data.data;
                    this.filteredPosts = response.data.data;
                    this.userPosts = this.posts.filter(post => post.author === user_id);
                    saveStorage('posts', response.data.data);
                }).catch((error) => {
                    console.log(error);
                });



                axios.get('api/comments/')
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
