<script>
import Modal from '../../../../Components/pages/Modal.vue'
import Pagination from '../../../../Components/pages/Pagination.vue'
import { pickBy, throttle } from 'lodash';
import { ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { trans } from 'laravel-vue-i18n';
export default {
    props:{
        categories : Object,
        parent_categories : Object
    },
    data () {
        return {
            params : {
                perPage : ref(10),
                search : ref(''),
                field : null,
                direction : null
            },
            showModal: false,
            size: 'w-1/2 mx-auto',
            form: this.$inertia.form({
                name : '',
                parent_id : '',
                order : '',
                id :'',
                image: ''
            }),
        }
    },
    watch : {
        params : {
            handler: throttle(function () {
                let params = pickBy(this.params);
                this.$inertia.get(this.route('category.index'), this.params, {
                    replace :true,
                    preserveState : true
                })
            },150),
            deep :true
        }
    },

    methods :{
        sort(field){
            this.params.field = field;
            this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
        },

        openModel : function (id,name,parent_id,order){
            this.form.name = name;
            this.form.parent_id = parent_id;
            this.form.order = order;
            this.form.id = id;
            this.showModal = true;
        },
        submit: function (){
            this.form.post((route('category.update')),{
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
        Pagination,
        Link, Modal
    }


}
</script>
<template lang="">
    <div class="my-4">
        <div class="md:flex my-4 justify-between">
            <div class="">
                <input v-model="params.search" type="text" class="w-full md:w-96 border py-2 px-4 border-gray-300 rounded-lg focus:border-gray-600 ring-0 focus:ring-0 placeholder:text-gray-800 transition duration-0 focus:duration-300" :placeholder="[[$t('Search the table')]]">
            </div>
            <div class="text-right md:mt-0 mt-2">
                <select v-model="params.perPage" name="" id="" class="w-20 border py-2 px-4 border-gray-300 rounded-lg focus:border-gray-600 ring-0 focus:ring-0 placeholder:text-gray-800 transition duration-0 focus:duration-300">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('id')" class="flex space-x-4">
                                {{$t('ID')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            {{$t('Image')}}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('name')" class="flex space-x-4">
                                {{$t('name')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('parent_id')" class="flex space-x-4">
                                {{$t('Parent')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('order')" class="flex space-x-4">
                                {{$t('Order')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th>
                            {{$t('Action')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="categories.data.length >0"  v-for="(category, key) in categories.data" :key="category.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-2 px-6 w-16">
                            {{category.id}}
                        </td>
                        <td class="py-2 px-6 ">
                            <img v-if="category.image" :src="'/storage/'+category.image" class="w-8 h-8 rounded-full" />
                        </td>
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{category.name}}
                        </th>
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <span v-if="category.parent">
                                {{category.parent.name}}
                            </span>

                        </th>
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{category.order}}
                        </th>
                        <td class="py-2 px-6">
                            <div class="inline-flex rounded-md shadow-sm" v-show="$page.props.currentPermissions.includes('Edit Category')">
                                <a @click="openModel(category.id,category.name,category.parent_id,category.order)" class="px-2 py-1 bg-gradient-to-r from-green-500 to-green-600 hover:opacity-80 text-white text-sm font-medium rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                            </div>

                        </td>
                    </tr>
                    <div v-else class=" my-4 mx-4">
                        {{$t('No Data Found')}}
                    </div>
                </tbody>
            </table>
        </div>
        <Pagination :links="categories.links" :to_items="categories.to" :from_items="categories.from" :total_items="categories.total"></Pagination>
    </div>
    <Teleport to="body">
            <!-- use the modal component, pass in the prop -->
            <form @submit.prevent="submit">
            <Modal :show="showModal" @close="showModal = false" :size="size">
                <template #header>
                    <h3>{{ $t('Update Category') }}</h3>
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
                                {{$t('Type')}}
                            </label>
                            <select v-model="form.parent_id" class="w-full m-0 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="">--</option>
                                <option v-for="category in parent_categories" :key="category.id" :value="category.id">{{category.name}}</option>

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
</template>

<style lang="">

</style>
