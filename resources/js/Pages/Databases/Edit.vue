<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import PermissionError from '../../Components/pages/PermissionError.vue';
import { trans } from 'laravel-vue-i18n';
export default {
    props :{
        database : Object
    },
    data() {
        return {
            crumbs : ['Database','Edit'],
            form: this.$inertia.form({
                id:  this.database.id,
                driver : this.database.driver,
                url : this.database.url,
                host : this.database.host,
                port : this.database.port,
                database : this.database.database,
                username : this.database.username,
                password : this.database.password,
                unix_socket : this.database.unix_socket,
                charset : this.database.charset,
                collation : this.database.collation,
                prefix : this.database.prefix,
                prefix_indexes : this.database.prefix_indexes,
                strict : this.database.strict,
                engine : this.database.engine
            }),
        }
    },
    methods: {
        //submit
        submit : function() {
            this.form.post((route('databases.update')),{
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
        PermissionError
    }
}
</script>
<template lang="">
    <AppLayout title="Edit Database" :crumbs="crumbs">
        <div v-if="$page.props.currentPermissions.includes('Edit Database')" class="py-6 px-2">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg p-6">
                <form @submit.prevent="submit">
                    <div class="md:flex md:flex-row md:space-x-2 my-4">
                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Driver')}}
                            </label>
                            <input v-model="form.driver" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.driver">*{{form.errors.driver}}</p>
                        </div>
                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Url')}}
                            </label>
                            <input v-model="form.url" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.url">*{{form.errors.url}}</p>
                        </div>
                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Host')}}
                            </label>
                            <input v-model="form.host" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.host">*{{form.errors.host}}</p>
                        </div>
                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Port')}}
                            </label>
                            <input v-model="form.port" type="number" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.port">*{{form.errors.port}}</p>
                        </div>
                    </div>

                    <div class="md:flex md:flex-row md:space-x-2 my-4">
                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Database')}}
                            </label>
                            <input v-model="form.database" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.database">*{{form.errors.database}}</p>
                        </div>
                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('User Name')}}
                            </label>
                            <input v-model="form.username" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.username">*{{form.errors.username}}</p>
                        </div>

                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Password')}}
                            </label>
                            <input v-model="form.password" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.password">*{{form.errors.password}}</p>
                        </div>
                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Unix Socket')}}
                            </label>
                            <input v-model="form.unix_socket" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.unix_socket">*{{form.errors.unix_socket}}</p>
                        </div>
                    </div>

                    <div class="md:flex md:flex-row md:space-x-2 my-4">
                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Charset')}}
                            </label>
                            <input v-model="form.charset" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.charset">*{{form.errors.charset}}</p>
                        </div>
                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Collation')}}
                            </label>
                            <input v-model="form.collation" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.collation">*{{form.errors.collation}}</p>
                        </div>

                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Prefix')}}
                            </label>
                            <input v-model="form.prefix" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.prefix">*{{form.errors.prefix}}</p>
                        </div>
                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Prefix Indexes')}}
                            </label>
                            <select v-model="form.prefix_indexes" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="0">False</option>
                                <option value="1">True</option>
                            </select>
                            <p class="text-red-600 text-xs" v-if="form.errors.prefix_indexes">*{{form.errors.prefix_indexes}}</p>
                        </div>
                    </div>

                    <div class="md:flex md:flex-row md:space-x-2 my-4">
                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Strict')}}
                            </label>
                            <select v-model="form.strict" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="0">False</option>
                                <option value="1">True</option>
                            </select>
                            <p class="text-red-600 text-xs" v-if="form.errors.strict">*{{form.errors.strict}}</p>
                        </div>
                        <div class="w-full md:mb-0 mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                {{$t('Engine')}}
                            </label>
                            <input v-model="form.engine" type="text" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <p class="text-red-600 text-xs" v-if="form.errors.engine">*{{form.errors.engine}}</p>
                        </div>
                    </div>
                    <div class="my-6 text-right">
                            <button type="sumbit" class=" bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-600">{{$t('Save Data')}}</button>
                        </div>
                </form>
            </div>
        </div>
        <div v-else>
            <PermissionError></PermissionError>
        </div>
    </AppLayout>
</template>

<style lang="">

</style>
