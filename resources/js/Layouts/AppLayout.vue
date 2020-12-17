<template>
    <div class="min-h-screen bg-gray-50">
        <navbar :carts="carts" />

        <!-- Page Content -->
        <main>
            <slot></slot>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple> </portal-target>
    </div>
</template>

<script>
import Navbar from "@/components/Navbars/Navbar.vue";
export default {
    components: { Navbar },
    props: {
        carts: Object,
    },
};
</script>
