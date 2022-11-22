<script>
import PermissionError from '../../../../Components/pages/PermissionError.vue';
import AppLayout from '../../../../Layouts/AppLayout.vue';
import Multiselect from '@vueform/multiselect'
import { trans } from 'laravel-vue-i18n'
import { ref } from 'vue'
import { Tabs, Tab } from 'flowbite-vue'
export default {
    props : {
        categories : Object ,
        attributes : Object,
        stocks : Object

    },
    data() {
        return {
            crumbs : ['Ecommerce','Products','Create'],
            selectedAtributes : [],
            form : this.$inertia.form({
                title : '',
                short_title : '',
                is_free : false,
                type : '',
                is_active : false,
                pre_login : false,
                price : 0,
                real_price : 0,
                quantity : 0,
                main_image : '',
                images : '',
                tech_specs : '',
                details : '',
                downloads : '',
                expiry_date : '',
                stock_id : '',
                attributes : [],
                categories : null
            }),

            options: this.categories,
            activeTab : ref('first')

        }
    },

    methods: {
        addAtrribute: function(event){
            let isExists = this.selectedAtributes.includes(event.target.value);
            if(!isExists){
                this.selectedAtributes.push(event.target.value);
                this.form.attributes.push({
                    value : '',
                    attribute_name : event.target.value,
                });
            }

        },
        removeAttribute : function(key){
            this.form.attributes.pop(key);
            this.selectedAtributes.pop(key);
        },
        submit: function (){
            this.form.post((route('product.store')),{
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    Toast.fire({
                        icon: page.props.flash.type,
                        title: trans(page.props.flash.message)
                    });
                    this.showModal = false;
                    this.selectedAtributes = [],
                    this.form.reset();
                },

                onError: (errors) => {
                    console.log(errors);
                },
            });
        }
    },
    components:{
        PermissionError,
        AppLayout,
        Multiselect,
        Tabs, Tab
    },


}
</script>
<template lang="">
    <AppLayout title="Create Products" :crumbs="crumbs">
        <div class="py-6 px-2">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg p-4 md:p-8">
                    <div v-if="$page.props.currentPermissions.includes('Create Product')">
                        <form @submit.prevent="submit">
                            <tabs v-model="activeTab" class="p-5"> <!-- class appends to content DIV for all tabs -->
                                <tab name="first" title="General">
                                    <div class="md:flex md:flex-row flex-cols md:space-x-2">
                                        <div class="w-full">
                                            <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Title')}}
                                            </label>
                                            <input v-model="form.title" type="text" class="m-0 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <p class="text-red-600 text-xs" v-if="form.errors.title">*{{form.errors.title}}</p>
                                        </div>
                                        <div class="w-full">
                                            <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Short Title')}}
                                            </label>
                                            <input v-model="form.short_title" type="text" class="m-0 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <p class="text-red-600 text-xs" v-if="form.errors.short_title">*{{form.errors.short_title}}</p>
                                        </div>
                                    </div>

                                    <div class="md:flex md:flex-row flex-cols md:space-x-2 mt-4">
                                        <div class="w-full md:w-1/2">
                                            <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Type')}}
                                            </label>
                                            <select v-model="form.type" class="w-full m-0 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                                <option value="">{{$t('Select a Option')}}</option>
                                                <option value="Physical">{{$t('Physical')}}</option>
                                                <option value="Digital">{{$t('Digital')}}</option>
                                            </select>
                                            <p class="text-red-600 text-xs" v-if="form.errors.type">*{{form.errors.type}}</p>
                                        </div>
                                        <div class="flex space-x-2">
                                            <div class="w-full">
                                                <label class="block font-medium text-sm text-gray-700">
                                                        {{$t('Active')}}
                                                    </label>
                                                    <label class="inline-flex relative items-center mb-4 cursor-pointer">
                                                    <input type="checkbox" v-model="form.is_active"  :checked="form.is_active" :value="form.is_active ? false : true" class="sr-only peer">
                                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-400"></div>
                                                </label>
                                            </div>
                                            <div class="w-full">
                                                <label class="block font-medium text-sm text-gray-700">
                                                        {{$t('Free')}}
                                                    </label>
                                                    <label class="inline-flex relative items-center mb-4 cursor-pointer">
                                                    <input type="checkbox" v-model="form.is_free"  :checked="form.is_free" :value="form.is_free ? false : true" class="sr-only peer">
                                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-400"></div>
                                                </label>
                                            </div>
                                            <div class="w-full">
                                                <label class="block font-medium text-sm text-gray-700">
                                                        {{$t('PreLogin')}}
                                                    </label>
                                                    <label class="inline-flex relative items-center mb-4 cursor-pointer">
                                                    <input type="checkbox" v-model="form.pre_login"  :checked="form.pre_login" :value="form.pre_login ? false : true" class="sr-only peer">
                                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-400"></div>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="md:flex md:flex-row flex-cols md:space-x-2 mt-4">
                                        <div class="w-full md:w-1/2">
                                            <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Stock')}}
                                            </label>
                                            <select v-model="form.stock_id" class="w-full m-0 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                                <option value="">{{$t('Select a Option')}}</option>
                                                <option v-for="(stock,index) in stocks" :value="stock.id">{{stock.title}}</option>
                                            </select>
                                            <p class="text-red-600 text-xs" v-if="form.errors.stock_id">*{{form.errors.stock_id}}</p>
                                        </div>
                                    </div>
                                </tab>
                                <tab name="second" title="Data">
                                    <div class="md:flex md:flex-row flex-cols md:space-x-2">
                                        <div class="w-full">
                                            <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Price')}}
                                            </label>
                                            <input v-model="form.price" type="number" class="m-0 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <p class="text-red-600 text-xs" v-if="form.errors.price">*{{form.errors.price}}</p>
                                        </div>
                                        <div class="w-full">
                                            <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Real Price')}}
                                            </label>
                                            <input v-model="form.real_price" type="number" class="m-0 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <p class="text-red-600 text-xs" v-if="form.errors.real_price">*{{form.errors.real_price}}</p>
                                        </div>
                                        <div class="w-full">
                                            <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Quantity')}}
                                            </label>
                                            <input v-model="form.quantity" type="number" class="m-0 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <p class="text-red-600 text-xs" v-if="form.errors.quantity">*{{form.errors.quantity}}</p>
                                        </div>
                                    </div>
                                    <div class="md:flex md:flex-row flex-cols md:space-x-2 mt-4">
                                        <div class="w-full">
                                            <label class="block font-medium text-sm text-gray-700">
                                                    {{$t('Details')}}
                                            </label>
                                            <textarea v-model="form.details" class="m-0 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                                        </div>
                                    </div>
                                    <div class="md:flex md:flex-row flex-cols md:space-x-2 mt-4">
                                    <div class="w-full">
                                        <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Expiary Date')}}
                                        </label>
                                        <input v-model="form.expiry_date" type="date" class="m-0 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                        <p class="text-red-600 text-xs" v-if="form.errors.expiry_date">*{{form.errors.expiry_date}}</p>
                                    </div>
                                </div>
                                </tab>
                                <tab name="downloads" title="Media">
                                    <div class="md:flex md:flex-row flex-cols md:space-x-2 mt-4">
                                        <div class="w-full">
                                            <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Tech Specs')}}
                                            </label>
                                            <input @input="form.tech_specs = $event.target.files[0]" type="file" class="m-0 w-full border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <p class="text-red-600 text-xs" v-if="form.errors.tech_specs">*{{form.errors.tech_specs}}</p>
                                        </div>
                                        <div class="w-full" v-show="form.type=='Digital'">
                                            <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Downloads')}}
                                            </label>
                                            <input multiple @input="form.downloads = $event.target.files" type="file" class="m-0 w-full border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <p class="text-red-600 text-xs" v-if="form.errors.downloads">*{{form.errors.downloads}}</p>
                                        </div>
                                    </div>
                                </tab>
                                <tab name="third" title="Links">
                                    <div class="w-full">
                                        <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Categories')}}
                                        </label>
                                        <Multiselect v-model="form.categories"
                                            :options="options" mode="tags"
                                            :close-on-select="false"
                                            :searchable="true"
                                            :create-option="false">
                                        </Multiselect>
                                    </div>
                                    <div class="md:flex md:flex-row flex-cols md:space-x-2 mt-4">
                                        <div class="w-full">
                                            <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Attributes')}}
                                            </label>
                                            <select @change="addAtrribute($event)" class="w-full m-0 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                                <option value="">{{$t('Select a Option')}}</option>
                                                <option v-for="(attribute, index ) in attributes" :value="attribute.name">{{attribute.name}}</option>
                                            </select>
                                        </div>
                                        <div class="w-full">
                                            <div v-show="form.attributes" v-for="(attribute, index) in form.attributes" :key="index">
                                                <div class="w-full mb-4">
                                                    <label class="block font-medium text-sm text-gray-700">
                                                        {{attribute.attribute_name}}
                                                    </label>
                                                    <div class="flex space-x-1">
                                                        <input v-model="form.attributes[index].value" type="text" class="m-0 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                                        <button @click="removeAttribute(index)" class="text-white bg-red-700 hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-cyan-300 font-medium rounded text-sm px-3 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tab>
                                <tab name="fourth" title="Images">
                                    <div class="md:flex md:flex-row flex-cols md:space-x-2 mt-4">
                                        <div class="w-full">
                                            <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Main Image')}}
                                            </label>
                                            <input @input="form.main_image = $event.target.files[0]" type="file" class="m-0 w-full border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <p class="text-red-600 text-xs" v-if="form.errors.main_image">*{{form.errors.main_image}}</p>
                                        </div>
                                        <div class="w-full">
                                            <label class="block font-medium text-sm text-gray-700">
                                                {{$t('Other Images')}}
                                            </label>
                                            <input multiple @input="form.images = $event.target.files" type="file" class="m-0 w-full border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                            <p class="text-red-600 text-xs" v-if="form.errors.images">*{{form.errors.images}}</p>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <span v-show="form.recentlySuccessful" class="text-green-600 font-medium">Done.</span>
                                        <button @click="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-2 focus:outline-none focus:ring-cyan-300 font-medium rounded text-sm px-5 py-2 text-center dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800">
                                            <span v-if="form.progress">{{ form.progress.percentage }}%</span>
                                            <span v-else>{{ $t('Save') }}</span>
                                        </button>
                                    </div>
                                </tab>

                            </tabs>

                        </form>
                    </div>
                    <div v-else>
                        <PermissionError></PermissionError>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style lang="">

</style>
<style src="@vueform/multiselect/themes/default.css"></style>
