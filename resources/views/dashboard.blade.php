<x-app-layout>
    <div x-data="dashboardData()" class="mx-auto max-w-7xl sm:px-6 lg:px-8" x-cloak>

        {{-- Create Post
        <div class="w-full mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <form action="savePostData()">
                @csrf
                <div class="p-6 bg-white border-b border-gray-200">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post title</label>
                    <input type="text" id="title" class="block w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Insert title..." required>

                    <label for="content" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Post content</label>
                    <textarea id="content" x-model="postForm.content" rows="4" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your post..." required></textarea>
                    <button type="submit" class="w-full px-3 py-2 mt-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </div>
            </form>
        </div> --}}
        <div class="flex justify-center w-full">
            <div class="w-full max-w-lg mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">
                <div class="w-full inline-flex justify-between">
                    <h1 class="align-center text-sm text-gray-900">Welcome <span class="" x-text="username"></span></h1>
                    <div class="flex-col gap-y-1 text-right">
                        <div class="text-gray-500 text-sm">You have<span class="mx-1" x-text="userPosts.length">0</span>post</div>
                        <span @click.prevent="isCreatePostModalOpen = true" class="text-left text-xs text-blue-700 hover:text-blue-500 cursor-pointer">Create new post</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center w-full">
            <div class="w-full max-w-lg mt-2 inline-flex gap-x-2 justify-start">
                {{-- //TODO: ADD FIlTERS --}}
                {{-- Use filtered Records --}}
                <div class="py-1 px-4 text-xs rounded-md text-white hover:bg-gray-400 bg-gray-500 border border-gray-500 hover:shadow-none shadow-sm cursor-pointer" x-text="'All posts'"></div>
                <div class="py-1 px-4 text-xs rounded-md text-white hover:bg-gray-400 bg-gray-500 border border-gray-500 hover:shadow-none shadow-sm cursor-pointer" x-text="'My posts'"></div>
            </div>
        </div>

        <template x-for="post in posts" :key="post.id">

            <div class="flex justify-center w-full">
                <div class="w-full max-w-lg mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="w-full inline-flex justify-between">
                        <div class="w-8/12">
                            <h1 x-text="post.title"></h1>
                        </div>
                        <div class="w-4/12 text-right flex-col">
                            <div class="inline-flex">
                                <p class="text-sm text-gray-500" x-text="post.authorName"></p>
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
                            <span class="text-gray-500 text-xs whitespace-nowrap" x-text="post.created_at"></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-gray-500 text-sm" x-text="post.content"></p>
                    </div>
                    <div class="mt-2 flex w-full justify-end">
                        <p x-tooltip="'Editado em: ' + post.updated_at" x-show="post.created_at !== post.updated_at" class="cursor-pointer text-gray-500 text-xs">*Editado</p>
                    </div>

                    <hr class="border-1 text-gray-500">

                    <template x-for="comment in comments.filter(comment => comment.post_id === post.id)">
                        <div class="mt-2 w-full">
                            <div class="flex items-center px-3 py-1 rounded-lg bg-gray-50 dark:bg-gray-700">
                                <div class="text-xs inline-flex w-full justify-between">
                                    <div class="inline-flex">
                                        <span class=" font-bold mr-1" x-text="comment.user.name"></span>
                                        <span x-text="comment.comment"></span>
                                    </div>
                                    <span x-text="comment.created_at"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                    {{-- Add Comments --}}
                    <div class="mt-2 w-full">
                        <form @submit.prevent="saveCommentData(`${post.id}`)">
                            <label for="chat" class="sr-only">Add a comment...</label>
                            <div class="flex items-center px-3 py-1 rounded-lg bg-gray-50 dark:bg-gray-700">
                                <textarea id="chat" rows="1" class="outline-none block mx-4 p-2 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Add a comment..." x-model="commentForm.comment"></textarea>
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

        <x-modals.create-post/>
        <x-modals.delete-pop-up/>
    </div>
</x-app-layout>
<script>
    function dashboardData() {
        return {
            ttp_tools: 'Options',
            isCreatePostModalOpen: false,
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
            init() {

                // load data from localStorage
                if (typeof Storage !== 'undefined') {

                    //Posts
                    localForage.getItem('posts')
                    .then((value) => {
                        this.posts = value;
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
                    this.userPosts = this.posts.filter(posts => posts.author === user_id);
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

                this.isCreatePostModalOpen = true;
            },
            isDeletePopUpOpen: false,
            isPostDeleting: false,
            postToDelete: null,
            deletePost(record_id){
                this.isPostDeleting = true;
                this.postToDelete = record_id;
                this.isDeletePopUpOpen = true;
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
