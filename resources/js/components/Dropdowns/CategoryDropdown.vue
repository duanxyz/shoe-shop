<template>
    <div class="flex">
        <jet-dropdown align="right" width="96" margin="60">
            <template #trigger>
                <button
                    class="text-gray-400 font-mono text-xs hover:bg-gray-100 rounded-md p-1"
                >
                    Kategori
                </button>
            </template>

            <template #content>
                <div class="flex rounded-lg shadow-lg">
                    <div class="ring-1 ring-black ring-opacity-5 bg-white">
                        <div
                            class="relative grid gap-3 sm:p-2 text-gray-500 font-semibold text-sm"
                        >
                            <a
                                @mouseover="isVisible = false"
                                href="#"
                                class="p-2 items-start rounded-lg hover:bg-gray-50"
                            >
                                Sepatu Pria
                            </a>
                            <a
                                @mouseover="isVisible = true"
                                @mouseleave="isVisible = false"
                                href="#"
                                class="items-start rounded-lg hover:bg-gray-50"
                            >
                                Sepatu Wanita
                            </a>
                        </div>
                    </div>
                    <div class="border-r-2 border-gray-200"></div>
                    <div
                        class="relative grid gap-3 sm:p-2 text-gray-500 font-semibold text-sm"
                    >
                        <div v-if="isVisible">
                            <div
                                v-for="(category, index) in $page.props
                                    .categories.woman"
                                :key="index"
                            >
                                <a
                                    href="#"
                                    class="items-start rounded-lg hover:bg-gray-50"
                                >
                                    {{ category.name }}
                                </a>
                            </div>
                        </div>
                        <div v-else>
                            <div
                                v-for="(category, index) in $page.props
                                    .categories.male"
                                :key="index"
                            >
                                <a
                                    href="#"
                                    class="items-start rounded-lg hover:bg-gray-50"
                                >
                                    {{ category.name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </jet-dropdown>
    </div>
</template>

<script>
import JetDropdown from '@/Jetstream/Dropdown';

export default {
    name: 'CategoryDropdown',
    components: {
        JetDropdown,
    },
    data() {
        return {
            isVisible: false,
        };
    },
};
</script>

<style></style>
