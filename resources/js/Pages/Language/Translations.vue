<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import English from './English.vue';
import Portuguese from './Portuguese.vue';
import AddNew from './AddNew.vue';

const button = ref("new");
const activeClass = 'bg-gray-800';
const SelectLang = (lang) => {
    if(lang == 'new'){
        button.value = 'new'
    }
    else{
        button.value =  lang =='en' ? 'en' : 'pt';
    }

}
const crumbs = ['Translations','Add/Edit'];
</script>

<template>
    <AppLayout title="Translations" :crumbs="crumbs">
        <div class="py-6">
            <div class="mx-auto sm:px-6 lg:px-4">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="flex justify-center space-x-2">
                        <button @click="SelectLang('new')"  class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>New</span>
                        </button>
                        <button @click="SelectLang('en')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                        <img :src="'../storage/Root/england.png'" class="w-6 md:w-7 mr-2">
                            <span>English</span>
                        </button>
                        <button @click="SelectLang('pt')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                            <img :src="'../storage/Root/Brazil.png'" class="w-6 md:w-7 mr-2">
                            <span>Portuguese</span>
                        </button>
                    </div>

                    <div v-if="button=='en'" class="my-4">
                        <English></English>
                    </div>

                    <div v-else-if="button=='pt'" class="my-4">
                        <Portuguese></Portuguese>
                    </div>
                    <div v-else class="my-4">
                        <AddNew></AddNew>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
