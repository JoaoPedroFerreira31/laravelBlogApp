<div x-data="dataCreatePost()" x-show="isCommentModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display:none;">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

        <div x-transition class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-transition
            class="inline-block pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-3xl" role="dialog" aria-modal="true" aria-labelledby="modal-headline">

            <form @submit.prevent="saveCommentData()">
                @csrf
                <!-- header -->
                <div class="px-4 py-6 bg-indigo-600 sm:px-6">
                    <div class="flex items-center justify-between">
                        <h2 id="slide-over-heading" class="text-lg font-medium text-white">
                            @lang('write_your_comment')
                        </h2>
                        <div class="flex items-center ml-3 h-7">
                            <button @click.prevent="isCommentModalOpen = false" class="text-indigo-200 bg-indigo-600 rounded-md hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                                <span class="sr-only">@lang('close')</span>
                                <!-- Heroicon name: outline/x -->
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- form -->
                <div class="p-6 sm:flex flex-col sm:items-start">

                    <div>
                        <div class="inline-flex justify-between w-full">
                            <div class="w-8/12">
                                <h1 class="text-lg font-bold text-gray-900" x-text="selectedPost?.title"></h1>
                            </div>
                            <div class="flex-col w-4/12 text-right">
                                <div class="inline-flex">
                                    <a type="button" @click="navigateTo(`/profile/`+selectedPost?.author)" class="text-sm text-gray-500 hover:cursor-pointer hover:text-gray-300" x-text="selectedPost?.authorName"></a>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 line-clamp-4" x-text="selectedPost?.content"></p>
                    </div>

                    <div class="px-1 divide-y divide-gray-200 w-full">
                        <div class="space-y-3">

                            <!-- Panel validation errors -->
                            <x-partials.crud-errors/>

                            <div class="flex flex-wrap">
                                <div class="w-full px-4 my-2 lg:w-12/12">
                                    <label for="comment" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">@lang('comment')</label>
                                    <textarea id="comment" x-model="commentForm.comment" rows="4" class="block w-full px-8 py-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :placeholder="Lang.get('strings.write_your_comment')+'...'" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- buttons -->
                <div class="flex justify-end px-4 py-2 shrink-0 gap-x-2">
                    <button @click.prevent="isCommentModalOpen = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-medexis-blue">
                        @lang('cancel')
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-700 border border-blue-300 rounded-md shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        @lang('reply')
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script type="text/javascript">
    function dataCreatePost() {
        return {
            haveErrors: false,
            errors: [],
            init() {

                this.$watch('isCrudPostModalOpen', (value) => {
                    if (!this.isCrudPostModalOpen) {
                        this.clearPostForm();
                    } else {

                    }
                })
            },
            clearCommentsForm() {
                this.commentForm.post_id = null;
                this.commentForm.user_id = user_id;
                this.commentForm.comment = null;
            },
            saveCommentData() {
                this.commentForm.post_id = this.selectedPost.id;

                axios.post('api/comments',this.commentForm)
                .then(response => {
                    this.isCommentModalOpen = false;
                    this.clearCommentsForm();
                    notyf.success(Lang.get('comment_added_successfully'));~
                    this.fetchData();
                }).catch(error => {
                    console.log(error.message)
                });

            },
        }
    };
</script>
