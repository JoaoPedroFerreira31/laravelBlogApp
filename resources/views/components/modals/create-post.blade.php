<div  x-data="dataCreatePost()" x-show="isCreatePostModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display:none;">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

        <div x-transition class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-transition
            class="inline-block pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-3xl" role="dialog" aria-modal="true" aria-labelledby="modal-headline">

            <form @submit.prevent="savePostData()">
                @csrf
                <!-- header -->
                <div class="px-4 py-6 bg-indigo-600 sm:px-6">
                    <div class="flex items-center justify-between">
                        <h2 id="slide-over-heading" class="text-lg font-medium text-white">
                            {{-- @lang('create_edit') --}}
                            Create new post
                        </h2>
                        <div class="flex items-center ml-3 h-7">
                            <button @click.prevent="isCreatePostModalOpen = false" class="text-indigo-200 bg-indigo-600 rounded-md hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
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
                <div class="p-6 sm:flex sm:items-start">
                    <div class="px-1 divide-y divide-gray-200">
                        <div class="space-y-3">
                            <div class="flex flex-col">
                                <div class="w-full w-12/12">
                                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post title</label>
                                    <input type="text" id="title" x-model="postForm.title" class="block w-full p-2 mb-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Insert title..." required>
                                </div>

                                <div class="w-full w-12/12">
                                    <label for="content" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Post content</label>
                                    <textarea id="content" x-model="postForm.content" rows="4" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your post..." required></textarea>
                                </div>

                                {{-- <x-inputs.group class="w-full">
                                    <x-inputs.text x-model="eventForm.title"
                                        name="title"
                                        label="title"
                                        value="{{ old('title', '') }}"
                                        maxlength="255"
                                        placeholder="Title"
                                        required
                                    ></x-inputs.text>
                                </x-inputs.group> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- buttons -->
                <div class="mt-2">
                    <div class="flex justify-end px-4 py-4 shrink-0 gap-x-2">
                        <button @click.prevent="isCreatePostModalOpen = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-medexis-blue">
                            @lang('cancel')
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-700 border border-blue-300 rounded-md shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-medexis-blue">
                            Submit
                        </button>
                        {{-- <button type="submit" class="w-full px-3 py-2 mt-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button> --}}
                        {{-- <x-soccer.partials.save-button/> --}}
                    </div>
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
                //this.gamePitches = this.pitches;

                this.$watch('isCreatePostModalOpen', (value) => {
                    if (!this.isCreatePostModalOpen) {
                        this.clearPostForm();
                    } else {
                        // notyf.success(this.isPostEditing ? 'updated' : 'added');
                    }
                })
            },
            clearPostForm(){
                this.postForm.title = null;
                this.postForm.content = null;
                this.postForm.author = user_id;
            },
            savePostData(){
                this.isSaving = true;
                this.haveErrors = false;
                this.errors = [];

                if (navigator.onLine) {
                    axios({
                        method: (this.isPostEditing ? 'put' : 'post'),
                        url: '/api/posts' + (this.isPostEditing ? "/" + this.editPostID : ''),
                        data: this.postForm,
                    }).then((response) => {
                        this.isCreatePostModalOpen = false;
                        notyf.success(this.isPostEditing ? 'updated' : 'added');
                        this.isPostEditing = false;
                        this.isSaving = false;
                        this.fetchData();
                    }).catch((error) => {
                        notyf.alert('please_check_the_errors_and_retry');
                        this.haveErrors = true;
                        this.isSaving = false;
                        this.errors = error.response.data.errors;
                    });
                } else {
                    // saveOfflineStorage((this.isOpponentsEditing ? 'edit' : 'create'),this.editGameID, 'games',this.gameForm);
                }
            },
        }
    };
</script>
