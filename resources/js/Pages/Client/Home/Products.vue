<script>
import { trans } from 'laravel-vue-i18n';
import store from '../../../Store';

export default {

    props:{
        products : Object
    },
    data() {
        return {
            test :store.state.test
        }
    },

    methods: {
        addToCart : function (product_id){
            this.$inertia.visit(route('cart.add'),{
                method: 'post',
                preserveScroll: true,
                data : {
                    product_id : product_id,
                },
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                },

            })
        }
    },
}
</script>
<template lang="">

    <div class="md:px-16 md:pb-16 px-6 py-6">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6 md:text-left text-center">{{$t('top new arrival')}}</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div v-for="(product, index) in products" :key="index" class="bg-white shadow rounded overflow-hidden group">
                <div class="relative">
                    <img :src="'/storage/'+product.main_image" :alt="product.title" class="w-full">
                    <div class="absolute inset-0 bg-black flex items-center
                    justify-center gap-2 opacity-20 group-hover:opacity-40 transition">
                    </div>
                </div>
                <div class="pt-4 pb-3 px-4">
                    <div class="flex justify-between" >
                        <a href="#" class="mb-2">
                            <h2 class="uppercase font-medium text-md  text-gray-800 hover:text-primary transition">{{product.short_title}}</h2>
                            <p class="text-green-500 text-sm" v-if="product.quantity>0">
                                {{$t('In Stock')}}
                            </p>
                            <p class="text-red-500 text-sm" v-else>
                                {{$t('Not In Stock')}}
                            </p>
                        </a>
                        <div class="flex space-x-1">
                            <a href="#"
                                class="text-white text-lg w-9 h-8 rounded-full bg-rose-500 flex items-center justify-center hover:bg-gray-800 transition"
                                title="view product">
                                <fa icon="magnifying-glass"></fa>
                            </a>
                            <a href="#"
                                class="text-white text-lg w-9 h-8 rounded-full bg-rose-500 flex items-center justify-center hover:bg-gray-800 transition"
                                title="add to wishlist">
                                <fa icon="heart"></fa>
                            </a>
                        </div>
                    </div>

                    <div class="flex items-baseline mb-1 space-x-2">
                        <p class="text-xl text-rose-500 font-semibold">${{product.price}}</p>
                    </div>
                </div>
                <button @click.prevent="addToCart(product.id)"
                    class="block w-full py-1 text-center text-white bg-rose-500 border border-rose-500 rounded-b hover:bg-transparent hover:text-rose-500 transition">Add
                    to cart</button>
            </div>

        </div>
    </div>
</template>

<style lang="">

</style>
