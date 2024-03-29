<x-app-layout>
    <div x-data="profileSettingsData()" class="mx-auto max-w-7xl sm:px-6 lg:px-8" x-cloak>
        <div class="grid w-full gap-2 mt-2 lg:grid-cols-3 sm:grid-cols-1">

            {{-- User information --}}
            <section>
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">

                    {{-- User header --}}
                    <div class="flex flex-col w-full">
                        <div class="flex flex-wrap items-center w-full mb-2">
                            <x-fas-arrow-left @click="navigateTo('/profile/'+user_id)" class="w-5 h-5 hover:cursor-pointer hover:opacity-50"/>
                        </div>
                        <div class="flex flex-wrap justify-center w-full mb-2">
                            <img class="w-20 h-20 rounded-full" src="{{ $user->image ? asset('storage'.$user->image) : asset('images/placeholder.png') }}" alt="">
                        </div>
                        <div class="inline-flex items-center justify-center w-full">
                            <h1 class="mr-1 font-bold text-center text-gray-900" x-text="user_id === user.id ? Lang.get('strings.welcome')+ ' ' + username : user.name"></h1>
                        </div>
                        <div class="inline-flex justify-center w-full gap-x-2">
                            <span class="text-sm font-bold"><span x-text="user.posts_count" class="mr-1"></span> @lang('posts')</span>
                            <span class="text-sm font-bold"><span x-text="user.followers_count" class="mr-1"></span> @lang('followers')</span>
                            <span class="text-sm font-bold"><span x-text="user.followings_count" class="mr-1"></span> @lang('followings')</span>
                        </div>
                    </div>
                </div>

                 {{-- Personal information --}}
                 <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col w-full">
                        <div class="flex flex-wrap justify-between mb-2">
                            <div class="flex flex-col">
                                <h1 class="text-lg font-bold text-gray-900">@lang('personal_information')</h1>
                            </div>
                        </div>
                        <dl>
                            <div class="flex justify-between py-2">
                                <div class="flex-col">
                                    <dt class="text-sm font-bold">@lang('first_name')</dt>
                                    <dd class="mt-1 text-sm text-gray-900" x-text="user?.first_name"></dd>
                                </div>

                                <div class="flex-col text-right">
                                    <dt class="text-sm font-bold">@lang('last_name')</dt>
                                    <dd class="mt-1 text-sm text-gray-900" x-text="user?.last_name"></dd>
                                </div>
                            </div>
                            <div class="flex justify-between py-2">
                                <div class="flex-col">
                                    <dt class="text-sm font-bold">@lang('date_of_birth')</dt>
                                    <dd class="mt-1 text-sm text-gray-900" x-text="user?.dob ?? '--'"></dd>
                                </div>
                                <div class="flex-col text-right">
                                    <dt class="text-sm font-bold">@lang('country')</dt>
                                    <dd class="mt-1 text-sm text-gray-900" x-text="user?.country ?? '--'"></dd>
                                </div>
                            </div>
                            <div class="flex justify-between py-2">
                                <div class="flex-col">
                                    <dt class="text-sm font-bold">@lang('company')</dt>
                                    <dd class="mt-1 text-sm text-gray-900" x-text="user?.company ?? '--'"></dd>
                                </div>
                                <div class="flex-col text-right">
                                    <dt class="text-sm font-bold">@lang('website')</dt>
                                    <dd class="mt-1 text-sm text-gray-900 hover:cursor-pointer hover:opacity-80" x-text="user?.website ?? '--'" @click="user.website ? navigateTo(user.website) : null"></dd>
                                </div>
                            </div>
                            <div class="py-2">
                                <dt class="text-sm font-bold">@lang('description')</dt>
                                <dd class="mt-1 text-sm text-gray-900" x-text="user?.description ?? '--'"></dd>
                            </div>
                        </dl>
                    </div>
                </div>

            </section>

            {{-- Page content --}}
            <section class="lg:col-span-2">
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col ">
                        <div class="inline-flex items-center justify-center w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <h1 class="ml-1 font-bold text-center text-gray-900">@lang('profile_settings_page')</h1>
                        </div>
                        <span x-show="user_id === user.id" class="text-sm text-center text-gray-500">@lang('here_you_can_manage_all_the_content_related_to_your_profile')</span>
                    </div>
                </div>

                {{-- Settings --}}
                <div class="w-full p-6 mt-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex flex-col w-full">
                        <h1 class="font-bold text-gray-900">@lang('account_settings')</h1>
                        <span class="text-sm text-gray-400">@lang('change_your_profile_and_account_settings')</span>

                        <form @submit.prevent="updateUserData()" class="mt-5">

                             <!-- Panel validation errors -->
                             <x-partials.crud-errors/>

                            {{-- Email --}}
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="email" x-model="userForm.email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">@lang('email_address')</label>
                            </div>

                            {{-- Username --}}
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" x-model="userForm.name" name="floating_username" id="floating_username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="floating_username" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">@lang('username')</label>
                            </div>

                            {{-- First name / Last name --}}
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="text" x-model="userForm.first_name" name="floating_first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "/>
                                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">@lang('first_name')</label>
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="text" x-model="userForm.last_name" name="floating_last_name" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">@lang('last_name')</label>
                                </div>
                            </div>

                            {{-- DOB / Company --}}
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="date" x-model="userForm.dob" name="floating_date" id="floating_date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label for="floating_date" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">@lang('date_of_birth')</label>
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="text" x-model="userForm.company" name="floating_company" id="floating_company" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label for="floating_company" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">@lang('company') (Ex. Google)</label>
                                </div>
                            </div>

                            {{-- Website / Country --}}
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="url" x-model="userForm.website" name="floating_site" id="floating_site" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label for="floating_site" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">@lang('website') (Ex. www.example.com)</label>
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <input type="text" x-model="userForm.country" name="floating_country" id="floating_country" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label for="floating_country" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">@lang('country')</label>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" x-model="userForm.description" name="floating_description" id="floating_description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="floating_description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">@lang('description')</label>
                            </div>

                            {{-- Image --}}
                            <div class="relative z-0 w-full mb-6 group">
                                <div class="flex flex-wrap items-center w-full">
                                    <div class="flex justify-center w-4/12">
                                         <!-- Show the image -->
                                        <template x-if="userImageUrl">
                                            <img
                                                :src="userImageUrl"
                                                class="object-cover border border-gray-200 rounded"
                                                style="width: 100px; height: 100px;"
                                            />
                                        </template>

                                        <!-- Show the gray box when image is not available -->
                                        <template x-if="!userImageUrl">
                                            <div
                                                class="bg-gray-100 border border-gray-200 rounded"
                                                style="width: 100px; height: 100px;"
                                            ></div>
                                        </template>
                                    </div>
                                    <div class="flex items-center w-8/12">
                                        <input type="file" name="image" id="image" accept="image/*" @change="fileImageChosen" />
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">@lang('update')</button>
                        </form>

                    </div>
                </div>

            </section>
        </div>
    </div>
