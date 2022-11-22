<script>
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { pickBy, throttle } from 'lodash';

export default {
    data() {
        return {
            showMenu :false,
            showCategories : false,
            params : {
                category_id: ''
            }
        }
    },

    watch : {
        params : {
            handler: throttle(function () {
                let params = pickBy(this.params);
                this.$inertia.get(this.route('home.products'), this.params, {
                    replace :true,
                    preserveState : true
                })
            },150),
            deep :true
        }
    },

    methods: {
        showCategoriesMethod : function(){
            this.showCategories= this.showCategories ? false : true;
        },
        selectCategory : function(id){
            this.params.category_id = id
        }
    },
    components:{
        Link
    }
}
</script>
<template lang="">
    <nav class="bg-gray-800">
        <div class="flex px-2 md:px-16">
            <div class="px-8 py-4 bg-rose-500 md:flex  items-center cursor-pointer relative group hidden">
                <span class="text-white">
                    <fa icon="bars"></fa>
                </span>
                <span class="capitalize ml-2 text-white">All Categories</span>
                <!-- dropdown -->
                <div
                    class="absolute w-full left-0 top-full bg-white shadow-md divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
                    <a v-for="(category,index) in $page.props.categoriesOnNavbar" :key="category.id" @click="selectCategory(category.id)"  href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <span class="ml-6 text-gray-600 text-sm">{{category.name}}</span>
                    </a>
                </div>
            </div>

            <div class="flex items-center justify-end md:justify-between flex-grow pl-12">
                <button @click="showMenu = true" class="md:hidden p-4 focus:outline-none text-white focus:bg-rose-500 focus:text-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                </button>
                <div class="md:flex items-center space-x-6 capitalize hidden ">
                    <Link :href="route('home.index')" class="text-gray-200 hover:text-white transition">Home</Link>
                    <a href="pages/shop.html" class="text-gray-200 hover:text-white transition">Shop</a>
                    <a href="#" class="text-gray-200 hover:text-white transition">About us</a>
                    <a href="#" class="text-gray-200 hover:text-white transition">Contact us</a>
                </div>
            </div>
        </div>
    </nav>
    <Teleport to="body" class="">
        <Transition name="modal">
            <div v-show="showMenu" class="bg-gray-800 absolute z-50 top-0 w-full h-screen md:hidden">
                <div class="text-right">
                    <button @click="showMenu = false, showCategories=false" class="md:hidden p-4 focus:outline-none text-white focus:bg-rose-500 focus:text-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div @click="showCategoriesMethod" class="px-8 py-3 mb-1 bg-rose-500 md:hidden flex items-center justify-between cursor-pointer">
                    <span class="capitalize text-white">All Categories</span>
                    <svg v-if="!showCategories" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                    <!-- dropdown -->
                </div>
                <div v-show="showCategories" class="w-full mb-1 top-full bg-white shadow-md divide-y divide-gray-300 divide-dashed transition duration-300">
                    <a v-for="(category,index) in $page.props.categoriesOnNavbar" :key="category.id" href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <span class="ml-6 text-gray-600 text-sm">{{category.name}}</span>
                    </a>
                </div>
                <div class="text-white flex flex-col space-y-1">
                    <Link :href="route('home.index')" class="w-full px-8 py-3 bg-rose-500 md:hidden flex items-center justify-between cursor-pointer">Home</Link>
                    <a href="pages/shop.html" class="w-full px-8 py-3 bg-rose-500 md:hidden flex items-center justify-between cursor-pointer">Shop</a>
                    <a href="#" class="w-full px-8 py-3 bg-rose-500 md:hidden flex items-center justify-between cursor-pointer">About us</a>
                    <a href="#" class="w-full px-8 py-3 bg-rose-500 md:hidden flex items-center justify-between cursor-pointer">Contact us</a>
                </div>

            </div>
        </Transition>
    </Teleport>

</template>

<style>
    .modal-enter-from {
      opacity: 0;
    }

    .modal-leave-to {
      opacity: 0;
    }

    .modal-enter-from .modal-container,
    .modal-leave-to .modal-container {
      -webkit-transform: scale(1.1);
      transform: scale(1.1);
    }
</style>
