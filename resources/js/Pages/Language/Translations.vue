<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
    crumbs: Array
});

</script>
<style scoped>
.active-menu {
    color: white;
    background-color: rgb(55 65 81) !important;
}
</style>
<template>
    <AppLayout title="Translations" :crumbs="crumbs">
        <div class="py-6">
            <div class="mx-auto sm:px-6 lg:px-4">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="flex justify-center space-x-2">
                        <Link :href="route('translations')">
                            <button :class="{ 'active-menu': $page.component === 'Language/AddNew' }" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 md:py-2 px-4 rounded inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            <span class="hidden md:block">{{ $t('New') }}</span>
                        </button>
                        </Link>
                        <Link :href="route('translations_en')">
                            <button :class="{ 'active-menu': $page.component === 'Language/English' }" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                <img :src="'/storage/Root/england.png'" class="w-6 md:w-7 mr-2">
                                    <span class="hidden md:block">{{ $t('English') }}</span>
                            </button>
                        </Link>
                        <Link :href="route('translations_pt')">
                            <button :class="{ 'active-menu': $page.component === 'Language/Portuguese' }" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                <img :src="'/storage/Root/Brazil.png'" class="w-6 md:w-7 mr-2">
                                <span class="hidden md:block">{{ $t('Portuguese') }}</span>
                            </button>
                        </Link>

                    </div>

                    <div class="my-4">
                        <slot>

                        </slot>
                    </div>

                    <!-- <div v-else-if="button=='pt'" class="my-4">
                        <Portuguese></Portuguese>
                    </div>
                    <div v-else class="my-4">
                        <AddNew></AddNew>
                    </div> -->

                </div>
            </div>
        </div>
    </AppLayout>
</template>
