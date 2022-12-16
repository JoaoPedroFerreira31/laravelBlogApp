<x-app-layout>
    <div x-data="dashboardData()" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div x-show="showLoginBanner" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2">
            <div class="p-4 bg-white border-b border-gray-200">
                You're logged in!
            </div>
        </div>
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
