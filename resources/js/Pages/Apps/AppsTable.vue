<script>
import { ref } from 'vue';
import { pickBy, throttle } from 'lodash';
import { trans } from 'laravel-vue-i18n';
import Pagination from '../../Components/pages/Pagination.vue';
export default {
    props: {
        apps: Object
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
                this.$inertia.get(this.route('apps.index'), this.params, {
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

        changeStatus : function (event, app_id) {
            this.$inertia.visit(route('apps.changeStatus'),{
                method: 'post',
                data : {
                    app_id : app_id,
                    status : event.target.value
                },
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                },

            },
            )
        },
    },
    components : {
        Pagination
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
                            {{$t('App Logo')}}
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span @click="sort('app_key')" class="flex space-x-4">
                                {{$t('App Key')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th  v-if="$page.props.locale =='en'" scope="col" class="py-3 px-6">
                            <span @click="sort('title_en')" class="flex space-x-4">
                                {{$t('App Title')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th v-else scope="col" class="py-3 px-6">
                            <span @click="sort('title_pt')" class="flex space-x-4">
                                {{$t('App Title')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th  v-if="$page.props.locale =='en'" scope="col" class="py-3 px-6">
                            <span @click="sort('description_en')" class="flex space-x-4">
                                {{$t('Description')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th v-else scope="col" class="py-3 px-6">
                            <span @click="sort('description_pt')" class="flex space-x-4">
                                {{$t('Description')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                        <th scope="col" class="py-3 px-6" v-show="$page.props.currentPermissions.includes('Edit Apps')">
                            <span @click="sort('active')" class="flex space-x-4">
                                {{$t('Active')}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                                </svg>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="apps.data.length >0"  v-for="(app, key) in apps.data" :key="app.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-2 px-6 w-16">
                            {{app.id}}
                        </td>
                        <td class="py-2 px-6">
                            <img :src="'/storage/'+app.image" class="w-8 h-8 rounded-full" />
                        </td>
                        <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{app.app_key}}
                        </th>
                        <th scope="row" v-if="$page.props.locale =='en'" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{app.title_en}}
                        </th>
                        <th scope="row" v-else class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{app.title_pt}}
                        </th>
                        <td v-if="$page.props.locale =='en'" class="py-2 px-6">
                            {{app.description_en}}
                        </td>
                        <td v-else class="py-2 px-6">
                            {{app.description_pt}}
                        </td>
                        <td class="py-2 px-6" v-show="$page.props.currentPermissions.includes('Edit Apps')">
                            <label v-bind:for="'default-toggle'+app.id" class="inline-flex relative items-center mb-4 cursor-pointer">
                                <input type="checkbox" @change="changeStatus($event, app.id)" :checked="app.active" :value="app.active ? false : true" v-bind:id="'default-toggle'+app.id" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-400"></div>
                            </label>
                        </td>
                    </tr>
                    <div v-else class=" my-4 mx-4">
                        {{$t('No Data Found')}}
                    </div>
                </tbody>
            </table>
        </div>
        <Pagination :links="apps.links" :to_items="apps.to" :from_items="apps.from" :total_items="apps.total"></Pagination>
    </div>
</template>

<style lang="">

</style>
