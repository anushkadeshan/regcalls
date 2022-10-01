<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '../../Components/pages/Modal.vue';
import RolesTable from './RolesTable.vue';
import { trans } from 'laravel-vue-i18n';
export default {
    data (){
        return{
            crumbs:['Roles','All'],
            showModal: false,
            size: 'md:w-1/2 w-11/12 mx-auto',
            form: this.$inertia.form({
                name: '',
                guard_name: 'sanctum',
            }),
        }
    },
    props:{
        roles: Object
    },
    methods:{
        submit: function (){
            this.form.post((route('roles.store')),{
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    this.showModal = false;
                    this.form.name ='';

                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                },
                onError: (errors) => {
                    console.log(errors);
                },
            });
        }
    },
    components: {
    AppLayout,
    Modal,
    RolesTable
}
}
</script>
<style>

</style>
<template>
    <AppLayout title="Roles" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                    <div v-show="$page.props.currentPermissions.includes('Create Role')" class="flex justify-end">
                        <button class="bg-gray-800 hover:bg-gray-700 transition-color duration-300 delay-100 text-white rounded px-4 py-2" id="show-modal" @click="showModal = true">{{ $t('Add New') }}</button>
                    </div>
                    <RolesTable :roles="roles"></RolesTable>
                </div>
            </div>
        </div>
        <Teleport to="body">
            <!-- use the modal component, pass in the prop -->
            <Modal :show="showModal" @close="showModal = false" :size="size">
            <template #header>
                <h3>{{ $t('Add New Role') }}</h3>
            </template>
            <template #body>
                <div class="md:flex md:flex-row flex-cols  md:space-x-2 space-y-2">
                    <div class="w-full">
                        <label class="block font-medium text-sm text-gray-700">
                            {{$t('Role Name')}}
                        </label>
                        <input v-model="form.name" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <p class="text-red-600 text-xs" v-if="form.errors.name">*{{form.errors.name}}</p>
                    </div>
                    <div class="w-full">
                        <label class="block font-medium text-sm text-gray-700">
                            {{$t('Guard')}}
                        </label>
                        <input v-model="form.guard_name" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <p class="text-red-600 text-xs" v-if="form.errors.guard_name">*{{form.errors.guard_name}}</p>
                    </div>
                </div>
            </template>
            <template #footer>
                <span v-show="form.recentlySuccessful" class="text-green-600 font-medium">Done.</span>
                <button @click="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="button" class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-2 focus:outline-none focus:ring-cyan-300 font-medium rounded text-sm px-5 py-2 text-center dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800">{{ $t('Save') }}</button>
            </template>
            </Modal>
        </Teleport>
    </AppLayout>
</template>