</div>

</x-app-layout>
<script>
    let backendRecord = @json($user);

    function profileSettingsData() {
        return {
            ttp_tools: Lang.get('strings.options'),
            ttp_profile_settings: Lang.get('strings.profile_settings'),
            authHasFollowedRequestProfileUser: null,
            authIsFollowingProfileUser: null,
            isShowingPendingRequests: false,
            user: null,
            userForm: {
                email: null,
                name: null,
                first_name: null,
                last_name: null,
                description: null,
                dob: null,
                country: null,
                website: null,
                company: null,
                image: null,
            },
            haveErrors: false,
            errors: [],
            fileToUpload: null,
            filename: null,
            userImageUrl: null,
            init() {
                try {
                    this.user = backendRecord;
                    this.authHasFollowedRequestProfileUser = "{{ Auth::user()->hasRequestedToFollow($user) }}";
                    this.authIsFollowingProfileUser = "{{ Auth::user()->isFollowing($user) }}";
                } catch(err) {
                    console.log(err);
                }

                // load data from localStorage
                if (typeof Storage !== 'undefined') {
                    //User
                    localForage.getItem('user-'+this.user.id)
                    .then((value) => {
                        this.user = value;
                    })
                    .catch((err) => { console.log(err) });
                }

                this.fetchData();
                this.processFormData();
            },
            fetchData() {

                axios.get('/api/users/'+this.user.id)
                .then((response) => {
                    console.log('user', response.data.data);
                    this.user = response.data.data;
                    saveStorage('user-'+this.user.id, response.data.data);
                }).catch((error) => {
                    console.log(error);
                });

            },
            fileImageChosen(event) {
                this.fileChosen(event, src => this.userImageUrl = src)
            },
            fileChosen(event, callback) {
                if (! event.target.files.length) return

                let file = event.target.files[0], reader = new FileReader();
                this.imageToUpload = file;

                reader.readAsDataURL(file)
                reader.onload = e => callback(e.target.result)
            },
            processFormData() {
                this.userForm.email = this.user.email ?? null;
                this.userForm.name = this.user.name ?? null;
                this.userForm.first_name = this.user.first_name ?? null;
                this.userForm.last_name = this.user.last_name ?? null;
                this.userForm.description = this.user.description ?? null;
                this.userForm.dob = this.user.dob ?? null;
                this.userForm.country = this.user.country ?? null;
                this.userForm.website = this.user.website ?? null;
                this.userForm.company = this.user.company ?? null;
            },
            updateUserData() {
                console.log('updating... '+ this.userForm.name);
                console.log(this.userForm);

                this.isSaving = true;
                this.haveErrors = false;
                this.errors = [];

                if (navigator.onLine) {
                    axios({
                        method: 'put',
                        url: '/api/users/' +this.user.id,
                        data: this.userForm,
                    }).then((response) => {
                        if(this.imageToUpload){
                            const data = new FormData();
                            data.append('image', this.imageToUpload);
                            axios.post(`/api/upload-user-photo/${response.data.data.id}`, data)
                            .then((response) => console.log(response.message))
                            .catch((error) => {
                                notyf.alert(Lang.get('strings.please_check_the_errors_and_retry'));
                                this.haveErrors = true;
                                this.isSaving = false;
                                this.errors = error.response.data.errors;
                            });
                        }
                        notyf.success(Lang.get('strings.user_updated_successfully'));
                        this.isSaving = false;
                        this.fetchData();
                    }).catch((error) => {
                        notyf.alert(Lang.get('strings.please_check_the_errors_and_retry'));
                        this.haveErrors = true;
                        this.isSaving = false;
                        this.errors = error.response.data.errors;
                    });
                } else {
                    saveOfflineStorage('edit', this.user.id, 'user-update-'+this.user.id, this.userForm);
                }
            },
        }
    }
</script>
