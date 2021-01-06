<template>
    <app-layout>
        <div class="pt-24 pb-12">
            <div class="max-w-none mx-auto">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-10"
                >
                    <ol class="flex gap-1">
                        <li>
                            <a
                                href="#"
                                class="text-blue-400 hover:text-blue-500"
                                >Home</a
                            >
                            <font-awesome-icon
                                icon="caret-right"
                                class="text-gray-400"
                            />
                        </li>
                        <li>
                            <a
                                href="#"
                                class="text-blue-400 hover:text-blue-500"
                                >Sepatu
                                {{
                                    item.category.name.includes('Pria')
                                        ? 'Pria'
                                        : 'Wanita'
                                }}</a
                            >
                            <font-awesome-icon
                                icon="caret-right"
                                class="text-gray-400"
                            />
                        </li>
                        <li>
                            <a
                                href="#"
                                class="text-blue-400 hover:text-blue-500"
                                >{{ item.category.name }}</a
                            >
                            <font-awesome-icon
                                icon="caret-right"
                                class="text-gray-400"
                            />
                        </li>
                        <li>
                            {{ item.name }}
                        </li>
                    </ol>
                    <div class="py-10 flex">
                        <div class="w-2/5">
                            <div class="mb-5">
                                <img
                                    :src="
                                        '../img/items/' +
                                        (photo_url
                                            ? photo_url
                                            : item.photos[0].photo_url)
                                    "
                                    class="rounded-lg"
                                />
                            </div>
                            <div class="flex gap-4">
                                <img
                                    v-for="(photo, index) in item.photos"
                                    :key="index"
                                    id="miniImg"
                                    v-on:click="isActivePhoto(photo.photo_url)"
                                    :src="'../img/items/' + photo.photo_url"
                                    class="h-24 rounded-lg hover:shadow-xl cursor-pointer"
                                />
                            </div>
                        </div>
                        <div class="pl-16 w-3/6">
                            <div class="heading">
                                <h1 class="text-lg font-bold">
                                    {{ item.name }}
                                </h1>
                                <div class="text-gray-500">
                                    <rating
                                        v-model="rating"
                                        class="inline-flex"
                                    />
                                    <span>
                                        <b>
                                            Terjual
                                            {{ item.sold | curency }} Produk
                                        </b>
                                    </span>
                                    <span>
                                        <b> {{ item.seen | curency }} x </b>
                                        Dilihat
                                    </span>
                                </div>
                            </div>
                            <hr class="border-gray-300" />
                            <div class="flex py-3 gap-14">
                                <dt
                                    class="font-bold uppercase text-sm text-gray-500"
                                >
                                    Harga
                                </dt>
                                <dd class="text-2xl font-bold text-yellow-500">
                                    Rp{{ item.price | curency }}
                                </dd>
                            </div>
                            <hr class="border-gray-300" />
                            <div class="flex py-3 gap-14">
                                <dt
                                    class="font-bold uppercase text-sm text-gray-500"
                                >
                                    Jumlah
                                </dt>
                                <dd class="text-2xl">
                                    <font-awesome-icon
                                        v-on:click="
                                            totalItem > 1
                                                ? (totalItem -= 1)
                                                : none
                                        "
                                        icon="minus-circle"
                                        :class="
                                            totalItem === 1
                                                ? 'text-gray-400'
                                                : 'text-green-500'
                                        "
                                    />
                                    <input
                                        type="text"
                                        name="total"
                                        id="totalItem"
                                        :value="totalItem"
                                        class="border-0 border-b focus:ring-0 w-14 text-center"
                                    />
                                    <font-awesome-icon
                                        v-on:click="totalItem += 1"
                                        icon="plus-circle"
                                        class="text-green-500"
                                    />
                                    <span class="text-sm"
                                        >Min. pembelian 1pcs.</span
                                    >
                                </dd>
                            </div>
                            <hr class="border-gray-300" />
                            <div class="flex py-3 gap-14">
                                <dt
                                    class="font-bold uppercase break-words w-1/5 text-sm text-gray-500"
                                >
                                    Info Produk
                                </dt>
                                <dd class="text-base">
                                    <dl class="flex gap-4">
                                        <div>
                                            <dt>
                                                <p>Berat</p>
                                            </dt>
                                            <dd>
                                                <p>
                                                    <b
                                                        >{{
                                                            item.weight
                                                                | curency
                                                        }}gr</b
                                                    >
                                                </p>
                                            </dd>
                                        </div>
                                        <div
                                            class="border-gray-300 h-auto border"
                                        ></div>
                                        <div>
                                            <dt>
                                                <p>Kondisi</p>
                                            </dt>
                                            <dd>
                                                <p>
                                                    <b>{{ item.condition }}</b>
                                                </p>
                                            </dd>
                                        </div>
                                    </dl>
                                </dd>
                            </div>
                            <hr class="border-gray-300" />
                        </div>
                    </div>
                    <hr class="border-gray-300" />

                    <div
                        id="navContent"
                        :class="{
                            'fixed top-20 rounded-full shadow-xl bg-white px-5 pt-4 w-11/12 border': isHandleNav,
                        }"
                    >
                        <ul class="list-reset flex border-b text-gray-400">
                            <li class="-mb-px mr-1">
                                <a
                                    id="listContent"
                                    v-on:click="handleContent"
                                    class="bg-white inline-block py-2 px-4 font-semibold border-b border-blue-400 text-blue-400"
                                    href="#deskripsi"
                                    >Deskripsi</a
                                >
                            </li>
                            <li class="mr-1">
                                <a
                                    id="listContent"
                                    v-on:click="handleContent"
                                    class="bg-white inline-block py-2 px-4 font-semibold"
                                    href="#ulasan"
                                    >Ulasan</a
                                >
                            </li>
                            <li class="mr-1">
                                <a
                                    id="listContent"
                                    v-on:click="handleContent"
                                    class="bg-white inline-block py-2 px-4 font-semibold"
                                    href="#diskusi"
                                    >Diskusi</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div id="deskripsi" class="w-10/12 p-5 h-96">
                        <p>{{ item.description }}</p>
                    </div>
                    <div id="ulasan" class="font-bold text-3xl h-96">
                        ulasan
                    </div>
                    <div id="diskusi" class="font-bold text-3xl h-96">
                        diskusi
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import Rating from '@/components/Rating';

