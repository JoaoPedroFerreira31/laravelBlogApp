<div x-show="haveErrors" class="overflow-hidden bg-white" style="display:none;">
    <div class="p-3 mt-2">
        <h2 class="text-lg font-medium text-red-700 capitalize">@lang('please_fix_the_following_errors')</h2>
        <ul class="list-disc">
            <template x-for="error in errors">
                <li class="ml-4 text-sm text-gray-600" x-text="error"></li>
            </template>
        </ul>
    </div>
</div>
