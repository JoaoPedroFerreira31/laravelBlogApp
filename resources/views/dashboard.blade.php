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
                    <h1 class="align-center text-lg text-gray-900">Posts</h1>
                    <div class="flex-col gap-y-1 text-right">
                        <div class="text-gray-500 text-sm">You have<span class="mx-1" x-text="posts.length">0</span>post</div>
                        <span @click.prevent="isCreatePostModalOpen = true" class="text-left text-xs text-blue-700 hover:text-blue-500 cursor-pointer">Create new post</span>
                    </div>
                </div>
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
                                        <button x-tooltip="ttp_tools" type="button" class="inline-flex items-center ml-1 text-sm font-light text-gray-500 hover:border-gray-300 focus:border-gray-300 hover:bg-gray-200">
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
            posts: [],
            init() {

                // load data from localStorage
                if (typeof Storage !== 'undefined') {
                    localForage.getItem('posts')
                    .then((value) => {
                        this.posts = value;
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
                    saveStorage('posts', response.data.data);
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
        }
    }
</script>
