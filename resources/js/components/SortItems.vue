<template>
    <div class="flex gap-2 items-center">
        <label for="sort">
            <b for="sort">urutkan :</b>
        </label>
        <!-- <inertia-link
            :href="route('search', { search: query.search, low: true })"
        > -->
        <select name="sort" v-model="sort" class="text-sm rounded-md">
            <option value="">Paling Sesuai</option>
            <option :value="{ latest: true }" :selected="true">Terbaru</option>
            <option :value="{ height: true }" :selected="params.height">
                Harga Tertinggi
            </option>
            <option :value="{ low: true }" :selected="params.low">
                Harga Terendah
            </option>
        </select>
        <!-- </inertia-link> -->
    </div>
</template>

<script>
import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';

export default {
    props: ['filters'],
    data() {
        return {
            sort: '',
            params: {
                search: this.filters.search,
                category: this.filters.category,
                min_price: this.filters.min_price,
                max_price: this.filters.max_price,
                condition: this.filters.condition,
            },
        };
    },
    watch: {
        sort: {
            handler: throttle(function () {
                ['latest', 'low', 'height'].forEach((n) => {
                    if (n !== Object.getOwnPropertyNames(this.sort)) {
                        this.params[n] = false;
                    }
                });

                let query = { ...pickBy(this.params), ...pickBy(this.sort) };
                this.$inertia.replace(
                    this.route('search', Object.keys(query).length ? query : '')
                );
            }, 150),
            deep: true,
        },
        filters: function () {
            this.params = this.filters;
        },
    },
};
</script>

<style></style>
