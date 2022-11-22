<script>
import { computed } from 'vue'
import { Head, usePage } from '@inertiajs/inertia-vue3';
import Sidebar from '../Components/admin/layout/Sidebar.vue';
import Navbar from '../Components/admin/layout/Navbar.vue';

export default {
    props:{
        title: String,
        crumbs :Array,
    },
    components:{
        Head,Sidebar,Navbar
    },

    data() {
        return {
            theme : usePage().props.value.theme
        }
    },
}

</script>

<template>
    <div class="bg-gray-300">
        <Head :title="title" ></Head>
        <div class="relative min-h-screen bg-gray-100 md:flex">
            <Sidebar :theme="theme"></Sidebar>
            <div class="flex-1">
                <Navbar :crumbs="crumbs" :theme="theme" ></Navbar>
                <div>
                    <div class="bg-red-500 text-white px-6 py-2"  v-if="$page.props.flash.message_trnaslation && $page.props.flash.type_trnaslation=='error'">
                        <span class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>

                        {{$page.props.flash.message}}</span>

                    </div>
                    <div class="bg-green-500 text-white px-6 py-2"  v-if="$page.props.flash.message_trnaslation && $page.props.flash.type_trnaslation=='success'">
                        <span class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        {{$page.props.flash.message}}
                        </span>

                    </div>
                    <main class="mx-2">
                        <slot></slot>
                    </main>

                </div>
            </div>

            <!-- Page Heading
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>


            <main>
                <slot />
            </main>
            -->
        </div>
    </div>

</template>

