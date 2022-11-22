<script>
import { ref } from 'vue';
import { pickBy, throttle } from 'lodash';
import { trans } from 'laravel-vue-i18n';
import Pagination from '../../../../Components/pages/Pagination.vue';
import { Link } from "@inertiajs/inertia-vue3";

export default {
    props : {
        products : Object
    },
    data () {
        return {
            params : {
                perPage : ref(10),
                search : ref(''),
                field : null,
                direction : null
            },
        }
    },
    watch : {
        params : {
            handler: throttle(function () {
                let params = pickBy(this.params);
                this.$inertia.get(this.route('product.index'), this.params, {
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
    },
    components : {
        Pagination,
        Link
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
                            {{$t('Logo')}}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('short_title')" class="flex space-x-4">
                                {{$t('Title')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('type')" class="flex space-x-4">
                                {{$t('Type')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('price')" class="flex space-x-4">
                                {{$t('Price')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th  scope="col" class="py-3 px-6">
                            <span @click="sort('real_price')" class="flex space-x-4">
                                {{$t('Real Price')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('quantity')" class="flex space-x-4">
                                {{$t('Quantity')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('expiry_date')" class="flex space-x-4">
                                {{$t('Expiry Date')}}
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
                    <tr v-if="products.data.length >0"  v-for="(product, key) in products.data" :key="product.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-2 px-6 w-16">
                            {{product.id}}
                        </td>
                        <td class="py-2 px-6">
                            <img :src="'/storage/'+product.main_image" class="w-8 h-8 rounded-full" />
                        </td>
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{product.short_title}}
                        </th>
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{product.type}}
                        </th>
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{product.price}}
                        </th>
                        <td class="py-2 px-6">
                            {{product.real_price}}
                        </td>
                        <td  class="py-2 px-6">
                            {{product.quantity}}
                        </td>
                        <td  class="py-2 px-6">
                            {{product.expiry_date}}
                        </td>
                        <td>
                            <div class="inline-flex rounded-md shadow-sm">
                                <Link :href="route('product.edit',[product.id])" class="px-2 py-1 bg-gradient-to-r from-green-500 to-green-600 hover:opacity-80 text-white text-sm font-medium rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </Link>
                            </div>

                        </td>
                    </tr>
                    <div v-else class=" my-4 mx-4">
                        {{$t('No Data Found')}}
                    </div>
                </tbody>
            </table>
        </div>
        <Pagination :links="products.links" :to_items="products.to" :from_items="products.from" :total_items="products.total"></Pagination>
    </div>
</template>

<style lang="">

</style>
