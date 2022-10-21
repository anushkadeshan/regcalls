<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '../../Components/pages/Modal.vue';
import { trans } from 'laravel-vue-i18n';
import GroupsTable from './GroupsTable.vue';
import PermissionError from '../../Components/pages/PermissionError.vue';

export default {
    props : {
        groups : Object
    },
    data () {
        return {
            crumbs : ['Groups','All'],
            showModal: false,
            size: 'w-11/12 mx-auto',
            form: this.$inertia.form({
                name: '',
                description: '',
                address: '',
                phone: '',
                logo: '',
                banner: ''

            }),
        }
    },
    methods : {
        submit: function (){
            this.form.post((route('groups.store')),{
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
                    console.log(errors.exception_message);
                },
            });
        }
    },

    components: {
        AppLayout,
        Modal,
        GroupsTable,
        PermissionError
    }
}
</script>

<template lang="">
    <AppLayout title="Groups" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                    <div class="flex justify-end"  v-show="$page.props.currentPermissions.includes('Create Group')">
                        <button class="bg-gray-800 hover:bg-gray-700 transition-color duration-300 delay-100 text-white rounded px-4 py-2" id="show-modal" @click="showModal = true">{{ $t('Add New') }}</button>
                    </div>
                    <GroupsTable v-if="$page.props.currentPermissions.includes('View Group')" :groups="groups"></GroupsTable>
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
                    <h3>{{ $t('Add New Group') }}</h3>
                </template>
                <template #body>
                    <div class="md:flex md:flex-row flex-cols space-y-2 md:space-x-2">
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Group Name')}}
                            </label>
                            <input v-model="form.name" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.name">*{{form.errors.name}}</p>
                        </div>
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Address')}}
                            </label>
                            <input v-model="form.address" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.address">*{{form.errors.address}}</p>
                        </div>
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Phone')}}
                            </label>
                            <input v-model="form.phone" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.phone">*{{form.errors.phone}}</p>
                        </div>
                    </div>

                    <div class="md:flex md:flex-row flex-cols space-y-2 md:space-x-2 mt-4">
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Group Description')}}
                            </label>
                            <textarea v-model="form.description" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                            <p class="text-red-600 text-xs" v-if="form.errors.description">*{{form.errors.description}}</p>
                        </div>
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Group Logo')}}
                            </label>
                            <input @input="form.logo = $event.target.files[0]"  type="file" class="w-full form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.logo">*{{form.errors.logo}}</p>
                        </div>
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Banner')}}
                            </label>

                            <input @input="form.banner = $event.target.files[0]"  class="w-full form-input border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" aria-describedby="file_input_help" id="file_input" type="file">
                            <p class="text-red-600 text-xs" v-if="form.errors.banner">*{{form.errors.banner}}</p>
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
