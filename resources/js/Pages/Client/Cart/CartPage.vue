<script>
import { Link } from '@inertiajs/inertia-vue3';
import { trans } from 'laravel-vue-i18n';
import ClientLayout from '../../../Layouts/ClientLayout.vue';

export default {
    props:{
        products : Object,
        total : Number,
    },
    data() {
        return {
            form : this.$inertia.form({
                product_id : ''
            })
        }
    },


    methods: {
        changeQuantity : function(event,id){
            this.$inertia.visit(route('cart.update-quantity'),{
                method: 'post',
                preserveScroll: true,
                data : {
                    quantity : event.target.value,
                    product_id : id,
                },
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                },

            })
        },

        removeItem : function (product_id){
            this.form.product_id = product_id;
            this.form.post(route('cart.remove'), {
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                    this.show = true;
                },
            });
        }
    },
    components:{
        ClientLayout,
        Link
    }
}
</script>
<template lang="">
    <ClientLayout title="Cart">
        <div class="grid grid-cols-12 items-start gap-6 mx-8 my-4 pt-4 pb-16">
            <div class="md:col-span-9 col-span-12 space-y-4">
                <div v-for="(product, index) in products" :key="index" class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
                    <div class="w-20">
                        <img :src="'/storage/'+product.main_image" :alt="product.title" class="w-full">
                    </div>
                    <div class="w-1/3">
                        <h2 class="text-gray-800 text-sm md:text-xl font-medium uppercase">{{product.title}}</h2>
                        <p class="text-gray-500 text-sm">Availability:
                            <span v-if="product.max_quantity>0" class="text-green-600">In Stock</span>
                            <span v-else class="text-red-600">Not In Stock</span>
                        </p>
                    </div>
                    <input type="number" @change="changeQuantity($event,product.product_id)" v-model="product.quantity" class="md:w-20 w-16 border border-rose-500 focus:ring-rose-500 focus:border-rose-500 text-gray-500" min="1" :max="product.max_quantity">
                    <div class="text-rose-500 text-sm md:text-md md:font-semibold">{{product.price}}</div>
                    <div class="text-rose-500 text-sm md:text-md md:font-semibold">{{product.price*product.quantity}}</div>

                    <div @click.prevent="removeItem(product.product_id)" class="text-gray-600 cursor-pointer hover:text-rose-500">
                        <fa icon="trash"></fa>
                    </div>
                </div>
            </div>
            <div class="md:col-span-3 col-span-12 space-y-4">
                <div class="border border-gray-200 rounded">
                    <div class="border-b ">
                        <p class="text-lg uppercase font-medium px-8 py-4 text-center">{{$t('Order Summary')}}</p>
                    </div>
                    <div class="flex items-center justify-between  gap-6 p-4 ">
                        <p class="font-medium">{{$t('Sub Total')}}</p>
                        <p class="font-medium">{{total}}</p>
                    </div>
                    <div class="flex items-center justify-between text-sm gap-6 p-4 ">
                        *{{$t('Shipping tax will be applicable on checkout')}}
                    </div>
                    <div class="flex items-center justify-between text-lg gap-6 p-4 ">
                        <p class="font-medium">{{$t('Total')}}</p>
                        <p class="font-medium">{{total}}</p>
                    </div>
                    <Link :href="route('checkout.index')" type="button" class="px-4 py-2 rounded-b text-white w-full bg-rose-500 hover:bg-rose-400 text-center">
                        {{$t('Checkout')}}
                    </Link>
                </div>
            </div>
        </div>

    </ClientLayout>
</template>

<style lang="">

</style>