export default {
    components: {
        AppLayout,
        Rating,
    },
    props: ['item'],
    data() {
        return {
            rating: 4,
            totalItem: 1,
            photo_url: null,
            isHandleNav: null,
        };
    },
    methods: {
        isActivePhoto(photo_url) {
            this.photo_url = photo_url;
            const miniImg = document.querySelectorAll('#miniImg');
            miniImg.forEach((img) => img.classList.remove('shadow-xl'));
            event.target.className += ' shadow-xl';
        },
        handleContent() {
            const listContent = document.querySelectorAll('#listContent');
            listContent.forEach((nav) => {
                nav.classList.remove('border-b');
                nav.classList.remove('border-blue-400');
                nav.classList.remove('text-blue-400');
            });
            event.target.className += ' border-b border-blue-400 text-blue-400';
        },
        handleNav(e) {
            if (747 < e.target.scrollingElement.scrollTop) {
                this.isHandleNav = true;
            } else {
                this.isHandleNav = false;
            }
        },
    },
    created() {
        window.addEventListener('scroll', this.handleNav);
    },
    destroyed() {
        window.removeEventListener('scroll', this.handleNav);
    },
};
</script>

<style scoped>
.heading span::before {
    content: '';
    display: inline-block;
    vertical-align: middle;
    width: 4px;
    height: 4px;
    margin: 0px 8px;
    border-radius: 50%;
    background-color: rgb(108, 114, 124);
}
</style>
