<template>
    <div class="min-h-screen bg-gray-50">
        <!-- <jet-banner /> -->

        <navbar/>

        <!-- Page Content -->
        <main>
            <slot></slot>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple> </portal-target>
    </div>
</template>

<script>
    // import JetBanner from '@/Jetstream/Banner'
    import Navbar from '@/components/Navbars/Navbar'

    export default {
        components: {
            // JetBanner,
            Navbar,
        },
    }
</script>
