<template>
    <app-layout>
        <div class="pt-24 pb-12">
            <div class="max-w-none mx-auto">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-20"
                >
                    <div class="flex gap-5">
                        <filters :query="filters" />
                        <div class="py-5">
                            <sort-items
                                :filters="filters"
                                class="justify-end py-1"
                            />
                            <list-items :items="items" class="py-3" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import Filters from '@/components/Filters';
import ListItems from '@/components/ListItems';
import SortItems from '@/components/SortItems';
export default {
    components: {
        AppLayout,
        Filters,
        ListItems,
        SortItems,
    },
    props: ['items', 'filters'],
};
</script>

<style scope>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type='number'] {
    -moz-appearance: textfield;
}
</style>
