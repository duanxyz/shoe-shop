<template>
    <nav class="bg-white border-b border-gray-100 fixed w-full">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center space-x-7">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <inertia-link :href="route('dashboard')">
                            <div
                                class="block font-bold text-blue-500 tracking-widest text-xl font-mono"
                            >
                                Kasut
                            </div>
                        </inertia-link>
                    </div>
                </div>
                <category-dropdown />
                <!-- Search -->
                <search />

                <basket-dropdown />

                <button
                    class="cursor-pointer hover:bg-gray-200 py-1 px-2 focus:outline-none"
                >
                    <font-awesome-icon icon="bell" class="text-gray-400" />
                </button>

                <message-dropdown />

                <!-- Settings Dropdown -->
                <user-dropdown />

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <jet-responsive-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                    Dashboard
                </jet-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3" >
                        <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                    </div>

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')">
                        Profile
                    </jet-responsive-nav-link>

                    <jet-responsive-nav-link :href="route('api-tokens.index')" :active="route().current('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                        API Tokens
                    </jet-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" @submit.prevent="logout">
                        <jet-responsive-nav-link as="button">
                            Logout
                        </jet-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import Search from "@/components/Search";
import UserDropdown from "@/components/Dropdowns/UserDropdown";
import BasketDropdown from "@/components/Dropdowns/BasketDropdown";
import MessageDropdown from "@/components/Dropdowns/MessageDropdown.vue";
import CategoryDropdown from "@/components/Dropdowns/CategoryDropdown.vue";

export default {
    name: "Navbar",
    components: {
        JetResponsiveNavLink,
        Search,
        UserDropdown,
        BasketDropdown,
        MessageDropdown,
        CategoryDropdown,
        JetDropdownLink,
    },
    data() {
        return {
            showingNavigationDropdown: false,
        };
    },

    methods: {
        switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
        },

        logout() {
            this.$inertia.post(route('logout'));
        },
    },
};
</script>

<style></style>
