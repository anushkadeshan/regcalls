<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import Modal from '../../Components/pages/Modal.vue';
import AppsTable from './AppsTable.vue';
import { trans } from 'laravel-vue-i18n';
import PermissionError from '../../Components/pages/PermissionError.vue';

export default {
    props : {
        apps : Object
    },
    components: {
        AppLayout,
        Modal,
        AppsTable,
        PermissionError
    },
    data () {
        return {
            crumbs : ['Apps','All'],
            showModal: false,
            size: 'w-11/12 mx-auto',
            form : this.$inertia.form({
                app_key : null,
                title_en : null,
                title_pt : null,
                description_en : null,
                description_pt : null,
                image : null,
            })
        }
    },
    methods : {
        submit : function() {
            this.form.post((route('apps.store')),{
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                    this.showModal = false;
                    this.form.reset();
                },

                onError: (errors) => {
                    console.log(errors);
                },
            });
        }
    }
}
</script>

<template lang="">
    <AppLayout title="Apps" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                    <div class="flex justify-end" v-if="$page.props.currentPermissions.includes('Create Apps')">
                        <button class="bg-gray-800 hover:bg-gray-700 transition-color duration-300 delay-100 text-white rounded px-4 py-2" id="show-modal" @click="showModal = true">{{ $t('Add New') }}</button>
                    </div>
                    <AppsTable v-if="$page.props.currentPermissions.includes('View Apps')" :apps="apps"></AppsTable>
                    <div v-else>
                        <PermissionError></PermissionError>
                    </div>
                </div>

            </div>
        </div>
        <Teleport to="body">
            <!-- use the modal component, pass in the prop -->
            <form @submit.prevent="submit">
            <Modal :show="showModal" @close="showModal = false" :size="size">
                <template #header>
                    <h3>{{ $t('Add New App') }}</h3>
                </template>
                <template #body>
                    <div class="md:flex md:flex-row flex-cols space-y-2 md:space-x-2">
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('App key')}}
                            </label>
                            <input v-model="form.app_key" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.app_key">*{{form.errors.app_key}}</p>
                        </div>
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Title English')}}
                            </label>
                            <input v-model="form.title_en" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.title_en">*{{form.errors.title_en}}</p>
                        </div>
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Title Portuguese')}}
                            </label>
                            <input v-model="form.title_pt" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.title_pt">*{{form.errors.title_pt}}</p>
                        </div>
                    </div>

                    <div class="md:flex md:flex-row flex-cols space-y-2 md:space-x-2">
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Description English')}}
                            </label>
                            <textarea v-model="form.description_en" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                            <p class="text-red-600 text-xs" v-if="form.errors.description_en">*{{form.errors.description_en}}</p>
                        </div>
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Description Portuguese')}}
                            </label>
                            <textarea v-model="form.description_pt" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                            <p class="text-red-600 text-xs" v-if="form.errors.description_pt">*{{form.errors.description_pt}}</p>
                        </div>
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('App Image')}}
                            </label>
                            <input @input="form.image = $event.target.files[0]"  type="file" class="w-full form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.image">*{{form.errors.image}}</p>
                        </div>
                    </div>
                </template>
                <template #footer>
                    <span v-show="form.recentlySuccessful" class="text-green-600 font-medium">Done.</span>
                    <button @click="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-2 focus:outline-none focus:ring-cyan-300 font-medium rounded text-sm px-5 py-2 text-center dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800">
                        <span v-if="form.progress">{{ form.progress.percentage }}%</span>
                        <span v-else>{{ $t('Save') }}</span>
                    </button>
                </template>
            </Modal>
            </form>
        </Teleport>
    </AppLayout>
</template>

<style lang="">

</style>
