<script>
import AppLayout from '../../../Layouts/AppLayout.vue';

export default {
    components: { AppLayout },
    props :{
        title : String
    },
    data() {
        return {
            crumbs : ['Apps','Home']
        }
    },
}
</script>

<template>
    <AppLayout :title="title" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4">
                   This is still under development.
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style lang="">

</style>
