
<script>
import Products from './Client/Home/Products.vue'
import ShopByCategory from './Client/Home/ShopByCategory.vue'
import ClientLayout from '../Layouts/ClientLayout.vue'
export default {
    props : {
        categories : Object,
        products : Object
    },
    components:{
        ClientLayout,
        ShopByCategory, Products
    }
}
</script>

<template lang="">
    <ClientLayout title="Shop Home">
        <div class="flex object-fill bg-cover bg-no-repeat bg-center py-20 md:py-26 h-full" style="background-image: url('/banner-bg.jpg')">
            <div class="px-8">
                <h1 class="text-4xl md:text-6xl text-gray-800 font-medium mb-4 capitalize">
                    best collection  <br> Regcalls Shop
                </h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam <br>
                    accusantium perspiciatis, sapiente
                    magni eos dolorum ex quos dolores odio</p>
                <div class="mt-8 md:mt-12">
                    <a href="#" class="bg-rose-500 border border-rose-500 text-white px-8 py-2 md:py-3 font-medium
                        rounded-md hover:bg-transparent hover:text-rose-500">Shop Now</a>
                </div>
            </div>
        </div>
        <ShopByCategory :categories="categories"></ShopByCategory>
        <Products :products="products"></Products>
    </ClientLayout>
</template>

<style lang="">

</style>
