<script setup>
import { onMounted, ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import LanguageSelector from '../Components/admin/layout/LanguageSelector.vue';
import BreadCumbs from '../Components/admin/layout/BreadCumbs.vue';
import Swal from 'sweetalert2';

const mobile_menu_button = ref(null);
const sidebar = ref(null);
const sub_item = ref(null);
const settings = ref(null);
const showingNavigationDropdown = ref(false);

defineProps({
    title: String,
    crumbs :Array,
});

onMounted(() => {
    mobile_menu_button.value.addEventListener('click', ()=>{
        sidebar.value.classList.toggle('-translate-x-full');
    });



});


const toggle_menu = () => {
    showingNavigationDropdown.value = showingNavigationDropdown.value ? false : true;
}

const openSettings = () => {
    if(settings.value.classList.contains('block')){
        settings.value.classList.toggle('hidden');
        settings.value.classList.remove('block');
    }
    else{
        settings.value.classList.toggle('block');
        settings.value.classList.toggle('transition-all');
        settings.value.classList.toggle('duration-500');
        settings.value.classList.remove('hidden');
        settings.value.focus();
    }

}

const closeSettings = () => {
    settings.value.classList.toggle('hidden');
    settings.value.classList.remove('block');
}

const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    Inertia.post(route('logout'));
};
</script>
<style scoped>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity .5s ease;
    }
    .fade-enter{
        transition: opacity .5s ease;
    }
    .fade-leave-to {
        opacity: 0
    }
    .active-menu {
        background-color: rgb(55 65 81) !important;
        color: white
    }
    .active-menu:hover{
        background-color: rgb(75 85 99) !important;
        color:white;
    }
</style>
<template>
    <div class="bg-gray-300">
        <Head :title="title" ></Head>

        <div class="relative min-h-screen bg-gray-200 md:flex">
            <!-- Mobile Menu -->
            <div class="bg-gray-50 text-gray-900 flex justify-between md:hidden">
                <Link :href="route('dashboard')" class="block p-4 text-gray-900 font-bold">Dashboard</Link>
                <button ref="mobile_menu_button" class="p-4 focus:outline-none focus:bg-gray-900 focus:text-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>

                </button>
            </div>
            <!-- Sidebar -->
            <div ref="sidebar" class="bg-gray-50 text-gray-900 w-64 absolute inset-y-0 left-0 transform -translate-x-full transition duration-200 ease-in-out md:relative md:translate-x-0">
                <Link :href="route('dashboard')" class="text-gray-800 flex items-center space-x-2 py-4 px-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />

                    </svg>
                    <span class="text-2xl font-extrabold">Dashboard</span>
                </Link>
                <nav class=" mx-2">
                    <ul class="">
                        <li>
                            <Link :href="route('dashboard')" :class="{ 'active-menu': $page.component === 'Dashboard' }" class=" flex space-x-1 text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800  rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <span>Home</span>
                            </Link>
                        </li>
                        <li>
                            <a @click="toggle_menu" class="flex  justify-between text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800  rounded">
                                <div class="flex space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                    </svg>
                                    <div>
                                        <span>Menu</span>
                                    </div>
                                </div>
                                <span>
                                    <svg v-if="showingNavigationDropdown" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-transform ease-in-out">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                    <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-transform ease-in-out">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </span>
                            </a>
                            <transition name="fade">
                            <ul v-if="showingNavigationDropdown" ref="sub_item" class="ml-2 border-l border-dashed border-amber-300 pl-2 ease-in-out duration-300">
                                <li><a href="" class="block  text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800 rounded">Submenu</a></li>
                                <li><a href="" class="block  text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800 rounded">Submenu</a></li>
                            </ul>
                        </transition>
                        </li>
                        <li>
                            <a href="" class="flex space-x-1 text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800  rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <span>{{ $t('My Profile') }}</span>
                            </a>
                        </li>
                        <li>
                            <Link :href="route('translations')" :class="{ 'active-menu': $page.component.startsWith('Language') }" class="flex space-x-1 text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <span>{{ $t('Translations') }}</span>
                            </Link>
                        </li>

                    </ul>
                </nav>
            </div>
            <div class="flex-1">
                <div class="bg-gray-50 text-gray-900 md:py-4 py-2 flex items-center justify-between px-4 ">
                    <div>
                        <BreadCumbs :crumbs="crumbs"></BreadCumbs>
                    </div>
                    <div class="flex space-x-2 items-center">
                        <LanguageSelector></LanguageSelector>

                        <div @click="openSettings">
                            <div class="text-sm">{{$page.props.user.name}}</div>
                            <div class="flex items-end justify-end cursor-pointer">
                                <div class="text-sm text-right">Super Admin </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>

                            </div>
                        </div>
                        <div @focusout="closeSettings" tabindex="-1">
                            <transition enter-active-class="animated fadeIn" leave-active-class="animated fadeOut" mode="out-in">
                            <div ref="settings" class="transition-all duration-500 ease-in-out hidden text-gray-600 absolute top-32 right-4 md:top-20 md:right-4 bg-white rounded-md w-48 border-solid border-gray-500 border-1 z-50">
                                <a :href="route('profile.show')">
                                    <div class=" flex-1 py-2 px-4 border border-solid border-gray-400 rounded-t-md cursor-pointer hover:bg-gray-200 transition-color duration-300 delay-100">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 float-left">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            Profile
                                    </div>
                                </a>
                                <a href="" >
                                    <div class=" flex-1 py-2 px-4 border-x border-solid border-gray-400 cursor-pointer hover:bg-gray-200 transition-color duration-300 delay-100">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 float-left">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>

                                        Settings

                                    </div>
                                </a>
                                <form @click.prevent="logout">
                                    <div class=" flex-1 py-2 px-4  border border-solid border-gray-400 rounded-b-md cursor-pointer hover:bg-gray-200 transition-color duration-300 delay-100">

                                            <a>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 float-left">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                                </svg>
                                            Logout
                                            </a>

                                    </div>
                                </form>
                            </div>
                            </transition>
                        </div>
                        <div @click="openSettings" v-if="$page.props.jetstream.managesProfilePhotos" class="hidden md:block h-10 w-10 rounded-full bg-gradient-to-r from-sky-400 to-blue-600 p-0.5">
                            <img class="h-full w-full rounded-full border-2 border-white object-cover object-center dark:border-navy-700" :alt="$page.props.user.name" :src="$page.props.user.profile_photo_url" alt="image">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="bg-red-500 text-white px-6 py-2"  v-if="$page.props.flash.message && $page.props.flash.type=='error'">
                        <span class="flex"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>

                        {{$page.props.flash.message}}</span>

                    </div>
                    <div class="bg-green-500 text-white px-6 py-2"  v-if="$page.props.flash.message && $page.props.flash.type=='success'">
                        <span class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
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

