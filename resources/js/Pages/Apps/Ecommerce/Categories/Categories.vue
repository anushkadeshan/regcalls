<script>
import Modal from '../../../../Components/pages/Modal.vue'
import CategoryTable from './CategoryTable.vue'
import PermissionError from '../../../../Components/pages/PermissionError.vue'
import AppLayout from '../../../../Layouts/AppLayout.vue'
import { trans } from 'laravel-vue-i18n';
export default {
    props:{
        categories : Object,
        parent_categories : Object

    },
    data() {
        return {
            crumbs : ['Ecommerce','Categories','All'],
            showModal: false,
            size: 'w-1/2 mx-auto',
            form: this.$inertia.form({
                name : '',
                parent_id : '',
                order : '',
                image : ''
            }),


        }
    },

    methods : {
        submit: function (){
            this.form.post((route('category.store')),{
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
        PermissionError,
        CategoryTable,
        Modal,
    }
}
</script>
<template lang="">
    <AppLayout title="Categories" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">

                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                    <div class="flex justify-end"  v-show="$page.props.currentPermissions.includes('Create Category')">
                        <button class="bg-gray-800 hover:bg-gray-700 transition-color duration-300 delay-100 text-white rounded px-4 py-2" id="show-modal" @click="showModal = true">{{ $t('Add New') }}</button>
                    </div>
                    <CategoryTable v-if="$page.props.currentPermissions.includes('View Category')" :categories="categories" :parent_categories="parent_categories"></CategoryTable>
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
                    <h3>{{ $t('Add New Category') }}</h3>
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
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Parent Category')}}
                            </label>
                            <select v-model="form.parent_id" class="w-full m-0 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="">--</option>
                                <option v-for="category in this.parent_categories" :key="category.id" :value="category.id">{{category.name}}</option>

                            </select>
                            <p class="text-red-600 text-xs" v-if="form.errors.type">*{{form.errors.type}}</p>
                        </div>
                    </div>

                    <div class="md:flex md:flex-row flex-cols space-y-2 md:space-x-2 mt-4">
                        <div class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Order')}}
                            </label>
                            <input v-model="form.order" type="number" class="m-0 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.order">*{{form.errors.order}}</p>
                        </div>
                        <div v-if="!form.parent_id" class="w-full">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Image')}}
                            </label>
                            <input @input="form.image = $event.target.files[0]" type="file" class="m-0 w-full border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
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

