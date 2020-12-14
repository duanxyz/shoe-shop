<template>
    <!-- Form -->
    <form class="md:flex hidden flex-row flex-wrap items-center mr-3 w-2/4">
        <div class="relative flex w-full flex-wrap items-stretch">
            <!-- <span
                class="z-10 h-full leading-snug font-normal absolute text-center text-gray-400 bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"
            >
            </span> -->
            <input
                type="text"
                placeholder="Search here..."
                class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white rounded-full text-sm shadow-outline-gray focus:outline-none focus:shadow-outline w-full pl-10 h-7"
            />
            <button
                type="submit"
                class="absolute right-0 top-0 mt-1 mr-4 text-gray-400"
            >
                <font-awesome-icon icon="search" />
            </button>
        </div>
    </form>
</template>

<script>
export default {
    name: "Search",
};
</script>

<style></style>
