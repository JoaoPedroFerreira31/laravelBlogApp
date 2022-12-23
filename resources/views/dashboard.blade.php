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
                    <div class="flex-col gap-y-1">
                        <div class="text-gray-500 text-sm">You have<span class="mx-1" x-text="posts.length">0</span>post</div>
                        <span @click.prevent="isCreatePostModalOpen = true" class="text-left text-xs text-blue-700 hover:text-blue-500 cursor-pointer">Create new post</span>
                    </div>
                </div>
            </div>
        </div>

        <template x-for="post in posts" :key="post.id">
            <div class="flex justify-center w-full">
                <div class="w-full max-w-lg mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="w-full flex-col gap-y-2">
                        <h1 x-text="post.title"></h1>
                        <p class="text-gray-500 text-sm" x-text="post.content"></p>
                    </div>
                </div>
            </div>
        </template>

        <x-modals.create-post/>
    </div>
</x-app-layout>
<script>
    function dashboardData() {
        return {
            isCreatePostModalOpen: false,
            isPostEditing: false,
            editPostID: null,
            open: false,
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
            // savePostData() {
            //     axios.post('api/posts', this.postForm)
            //     .then((response) => {
            //         this.fetchData();
            //     }).catch((error) => {
            //         console.log(error);
            //     });
            // }
        }
    }
</script>
