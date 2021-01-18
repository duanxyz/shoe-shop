<template>
    <div class="py-5">
        <h1 class="font-bold text-lg">Filter</h1>
        <div class="border border-gray-400 rounded-md p-2 shadow-lg w-48">
            <ul class="text-sm">
                <li>
                    <div
                        @click="
                            filters.category.status = !filters.category.status
                        "
                        class="p-1 rounded-md cursor-pointer grid grid-cols-2"
                    >
                        <b>Kategori</b>
                        <div
                            class="justify-self-end w-5 rounded-full hover:bg-gray-300 text-center"
                        >
                            <font-awesome-icon icon="angle-down" />
                        </div>
                    </div>
                    <div v-if="filters.category.status" class="text-gray-500">
                        <ul class="pl-1">
                            <li>
                                <div
                                    class="p-1 hover:bg-gray-200 rounded-md cursor-pointer"
                                    @click="
                                        filters.category.male = !filters
                                            .category.male
                                    "
                                >
                                    <font-awesome-icon icon="angle-down" />
                                    <b>Sepatu Pria</b>
                                </div>
                                <ul v-if="filters.category.male" class="pl-2">
                                    <li
                                        v-for="(category, index) in $page.props
                                            .categories.male"
                                        :key="index"
                                        class="hover:bg-gray-200 rounded-sm p-1"
                                        :class="{
                                            'bg-gray-200':
                                                isActive === category.name,
                                        }"
                                    >
                                        <label
                                            :for="category.name + index"
                                            class="cursor-pointer pl-2"
                                        >
                                            <input
                                                type="checkbox"
                                                class="absolute opacity-0"
                                                :id="category.name + index"
                                                :value="category.name"
                                                v-model="ctgry"
                                            />
                                            {{ category.name }}
                                        </label>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div
                                    class="p-1 hover:bg-gray-200 rounded-md cursor-pointer"
                                    @click="
                                        filters.category.woman = !filters
                                            .category.woman
                                    "
                                >
                                    <font-awesome-icon icon="angle-down" />
                                    <b>Sepatu Wanita</b>
                                </div>
                                <ul v-if="filters.category.woman" class="pl-2">
                                    <li
                                        v-for="(category, index) in $page.props
                                            .categories.woman"
                                        :key="index"
                                        class="hover:bg-gray-200 rounded-sm p-1"
                                        :class="{
                                            'bg-gray-200':
                                                isActive === category.name,
                                        }"
                                    >
                                        <label
                                            :for="category.name + index"
                                            class="cursor-pointer pl-2"
                                        >
                                            <input
                                                type="checkbox"
                                                class="absolute opacity-0"
                                                :id="category.name + index"
                                                :value="category.name"
                                                v-model="ctgry"
                                            />
                                            {{ category.name }}
                                        </label>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div
                        class="p-1 rounded-md cursor-pointer grid grid-cols-2"
                        @click="filters.condition = !filters.condition"
                    >
                        <b> Kondisi </b>
                        <div
                            class="justify-self-end w-5 rounded-full hover:bg-gray-300 text-center"
                        >
                            <font-awesome-icon icon="angle-down" />
                        </div>
                    </div>
                    <div
                        v-if="filters.condition"
                        class="gap-2 text-gray-500 p-1 pl-2"
                    >
                        <div>
                            <input
                                type="checkbox"
                                class="rounded-sm cursor-pointer"
                                value="baru"
                                @click="uncheckOther"
                                v-model="condition"
                            />
                            <span>Baru</span>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                value="bekas"
                                v-model="condition"
                                @click="uncheckOther"
                                class="rounded-sm cursor-pointer"
                            />
                            <span>Bekas</span>
                        </div>
                    </div>
                </li>
                <li>
                    <div
                        class="p-1 rounded-md cursor-pointer grid grid-cols-2"
                        @click="filters.price = !filters.price"
                    >
                        <b> Harga </b>
                        <div
                            class="justify-self-end w-5 rounded-full hover:bg-gray-300 text-center"
                        >
                            <font-awesome-icon icon="angle-down" />
                        </div>
                    </div>
                    <div v-if="filters.price">
                        <div class="flex items-center p-1">
                            <b class="h-8 p-1 bg-gray-300">Rp</b>
                            <input
                                type="number"
                                name="min_price"
                                v-on:keyup.enter="setMinPrice"
                                :value="min_price"
                                class="h-8 w-full rounded-m"
                                placeholder="Harga minimum"
                            />
                        </div>
                        <div class="flex items-center p-1">
                            <b class="h-8 p-1 bg-gray-300">Rp</b>
                            <input
                                type="number"
                                name="max_price"
                                :value="max_price"
                                v-on:keyup.enter="setMaxPrice"
                                class="h-8 w-full rounded-m"
                                placeholder="Harga maximum"
                            />
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';
import Label from '../Jetstream/Label.vue';

export default {
    components: { Label },
    props: ['query'],
    data() {
        return {
            filters: {
                category: {
                    status: true,
                    male: true,
                    woman: true,
                },
                condition: true,
                price: true,
            },
            isActive: this.query.category,
            ctgry: [],
            condition: [this.query.condition],
            min_price: this.query.min_price,
            max_price: this.query.max_price,
            params: {
                search: this.query.search,
                category: this.query.category,
                min_price: this.query.min_price,
                max_price: this.query.max_price,
                condition: this.query.condition,
                low: this.query.low,
                height: this.query.height,
                latest: this.query.latest,
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
        condition: function () {
            this.params.condition = this.condition[0];
        },
        ctgry: function () {
            if (this.ctgry.length > 1) {
                this.ctgry.shift();
                this.isActive = this.ctgry[0];
                this.params.category = this.ctgry[0];
            } else if (this.ctgry.length < 1) {
                this.isActive = null;
                this.params.category = null;
            } else {
                this.isActive = this.ctgry[0];
                this.params.category = this.ctgry[0];
            }
        },
        min_price: function () {
            this.params.min_price = this.min_price;
        },
        max_price: function () {
            this.params.max_price = this.max_price;
        },
    },
    methods: {
        uncheckOther() {
            this.condition.shift();
        },
        setMinPrice(e) {
            this.min_price = e.path[0].value;
        },
        setMaxPrice(e) {
            this.max_price = e.path[0].value;
        },
        activate(el) {
            console.log(el === this.isActive);
            this.isActive === el
                ? (this.isActive = null)
                : (this.isActive = el);
        },
    },
};
</script>

<style></style>
