<script setup>
import BreadCumbs from './BreadCumbs.vue';

import { ref } from 'vue';
import LanguageSelector from './LanguageSelector.vue';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import Groups from './Groups.vue';
import Profiles from './Profiles.vue';

const settings = ref(null);

defineProps({
    crumbs :Array,
    theme :Object,
});


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
<div :class="theme.bg_color" class="bg-gray-50 text-gray-900 md:py-4 py-2 flex flex-col-reverse md:flex-row items-center md:justify-between px-4 ">
    <div>
        <BreadCumbs :crumbs="crumbs"></BreadCumbs>
    </div>
    <div class="flex space-x-2 items-center md:justify-end justify-between">
        <LanguageSelector></LanguageSelector>
        <Groups :theme="theme"></Groups>
        <Profiles :theme="theme"></Profiles>

        <div @click="openSettings" class="flex flex-col items-end cursor-pointer">
            <div class="text-sm">{{$page.props.user.name}}</div>
            <div class="hidden md:block text-sm text-right text-gray-400">{{$page.props.user.email}}</div>
        </div>
        <div @focusout="closeSettings" tabindex="-1">
            <transition enter-active-class="animated fadeIn" leave-active-class="animated fadeOut" mode="out-in">
            <div ref="settings" class="transition-all duration-500 ease-in-out hidden text-gray-600 absolute top-32 right-4 md:top-20 md:right-4 bg-white rounded-md w-48 border-solid border-gray-500 border-1 z-50">
                <Link :href="route('profile.show')">
                    <div class=" flex-1 py-2 px-4 border border-solid border-gray-400 rounded-t-md cursor-pointer hover:bg-gray-200 transition-color duration-300 delay-100">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 float-left">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $t('Profile') }}
                    </div>
                </Link>
                <Link :href="route('settings.index')" >
                    <div class=" flex-1 py-2 px-4 border-x border-solid border-gray-400 cursor-pointer hover:bg-gray-200 transition-color duration-300 delay-100">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 float-left">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $t('Settings') }}
                    </div>
                </Link>
                <form @click.prevent="logout">
                    <div class=" flex-1 py-2 px-4  border border-solid border-gray-400 rounded-b-md cursor-pointer hover:bg-gray-200 transition-color duration-300 delay-100">
                        <a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 float-left">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            {{ $t('Logout') }}
                        </a>
                    </div>
                </form>
            </div>
            </transition>
        </div>
        <div @click="openSettings" v-if="$page.props.jetstream.managesProfilePhotos" class="hidden md:block h-10 w-10 rounded-full bg-gradient-to-r from-sky-400 to-blue-600 p-0.5">
            <img class="h-full w-full rounded-full border-2 border-white object-cover object-center dark:border-navy-700" :alt="$page.props.user.name" :src="$page.props.user.profile_photo_url">
        </div>
    </div>
</div>
</template>
