<template>
    <div class="relative">
        <div @mouseover="open = true" @mouseleave="open = false">
            <slot name="trigger"></slot>
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <!-- <div
            v-show="open"
            class="fixed inset-0 z-40"
            @click="open = false"
        ></div> -->

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95"
        >
            <div
                v-show="open"
                class="absolute z-50 mt-2 rounded-md shadow-lg"
                :class="[widthClass, alignmentClasses, marginClass]"
                style="display: none"
                @mouseover="open = true"
                @mouseleave="open = false"
            >
                <div class="rounded-md shadow-xs" :class="contentClasses">
                    <slot name="content"></slot>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    props: {
        align: {
            default: "right",
        },
        width: {
            default: "48",
        },
        margin: {
            default: "5",
        },
        contentClasses: {
            default: () => ["py-1", "bg-white"],
        },
    },

    data() {
        return {
            open: false,
        };
    },

    created() {
        const closeOnEscape = (e) => {
            if (this.open && e.keyCode === 27) {
                this.open = false;
            }
        };

        this.$once("hook:destroyed", () => {
            document.removeEventListener("keydown", closeOnEscape);
        });

        document.addEventListener("keydown", closeOnEscape);
    },

    computed: {
        widthClass() {
            return {
                48: "w-48",
                96: "w-96",
            }[this.width.toString()];
        },
        marginClass() {
            return {
                5: "-mr-5",
                20: "-mr-20",
                40: "-mr-40",
                60: "-mr-60",
            }[this.margin.toString()];
        },

        alignmentClasses() {
            console.log(this.align);
            if (this.align == "left") {
                return "origin-top-left left-0";
            } else if (this.align == "right") {
                return "origin-top-right right-0";
            } else {
                return "origin-top";
            }
        },
    },
};
</script>
