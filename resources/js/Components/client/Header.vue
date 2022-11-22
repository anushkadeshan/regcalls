<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import MiniCart from './MiniCart.vue'
import { trans } from 'laravel-vue-i18n';
export default {
    data() {
        return {
            showMiniCart :false,
            currentGroup : usePage().props.value.group_id,
            user_name : usePage().props.value.user ? usePage().props.value.user.name  : null
        }
    },
    methods: {
        ChangeGroup : function (){
            this.$inertia.visit(route('groups.changeGroup'),{
                method: 'post',
                data : {
                    group_id : this.currentGroup,
                },
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                },

            })
        },

        logout : function(){
            Inertia.post(route('logout'));
        }
    },
    components:{
        FontAwesomeIcon,
        MiniCart,
        Link
    }
}
</script>
<template lang="">
    <!-- header -->
    <div>
        <header class="py-2 shadow-sm bg-rose-500">
            <div class="flex items-center justify-between px-2 md:px-10">
                <p class="text-white">
                    <span v-if="user_name">
                        Hi {{user_name}},
                    </span>

                    {{$t('Welcome to Our Store')}}</p>
                <div class="flex items-end space-x-4 ">
                    <select name="" @change="ChangeGroup" v-model="currentGroup"  id="" class="h-6 py-0 text-sm">
                        <option :value="currentGroup">{{$page.props.groupName}}</option>
                        <option
                            v-if="$page.props.assignedGroups.length > 0"
                            v-for="(group, key) in $page.props.assignedGroups"
                            :key="key"
                            :value="group.id"

                            >
                            {{group.name}}
                        </option>
                    </select>
                    <div class="flex space-x-1">
                        <a :href="route('language',['en'])"><img :src="'/storage/Root/england.png'" class="w-7 md:w-7"></a>
                        <a :href="route('language',['pt'])"><img :src="'/storage/Root/brazil.png'" class="w-7 md:w-7"></a>
                    </div>

                    <div v-if="$page.props.user">
                        <form @click.prevent="logout">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                        </form>
                    </div>
                    <Link v-else :href="route('custom.register')" class="text-white">
                        <span class="md:block hidden">
                            {{$t('Login or Register')}}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 md:hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </Link>
                </div>
            </div>
        </header>
        <header class="py-4 shadow-sm bg-white">
            <div class="flex items-center justify-between px-2 md:px-10 space-x-2">
                <a href="index.html">
                    <img :src="'/storage/Root/logo.svg'" class="w-32 hidden md:block">
                </a>

                <div class="w-full max-w-xl relative flex">
                    <span class="absolute left-4 top-3 text-lg text-gray-400">
                        <fa icon="magnifying-glass"></fa>
                    </span>
                    <input type="text" name="search" id="search"
                        class="w-full border border-rose-500 border-r-0 pl-12 py-2 md:py-3 pr-3 rounded-l-md focus:outline-none focus:border-rose-600 focus:ring-rose-500"
                        :placeholder="$t('Search')">
                    <button
                        class="bg-rose-500 border border-rose-500 text-white hover:text-rose-500 hover:bg-transparent px-4 md:px-8 rounded-r-md transition">
                        <span class="md:block hidden">
                            Search
                        </span>
                        <span class="md:hidden">
                            <fa icon="magnifying-glass"></fa>
                        </span>
                    </button>
                </div>

                <div class="flex items-center space-x-4 md:space-x-4">
                    <a href="#" class="text-center text-gray-700 hover:text-rose-500 transition relative">
                        <div class="text-xl md:text-2xl">
                            <fa :icon="['far','fa-heart']"></fa>
                        </div>
                        <div class="text-xs leading-3 hidden md:block">Wishlist</div>
                        <div
                            class="absolute -right-3 md:right-0 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-rose-500 text-white text-xs">
                            8</div>
                    </a>
                    <a @click="showMiniCart=true" class="text-center text-gray-700 hover:text-rose-500 transition relative">
                        <div class="text-xl md:text-2xl">
                            <fa :icon="['fas','cart-plus']" ></fa>
                        </div>
                        <div class="text-xs leading-3 hidden md:block">Cart</div>
                        <div
                            class="absolute -right-3 -top-1 w-5 h-5  rounded-full flex items-center justify-center bg-rose-500 text-white text-xs">
                            {{$page.props.cartItemsCount}}</div>
                    </a>
                    <a href="#" class="text-center text-gray-700 hover:text-rose-500 transition relative">
                        <div class="text-xl md:text-2xl">
                            <fa :icon="['far','user']"></fa>
                        </div>
                        <div class="text-xs leading-3 hidden md:block">Account</div>
                    </a>
                </div>
            </div>
        </header>
    </div>
    <!-- ./header -->

    <!-- mini cart -->
    <Teleport to="body">
        <MiniCart :show="showMiniCart" @close="showMiniCart = false"></MiniCart>
    </Teleport>
</template>

<style scoped>

</style>
