
<script>
import { ref } from "vue";
import { pickBy, throttle } from 'lodash';
import Pagination from "../../Components/pages/Pagination.vue";
import DeleteModal from '../../Components/pages/DeleteModal.vue';
import { trans } from 'laravel-vue-i18n';
import { Link } from "@inertiajs/inertia-vue3";
export default {
    props: {
        groups: Object
    },

    data () {
        return {
            showDeleteModal :false,
            params : {
                perPage : ref(10),
                search : ref(''),
                field : null,
                direction : null
            },
            form : this.$inertia.form({
                group_id: null

            })

        }
    },
    components: {
        Pagination,
        DeleteModal,
        Link
    },
    watch : {
        params : {
            handler: throttle(function () {
                let params = pickBy(this.params);
                this.$inertia.get(this.route('groups.index'), this.params, {
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

        showModal(group_id) {
            this.form.group_id = group_id;
            this.showDeleteModal = true;
        },

        submit: function (){
            this.form.delete((route('groups.delete')),{
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                    this.showDeleteModal = false;
                    this.form.reset();
                },

                onError: (errors) => {
                    console.log(errors.exception_message);
                },
            });
        }
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
                        <th scope="col" class="py-3 px-6">
                            {{$t('Group Logo')}}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('name')" class="flex space-x-4">
                                {{$t('Group Name')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('address')" class="flex space-x-4">
                                {{$t('Address')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('phone')" class="flex space-x-4">
                                {{$t('Phone')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            {{$t('Action')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="groups.data.length >0"  v-for="(group, key) in groups.data" :key="group.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-2 px-6 w-16">
                            {{group.id}}
                        </td>
                        <td class="py-2 px-6">
                            <img :src="'/storage/'+group.logo" class="w-8 h-8 rounded-full" />
                        </td>
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{group.name}}
                        </th>
                        <td class="py-2 px-6">
                            {{group.address}}
                        </td>
                        <td class="py-2 px-6">
                            {{group.phone}}
                        </td>
                        <td class="py-2 px-6">

                            <div class="inline-flex rounded-md shadow-sm">
                                <a href="#" aria-current="page" class="px-2 py-1 bg-gradient-to-r from-yellow-300 to-yellow-400 hover:opacity-80 text-white text-sm font-medium rounded-l-md  ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>
                                <Link :href="route('groups.edit',[group.id])" class="px-2 py-1 bg-gradient-to-r from-green-500 to-green-600 hover:opacity-80 text-white text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>

                                </Link>
                                <a @click="showModal(group.id)" class="px-2 py-1 bg-gradient-to-r from-red-600 to-red-700 hover:opacity-80 text-white text-sm font-medium rounded-r-md ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
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
        <Pagination :links="groups.links" :to_items="groups.to" :from_items="groups.from" :total_items="groups.total"></Pagination>
    </div>
    <Teleport to="body">
        <!-- use the modal component, pass in the prop -->
        <form @submit.prevent="submit">
        <DeleteModal :show="showDeleteModal" @close="showDeleteModal = false">
            <template #body>
                Are you sure you want to delete this record?
            </template>
            <template #footer>
                <button  :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button @click="showDeleteModal = false" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
            </template>
        </DeleteModal>
        </form>
    </Teleport>
</template>

<style lang="">

</style>
