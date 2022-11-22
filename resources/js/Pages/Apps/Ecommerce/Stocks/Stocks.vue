<script>
import StocksTable from './StocksTable.vue'
import AppLayout from '../../../../Layouts/AppLayout.vue';
import Modal from '../../../../Components/pages/Modal.vue';
import { trans } from 'laravel-vue-i18n';
import PermissionError from '../../../../Components/pages/PermissionError.vue';

export default {
    props : {
        stocks : Object
    },
    components:{
        AppLayout,
        Modal,
        PermissionError,
        StocksTable
    },

    data() {
        return {
            crumbs: ['Ecommerce','Stocks','Index'],
            showModal: false,
            size: 'w-1/2 mx-auto',
            form: this.$inertia.form({
                title : '',
                type : '',
                availability : '',
                is_active : true,

            }),
        }
    },

    methods : {
        submit: function (){
            this.form.post((route('stock.store')),{
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

}
</script>
<template lang="">
    <AppLayout title="Stock Management" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                    <div class="flex justify-end"  v-show="$page.props.currentPermissions.includes('Create Stock')">
                        <button class="bg-gray-800 hover:bg-gray-700 transition-color duration-300 delay-100 text-white rounded px-4 py-2" id="show-modal" @click="showModal = true">{{ $t('Add New') }}</button>
                    </div>
                    <StocksTable v-if="$page.props.currentPermissions.includes('View Stock')" :stocks="stocks"></StocksTable>
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
                    <h3>{{ $t('Add New Stock') }}</h3>
                </template>
                <template #body>
                    <div class="md:flex md:flex-row flex-cols md:space-x-2">
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Title')}}
                            </label>
                            <input v-model="form.title" type="text" class="m-0 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.title">*{{form.errors.title}}</p>
                        </div>
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Type')}}
                            </label>
                            <select v-model="form.type" class="w-full m-0 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="">{{$t('Select a Option')}}</option>
                                <option value="Physical">{{$t('Physical')}}</option>
                                <option value="Logical">{{$t('Logical')}}</option>
                            </select>
                            <p class="text-red-600 text-xs" v-if="form.errors.type">*{{form.errors.type}}</p>
                        </div>


                    </div>

                    <div class="md:flex md:flex-row flex-cols space-y-2 md:space-x-2 mt-4">

                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Availabilty')}}
                            </label>
                            <select v-model="form.availability" class="w-full m-0 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="">{{$t('Select a Option')}}</option>
                                <option value="Available">{{$t('Available')}}</option>
                                <option value="Reserved">{{$t('Reserved')}}</option>
                                <option value="Blocked">{{$t('Blocked')}}</option>
                            </select>
                            <p class="text-red-600 text-xs" v-if="form.errors.availability">*{{form.errors.availability}}</p>
                        </div>
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Active')}}
                            </label>
                            <label class="inline-flex relative items-center mb-4 cursor-pointer">
                            <input type="checkbox" v-model="form.is_active"  :checked="form.is_active" :value="form.is_active ? false : true" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-400"></div>
                        </label>
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
