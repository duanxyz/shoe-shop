<template>
    <div>
        <jet-dropdown align="right" width="48" margin="20">
            <template #trigger>
                <button
                    class="cursor-pointer rounded-lg hover:bg-gray-200 py-1 px-2 focus:outline-none"
                >
                    <font-awesome-icon
                        icon="envelope"
                        class="text-gray-400 cursor-pointer"
                    />
                </button>
            </template>

            <template #content>
                <jet-dropdown-link :href="route('profile.show')">
                    Chat
                </jet-dropdown-link>
                <jet-dropdown-link :href="route('profile.show')">
                    Diskusi
                </jet-dropdown-link>
                <jet-dropdown-link :href="route('profile.show')">
                    Ulasan
                </jet-dropdown-link>
            </template>
        </jet-dropdown>
    </div>
</template>

<script>
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";

export default {
    name: "MessageDropdown",
    components: {
        JetDropdown,
        JetDropdownLink,
    },
};
</script>

<style></style>
