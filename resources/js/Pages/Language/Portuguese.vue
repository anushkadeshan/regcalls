<script>
import pt from '/lang/pt.json';
import Modal from '../../Components/pages/Modal.vue';
import Translations from './Translations.vue';

export default {
    data (){
        return{
            crumbs:['Translations','Portuguese'],
            isShowModal: false,
            size: 'w-11/12 mx-auto',
            pt: pt,
            form: this.$inertia.form({
                lang_key: '',
                lang_value: '',
            })
        }
    },
    methods: {
        showMyModel: function (key,value){
            this.isShowModal = true;
            this.form.lang_key = key;
            this.form.lang_value = value;
        },
        SaveTranslation: function () {
            this.form.post(route('editPtTranslation'),{
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    console.log("success");
                },
            });
        }
    },
    components: {
    Modal,
    Translations
}
}
</script>

<template>
    <Translations :crumbs="crumbs">
        <div class="md:overflow-y-auto md:h-96">
            <div class="flex justify-between bg-gray-100 border border-gray-300">
                <div class="px-4 py-2 w-6/12 font-bold">
                    {{ $t('Key') }}
                </div>
                <div class="px-4 py-2 w-6/12 font-bold">
                    {{ $t('Portuguese') }}
                </div>
            </div>
            <div v-for="(value, key) in pt"  :key="key" class="flex justify-between bg-gray-50 border border-gray-200">
                <div class="px-4 py-2 w-6/12">
                    {{key}}
                </div>

                <div class="flex justify-between px-4 py-2 w-6/12">
                    <div>
                        {{value}}
                    </div>
                    <div class="cursor-pointer" @click="showMyModel(key,value)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <Teleport to="body">
            <!-- use the modal component, pass in the prop -->
            <Modal :show="isShowModal" @close="isShowModal = false" :size="size">
                <template #header>
                    <h3>{{form.lang_key}}</h3>
                </template>
                <template #body>
                    <input type="text" v-model="form.lang_value" class="py-1 px-2 rounded bg-gray-50 w-full border border-gray-400">
                </template>
                <template #footer>
                    <button @click="SaveTranslation" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </template>
            </Modal>
        </Teleport>
    </Translations>
</template>
