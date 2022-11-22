<script setup>
import { onMounted, computed, ref } from 'vue';
import { Link, usePage } from '@inertiajs/inertia-vue3';

const mobile_menu_button = ref(null);
const sidebar = ref(null);
const sub_item = ref(null);
const user = ref(null);
const showingNavigationDropdown = ref(false);
const showingAppsDropdown = ref(false);
const active_menu = '';

defineProps({
    theme :Object,
});

onMounted(() => {
    mobile_menu_button.value.addEventListener('click', ()=>{
        sidebar.value.classList.toggle('-translate-x-full');
    });
    CheckAdminMenu();
    CheckAppsMenu();
});

const toggle_menu = () => {
    showingNavigationDropdown.value = showingNavigationDropdown.value ? false : true;
}

const toggle_menu_apps = () => {
    showingAppsDropdown.value = showingAppsDropdown.value ? false : true;
}

const CheckAdminMenu = () => {
    let roles = usePage().url.value.includes('roles');
    let permissions = usePage().url.value.includes('permissions');
    let users = usePage().url.value.includes('users');
    let groups = usePage().url.value.includes('groups');
    let apps = usePage().url.value.includes('admin/apps');
    let databases = usePage().url.value.includes('admin/databases');
    if(roles || permissions || users || groups || apps || databases){
        showingNavigationDropdown.value = true;
    }
}

const CheckAppsMenu = () => {
    let apps = usePage().url.value.includes('apps/home');
    let ecommerce = usePage().url.value.includes('admin/ecommerce');
    if(apps|| ecommerce){
        showingAppsDropdown.value = true;
    }
}
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
        background-color: v-bind('theme.menu_active_color');
        color: white;
    }
    .active-menu:hover{
        background-color: v-bind('theme.menu_active_color');
        opacity: 0.8;
        color:white;
    }
</style>


<template>
    <!-- Mobile Menu -->
    <div :class="theme.bg_color" class="bg-gray-200 text-gray-900 flex justify-between md:hidden z-100">
        <Link :href="route('dashboard')" class="block p-4 text-gray-900 font-bold">Regcalls</Link>
        <button ref="mobile_menu_button" class="p-4 focus:outline-none focus:bg-gray-900 focus:text-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
            </svg>
        </button>
    </div>
    <!-- Sidebar -->
    <div ref="sidebar" :class="theme.bg_color" class="bg-gray-50 z-50 text-gray-900 w-64 absolute inset-y-0 left-0 transform -translate-x-full transition duration-200 ease-in-out md:relative md:translate-x-0">
        <Link :href="route('dashboard')" class="text-gray-800 flex items-center space-x-2 py-4 px-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
            </svg>
            <span class="text-2xl font-extrabold">Regcalls</span>
        </Link>
        <nav class=" mx-2">
            <ul class="">
                <li>
                    <Link :href="route('dashboard')" :class="theme.menu_color, theme.menu_hover_color,{ 'active-menu' : $page.component === 'Dashboard' }"  class=" flex space-x-1 text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800  rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span>{{ $t('Home') }}</span>
                    </Link>
                </li>
                <li v-show="$page.props.profileName !='User'">
                    <a @click="toggle_menu" :class="theme.menu_color, theme.menu_hover_color" class="flex justify-between text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800  rounded">
                        <div class="flex space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                            <div>
                                <span>{{ $t('Admin') }}</span>
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
                        <li><Link :href="route('roles.index')" :class="theme.menu_color, theme.menu_hover_color,{ 'active-menu': $page.component === 'Authorization/Roles' }" class="block  text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800 rounded">{{ $t('Roles') }}</Link></li>
                        <li><Link :href="route('permissions.index')" :class="theme.menu_color, theme.menu_hover_color,{ 'active-menu': $page.component === 'Authorization/Permissions' }" class="block  text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800 rounded">{{ $t('Permissions') }}</Link></li>
                        <li><Link :href="route('users.index')" :class="theme.menu_color, theme.menu_hover_color,{ 'active-menu': $page.component === 'Users/Index' || $page.component === 'Users/Edit' }" class="block  text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800 rounded">{{ $t('Users') }}</Link></li>
                        <li><Link :href="route('groups.index')" :class="theme.menu_color, theme.menu_hover_color,{ 'active-menu': $page.component === 'Groups/Index' || $page.component === 'Groups/Edit' }" class="block  text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800 rounded">{{ $t('Groups') }}</Link></li>
                        <li><Link :href="route('apps.index')" :class="theme.menu_color, theme.menu_hover_color,{ 'active-menu': $page.component === 'Apps/Index' }" class="block  text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800 rounded">{{ $t('Apps') }}</Link></li>
                        <li><Link :href="route('databases.index')" :class="theme.menu_color, theme.menu_hover_color,{ 'active-menu': $page.component === 'Databases/Index' || $page.component === 'Databases/Edit'}" class="block  text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800 rounded">{{ $t('Databases') }}</Link></li>
                    </ul>
                </transition>
                </li>
                <li>
                    <Link :href="route('translations')" :class="theme.menu_color, theme.menu_hover_color,{ 'active-menu': $page.component.startsWith('Language') }" class="flex space-x-1 text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <span>{{ $t('Translations') }}</span>
                    </Link>
                </li>
                <li v-if="$page.props.groupApps.length>0">
                    <a @click="toggle_menu_apps" :class="theme.menu_color, theme.menu_hover_color" class="flex justify-between text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800  rounded">
                        <div class="flex space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                            </svg>
                            <div>
                                <span>{{ $t('Apps') }}</span>
                            </div>
                        </div>
                        <span>
                            <svg v-if="showingAppsDropdown" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-transform ease-in-out">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-transform ease-in-out">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </span>
                    </a>
                    <transition name="fade">
                    <ul v-if="showingAppsDropdown" ref="sub_item" class="ml-2 border-l border-dashed border-amber-300 pl-2 ease-in-out duration-300">
                        <li v-for="app in $page.props.groupApps" :key="app.app_key"><Link :href="route('apps.home',[app.app_key,app.title_en])" :class="theme.menu_color, theme.menu_hover_color,{ 'active-menu': $page.component === 'Apps/Home/'+app.app_key || $page.component.startsWith('Apps/'+app.title_en) }" class="block  text-gray-900 py-2 5 px-4 bg-gray-200 my-2 hover:bg-slate-300 hover:text-gray-800 rounded">{{ app.title_en }}</Link></li>
                    </ul>
                </transition>
                </li>
            </ul>
        </nav>
    </div>
</template>
