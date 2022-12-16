<x-app-layout>
    <div x-data="dashboardData()" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <section x-show="showLoginBanner" class="bg-green-400 flex my-2 flex-col w-full min-w-0 break-words rounded-md shadow-md">
            <!--  Alert -->
            <div class="px-4 py-3 mb-2 rounded-t border-b-1">
                <div class="flex flex-wrap items-center">
                    <div class="relative flex-1 flex-grow w-full max-w-full px-2">
                        <h1 class="text-lg font-bold text-white dark:text-gray-400">
                            You're logged in!
                        </h1>
                    </div>
                    <div class="flex items-center ml-3 h-7">
                        <button @click.prevent="showLoginBanner = false" class="text-white rounded-md hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-white">
                            <span class="sr-only">@lang('close')</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2 w-full">
            <form action="">
                <div class="p-6 bg-white border-b border-gray-200">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
                    <textarea id="message" rows="4" class="block p-2 w-full text-sm text-gray-900
                    bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
                    <button type="submit" class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                    focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2 text-center
                    dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
<script>
    function dashboardData() {
        return {
            showLoginBanner: true,
            init() {
            },
        }
    }
</script>
