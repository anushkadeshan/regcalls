<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import Theme from './Theme.vue';
export default {
    data() {
        return {
            crumbs : ['Settings','All']
        }
    },
    components : {
    AppLayout,
    Theme
}
}
</script>
<template>
    <AppLayout title="Settings" :crumbs="crumbs">
        <Theme></Theme>
    </AppLayout>
</template>

<style lang="">

</style>
