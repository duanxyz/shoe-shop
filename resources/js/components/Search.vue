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
                v-model="params.search"
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
import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';

export default {
    name: 'Search',
    data() {
        return {
            params: {
                search: '',
            },
        };
    },
    watch: {
        params: {
            handler: throttle(function () {
                let query = pickBy(this.params);
                this.$inertia.replace(
                    this.route('search', Object.keys(query).length ? query : '')
                );
            }, 150),
            deep: true,
        },
    },
    created() {
        const url = new URL(window.location.href);
        if (url.searchParams.get('search')) {
            this.params.search = url.searchParams.get('search');
        }
    },
};
</script>

<style></style>
