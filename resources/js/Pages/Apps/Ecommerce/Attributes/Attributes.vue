<script>
import AttributesTable from './AttributesTable.vue'
import PermissionError from '../../../../Components/pages/PermissionError.vue'
import Modal from '../../../../Components/pages/Modal.vue'
import AppLayout from '../../../../Layouts/AppLayout.vue'
import { trans } from 'laravel-vue-i18n';
export default {

    props :{
        attributes : Object
    },

    data() {
        return {
            crumbs : ['Ecommerce','Attributes','All'],
            showModal: false,
            size: 'w-1/2 mx-auto',
            form: this.$inertia.form({
                name : '',
            }),
        }
    },

    methods : {
        submit: function (){
            this.form.post((route('attribute.store')),{
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
    components:{
        AppLayout,
        Modal,
        PermissionError,
        AttributesTable
    }
}
</script>
<template lang="">
    <AppLayout title="Product Attributes" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                    <div class="flex justify-end"  v-show="$page.props.currentPermissions.includes('Create Stock')">
                        <button class="bg-gray-800 hover:bg-gray-700 transition-color duration-300 delay-100 text-white rounded px-4 py-2" id="show-modal" @click="showModal = true">{{ $t('Add New') }}</button>
                    </div>
                    <AttributesTable v-if="$page.props.currentPermissions.includes('View Attribute')" :attributes="attributes"></AttributesTable>
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
                    <h3>{{ $t('Add New Attribute') }}</h3>
                </template>
                <template #body>
                    <div class="md:flex md:flex-row flex-cols md:space-x-2">
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Name')}}
                            </label>
                            <input v-model="form.name" type="text" class="m-0 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.name">*{{form.errors.name}}</p>
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
