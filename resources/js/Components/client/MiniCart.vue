<script>
import { Link } from '@inertiajs/inertia-vue3';
import { trans } from 'laravel-vue-i18n';

export default {
    props: {
        show: Boolean,
        size: String
    },

    data() {
        return {
            form : this.$inertia.form({
                product_id : ''
            })
        }
    },

    methods: {
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
        Link
    }
}
</script>

<template>
    <Transition name="modal">
    <div v-if="show" class="modal-mask">
        <div class="modal-wrapper">
            <div class="">
                <div class="md:absolute md:top-24 md:w-1/3 max-h-96 md:right-3 p-4">
                    <div class="relative bg-white  shadow dark:bg-gray-700"  >
                        <div class="border-b">
                            <p class="p-4 text-center text-xl font-bold">{{$t('Your Cart')}}</p>
                            <button @click="$emit('close')" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <div v-if="$page.props.cartProducts.length>0">
                            <div class="py-2 px-3 max-h-72 overflow-y-scroll">
                                <div v-for="(product, index) in $page.props.cartProducts" :key="index" class="flex space-x-4 items-start border-b py-3">
                                    <img :src="'/storage/'+product.main_image" class="w-24"  />
                                    <div class="flex items-start justify-between w-full">
                                        <div class="flex flex-col space-y-1 max-h-44">
                                            <h5>{{product.title}} x {{product.quantity}}</h5>
                                            <h5>{{product.price}}</h5>
                                        </div>
                                        <button @click.prevent="removeItem(product.product_id)" type="button" class="text-right text-red-400 bg-transparent hover:bg-red-200 hover:text-gray-500 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex px-4 py-2 justify-between mr-4">
                                <p class="font-medium">{{$t('Sub Total')}}</p>
                                <p>{{$page.props.cartSubTotal}}</p>
                            </div>
                            <div class="flex  px-4 py-2 space-x-4 justify-between">
                                <Link type="button" :href="route('cart.index')" class="bg-gray-900 px-4 py-2 text-white w-full text-center">
                                    {{$t('Go to Cart')}}
                                </Link>
                                <button class="bg-rose-500 px-4 py-2 text-white w-full">
                                    {{$t('Checkout')}}
                                </button>
                            </div>
                        </div>
                        <div v-else class="py-4 px-3 text-center text-gray-500">
                            {{('Your cart is empty')}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </Transition>
</template>

<style>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
}


/*
    * The following styles are auto-applied to elements with
    * transition="modal" when their visibility is toggled
    * by Vue.js.
    *
    * You can easily play with the modal transition by editing
    * these styles.
    */

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
