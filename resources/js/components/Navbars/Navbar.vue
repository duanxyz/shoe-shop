<template>
    <nav class="bg-white border-b border-gray-100 fixed w-full">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center space-x-7">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <inertia-link :href="route('dashboard')">
                            <!-- <jet-application-mark class="block h-9 w-auto" /> -->
                            <div
                                class="block font-bold text-blue-500 tracking-widest text-xl font-mono"
                            >
                                Kasut
                            </div>
                        </inertia-link>
                    </div>
                </div>
                <button class="text-gray-400 font-mono">Kategori</button>
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
                    <button
                        @click="
                            showingNavigationDropdown = !showingNavigationDropdown
                        "
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                    >
                        <svg
                            class="h-6 w-6"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                :class="{
                                    hidden: showingNavigationDropdown,
                                    'inline-flex': !showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex': showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div
            :class="{
                block: showingNavigationDropdown,
                hidden: !showingNavigationDropdown,
            }"
            class="sm:hidden"
        >
            <div class="pt-2 pb-3 space-y-1">
                <jet-responsive-nav-link
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                >
                    Dashboard
                </jet-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <img
                            class="h-10 w-10 rounded-full"
                            :src="$page.user.profile_photo_url"
                            :alt="$page.user.name"
                        />
                    </div>

                    <div class="ml-3">
                        <div class="font-medium text-base text-gray-800">
                            {{ $page.user.name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">
                            {{ $page.user.email }}
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <jet-responsive-nav-link
                        :href="route('profile.show')"
                        :active="route().current('profile.show')"
                    >
                        Profile
                    </jet-responsive-nav-link>

                    <jet-responsive-nav-link
                        :href="route('api-tokens.index')"
                        :active="route().current('api-tokens.index')"
                        v-if="$page.jetstream.hasApiFeatures"
                    >
                        API Tokens
                    </jet-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" @submit.prevent="logout">
                        <jet-responsive-nav-link as="button">
                            Logout
                        </jet-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    <template v-if="$page.jetstream.hasTeamFeatures">
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Manage Team
                        </div>

                        <!-- Team Settings -->
                        <jet-responsive-nav-link
                            :href="route('teams.show', $page.user.current_team)"
                            :active="route().current('teams.show')"
                        >
                            Team Settings
                        </jet-responsive-nav-link>

                        <jet-responsive-nav-link
                            :href="route('teams.create')"
                            :active="route().current('teams.create')"
                        >
                            Create New Team
                        </jet-responsive-nav-link>

                        <div class="border-t border-gray-200"></div>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Switch Teams
                        </div>

                        <template v-for="team in $page.user.all_teams">
                            <form
                                @submit.prevent="switchToTeam(team)"
                                :key="team.id"
                            >
                                <jet-responsive-nav-link as="button">
                                    <div class="flex items-center">
                                        <svg
                                            v-if="
                                                team.id ==
                                                $page.user.current_team_id
                                            "
                                            class="mr-2 h-5 w-5 text-green-400"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                            ></path>
                                        </svg>
                                        <div>{{ team.name }}</div>
                                    </div>
                                </jet-responsive-nav-link>
                            </form>
                        </template>
                    </template>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetNavLink from "@/Jetstream/NavLink";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import Search from "@/components/Search";
import UserDropdown from "@/components/Dropdowns/UserDropdown";
import BasketDropdown from "@/components/Dropdowns/BasketDropdown";
import MessageDropdown from "@/components/Cards/MessageDropdown.vue";

export default {
    name: "Navbar",
    components: {
        JetApplicationMark,
        JetNavLink,
        JetResponsiveNavLink,
        Search,
        UserDropdown,
        BasketDropdown,
        MessageDropdown,
    },
    data() {
        return {
            showingNavigationDropdown: false,
        };
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id,
                },
                {
                    preserveState: false,
                }
            );
        },

        logout() {
            axios.post(route("logout").url()).then((response) => {
                window.location = "/";
            });
        },
    },
};
</script>

<style></style>
