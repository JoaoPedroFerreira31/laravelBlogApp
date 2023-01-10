<x-app-layout>
    <div x-data="profilData()" class="mx-auto max-w-7xl sm:px-6 lg:px-8" x-cloak>
        <div class="grid w-full gap-2 mt-2 lg:grid-cols-3 sm:grid-cols-1">
            <div>
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col w-full">
                        <div class="flex flex-wrap justify-center w-full mb-2">
                            <img class="w-20 h-20 rounded-full" src="{{ asset('images\placeholder.png') }}" alt="">
                        </div>
                        <h1 class="font-bold text-center text-gray-900">Welcome <span class="" x-text="username"></span></h1>
                    </div>
                </div>
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <h1 class="text-lg font-bold text-gray-900">Friends</h1>
                </div>
            </div>
            <div class="lg:col-span-2">
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col w-full">
                        <div class="flex flex-wrap justify-center w-full mb-2">
                            <img class="w-20 h-20 rounded-full" src="{{ asset('images\placeholder.png') }}" alt="">
                        </div>
                        <h1 class="font-bold text-center text-gray-900">Welcome <span class="" x-text="username"></span></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    function profilData() {
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
