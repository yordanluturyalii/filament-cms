<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white focus:ring-2 ring-gray-950/10 focus:ring-orange-500 dark:ring-white/20 dark:focus:ring-orange-500 fi-fo-text-input overflow-hidden" x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <input type="text" class="fi-input block w-full border-none bg-transparent bg-none py-1.5 text-base text-gray-950 outline-none transition duration-75 placeholder:text-gray-400 focus:ring-2 focus-within:ring-orange-500 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 ps-3 pe-3"
            x-model="state"
            id="{{$getId()}}"
            x-on:input="state == $event.target.value.toLowerCase().replace(/[^a-z0-9]/g, '-').replace(/-+/g, '-')"
        />
    </div>
</x-dynamic-component>
