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
                                        class="hover:bg-gray-200 rounded-sm p-1 cursor-pointer"
                                    >
                                        <span>
                                            {{ category.name }}
                                        </span>
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
                                        class="hover:bg-gray-200 rounded-sm p-1 cursor-pointer"
                                    >
                                        <span>
                                            {{ category.name }}
                                        </span>
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
                                name="baru"
                                class="rounded-sm cursor-pointer"
                            />
                            <span>Baru</span>
                        </div>
                        <div>
                            <input
                                type="checkbox"
                                name="bekas"
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
                                class="h-8 w-full rounded-m"
                                placeholder="Harga minimum"
                            />
                        </div>
                        <div class="flex items-center p-1">
                            <b class="h-8 p-1 bg-gray-300">Rp</b>
                            <input
                                type="number"
                                name="max_price"
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
export default {
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
        };
    },
};
</script>

<style></style>
