<script>
import { Link } from '@inertiajs/inertia-vue3';
import ClientLayout from '../../../Layouts/ClientLayout.vue';
export default {
    components:{
        ClientLayout,
        Link
    },

    data() {
        return {
            form : this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                phone: '',
            })
        }
    },
    methods: {
        Submit : function () {
            this.form.post(route('custom.post.register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            });
        }
    },
}
</script>
<template lang="">
    <ClientLayout title="Register">

        <div class="contain py-16 bg-gray-50">
            <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden bg-white">
                <h2 class="text-2xl uppercase font-medium mb-1">{{$t('Create an account')}}</h2>
                <p class="text-gray-600 mb-6 text-sm">
                    {{$t('Register for new cosutumer')}}
                </p>
                <form @submit.prevent="Submit">
                    <div class="space-y-2">
                        <div>
                            <label for="name" class="text-gray-600 mb-2 block">{{$t('Full Name')}}</label>
                            <input type="text" name="name" id="name" v-model="form.name"
                                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-pink-500 placeholder-gray-400"
                                placeholder="fulan fulana">
                                <p class="text-red-600 text-xs" v-if="form.errors.name">*{{form.errors.name}}</p>
                        </div>
                        <div>
                            <label for="email" class="text-gray-600 mb-2 block">{{$t('Email address')}}</label>
                            <input type="email" name="email" id="email" v-model="form.email"
                                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-pink-500 placeholder-gray-400"
                                placeholder="youremail.@domain.com">
                            <p class="text-red-600 text-xs" v-if="form.errors.email">*{{form.errors.email}}</p>
                        </div>
                        <div>
                            <label for="password" class="text-gray-600 mb-2 block">{{$t('Password')}}</label>
                            <input type="password" name="password" id="password" v-model="form.password"
                                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-pink-500 placeholder-gray-400"
                                placeholder="*******">
                            <p class="text-red-600 text-xs" v-if="form.errors.password">*{{form.errors.password}}</p>
                        </div>
                        <div>
                            <label for="confirm" class="text-gray-600 mb-2 block">{{$t('Confirm password')}}</label>
                            <input type="password" name="confirm" id="confirm" v-model="form.password_confirmation"
                                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-pink-500 placeholder-gray-400"
                                placeholder="*******">
                            <p class="text-red-600 text-xs" v-if="form.errors.password_confirmation">*{{form.errors.password_confirmation}}</p>
                        </div>
                        <div>
                            <label for="name" class="text-gray-600 mb-2 block">{{$t('Phone')}}</label>
                            <input type="text" name="name" id="name" v-model="form.phone"
                                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-pink-500 placeholder-gray-400"
                                placeholder="fulan fulana">
                            <p class="text-red-600 text-xs" v-if="form.errors.phone">*{{form.errors.phone}}</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <!--
                        <div class="flex items-center">
                            <input type="checkbox" name="aggrement" id="aggrement"
                                class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                            <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer">I have read and agree to the <a
                                    href="#" class="text-primary">terms & conditions</a></label>
                        </div>
                        -->
                    </div>
                    <div class="mt-4">
                        <button type="submit"
                            class="block w-full py-2 text-center text-white bg-rose-500 border border-primary rounded hover:bg-transparent hover:text-pink-500 transition uppercase font-roboto font-medium">create
                            account</button>
                    </div>
                </form>

                <!-- login with -->
                <div class="mt-6 flex justify-center relative">
                    <div class="text-gray-600 uppercase px-3 bg-white z-10 relative">{{$t('Or signup with')}}</div>
                    <div class="absolute left-0 top-3 w-full border-b-2 border-gray-200"></div>
                </div>
                <div class="mt-4 flex gap-4">
                    <a href="#"
                        class="w-1/2 py-2 text-center text-white bg-red-600 rounded uppercase font-roboto font-medium text-sm hover:bg-red-500">google</a>
                </div>
                <!-- ./login with -->

                <p class="mt-4 text-center text-gray-600">{{$t('Already have account?')}} <Link :href="route('custom.login')"
                        class="text-rose-500">{{$t('Login now')}}</Link></p>
            </div>
        </div>
    </ClientLayout>
</template>

<style lang="">

</style>
