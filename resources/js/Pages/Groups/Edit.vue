<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import { ref } from 'vue';
import { trans } from 'laravel-vue-i18n';
import AppsSelect from './AppsSelect.vue';
import PermissionError from '../../Components/pages/PermissionError.vue';
export default {
    props : {
        group : Object,
        apps :Object
    },

    data() {
        return {
            crumbs : ['Group','Edit', this.group.name],
            photoInput : ref(null),
            bannerInput : ref(null),
            photoPreview : ref(null),
            bannerPreview : ref(null),
            form: this.$inertia.form({
                id:  this.group.id,
                name:  this.group.name,
                description:  this.group.description,
                address:  this.group.address,
                phone:  this.group.phone,
                logo : null,
                banner : null

            }),
        }
    },
    methods : {
        //logo
        selectNewPhoto : function (){
            this.$refs.photoInput.click();
        },
        UploadNewPhoto : function () {
            const photo = this.$refs.photoInput.files[0];
            if (! photo) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };
            reader.readAsDataURL(photo);
        },

        //banner
        selectNewBanner : function (){
            this.$refs.bannerInput.click();
        },
        UploadNewBanner : function () {
            const banner = this.$refs.bannerInput.files[0];
            if (! banner) return;
            const reader2 = new FileReader();
            reader2.onload = (e) => {
                this.bannerPreview = e.target.result;
            };
            reader2.readAsDataURL(banner);
        },

        //submit
        submit : function() {
            if (this.$refs.photoInput.value) {
                this.form.logo = this.$refs.photoInput.files[0];
            }
            console.log(this.$refs.bannerInput.value, this.$refs.bannerInput)
            if (this.$refs.bannerInput.value!= '') {
                this.form.banner = this.$refs.bannerInput.files[0];
            }

            this.form.post((route('groups.update')),{
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                },

                onError: (errors) => {
                    console.log(errors);
                },
            });

        }
    },
    components : {
        AppLayout,
        AppsSelect,
        PermissionError
    }
}
</script>

<template lang="">
    <AppLayout title="Group Edit" :crumbs="crumbs">
        <div class="py-6 px-2" v-if="$page.props.currentPermissions.includes('Edit Group')">
            <div class="mx-auto">
                <AppsSelect v-if="$page.props.currentPermissions.includes('Assign Apps to Group')" :apps="apps" :group_id="group.id" :assigendApps="group.apps"></AppsSelect>
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="flex justify-between">
                            <p class="text-gray-800 font-bold">{{$t('Edit Group Details')}}</p>
                        </div>
                        <div class="md:flex md:flex-row md:space-x-2 my-4">
                            <div class="w-full md:mb-0 mb-4">
                                <label class="block font-medium text-sm text-gray-700">
                                    {{$t('Group Name')}}
                                </label>
                                <input v-model="form.name" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <p class="text-red-600 text-xs" v-if="form.errors.name">*{{form.errors.name}}</p>
                            </div>
                            <div class="w-full md:mb-0 mb-4">
                                <label class="block font-medium text-sm text-gray-700">
                                    {{$t('Address')}}
                                </label>
                                <input v-model="form.address" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <p class="text-red-600 text-xs" v-if="form.errors.address">*{{form.errors.address}}</p>
                            </div>
                            <div class="w-full md:mb-0 mb-4">
                                <label class="block font-medium text-sm text-gray-700">
                                    {{$t('Phone')}}
                                </label>
                                <input v-model="form.phone" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <p class="text-red-600 text-xs" v-if="form.errors.phone">*{{form.errors.phone}}</p>
                            </div>
                        </div>

                        <div class="md:flex md:flex-row md:space-x-2 mt-4">
                            <div class="w-full md:mb-0 mb-4">
                                <label class="block font-medium text-sm text-gray-700">
                                    {{$t('Group Description')}}
                                </label>
                                <textarea v-model="form.description" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                                <p class="text-red-600 text-xs" v-if="form.errors.description">*{{form.errors.description}}</p>
                            </div>

                        </div>
                        <input
                            ref="photoInput"
                            type="file"
                            class="hidden"
                            @change="UploadNewPhoto"
                        >
                        <div class="md:flex md:flex-row my-4">
                            <div class="w-full">
                                <!-- Current Profile Photo -->
                                <div v-show="! photoPreview" class="mt-2">
                                    <img :src="'/storage/'+group.logo" :alt="group.name"  class="rounded-full h-24 w-24 object-cover">
                                </div>

                                <!-- New Profile Photo Preview -->
                                <div v-show="photoPreview" class="mt-2">
                                    <span
                                        class="block rounded-full w-24 h-24 bg-cover bg-no-repeat bg-center"
                                        :style="'background-image: url(\'' + photoPreview + '\');'"
                                    />
                                </div>
                                <button @click.prevent="selectNewPhoto" class="inline-flex mt-4 items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                                    {{$t('Select a New Logo')}}
                                </button>
                            </div>
                            <div class="w-full">
                                <input
                                    ref="bannerInput"
                                    type="file"
                                    class="hidden"
                                    @change="UploadNewBanner"
                                >
                                <!-- Current Banner Photo -->
                                <div v-show="! bannerPreview" class="mt-2">
                                    <img :src="'/storage/'+group.banner" :alt="group.name" class="w-36">
                                </div>

                                <!-- New Banner Preview -->
                                <div v-show="bannerPreview" class="mt-2">
                                    <span
                                        class="block bg-cover bg-no-repeat bg-center w-36 h-24"
                                        :style="'background-image: url(\'' + bannerPreview + '\');'"
                                    />
                                </div>
                                <button @click.prevent="selectNewBanner" class="inline-flex mt-4 items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                                    {{$t('Select a New Banner')}}
                                </button>

                            </div>

                        </div>
                        <div class="my-6 text-right">
                            <button type="sumbit" class=" bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-600">{{$t('Save Data')}}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div v-else>
            <PermissionError></PermissionError>
        </div>
    </AppLayout>
</template>

<style lang="">

</style>
