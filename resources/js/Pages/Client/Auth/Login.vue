<script>
import { Link } from '@inertiajs/inertia-vue3';
import ClientLayout from '../../../Layouts/ClientLayout.vue';

export default {
    data() {
        return {
            form : this.$inertia.form({
                password: '',
                email: '',
                remember : false
            })
        }
    },
    components:{
        ClientLayout,
        Link
    },
    methods: {
        Submit : function () {
            this.form.post(route('custom.post.login'), {
                onFinish: () => this.form.reset('password'),
            });
        }
    },
}
</script>
<template lang="">
    <ClientLayout title="Login">
        <div v-show="$page.props.flash.message" :class="$page.props.flash.type=='error' ? 'bg-red-400' : 'bg-green-400'" class="px-4 py-2 text-white text-center">
            {{$t($page.props.flash.message)}}
        </div>
        <div class="contain py-16 bg-gray-50">
            <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden bg-white">
                <h2 class="text-2xl uppercase font-medium mb-1">{{$t('Login')}}</h2>
                <p class="text-gray-600 mb-6 text-sm">
                    {{$t('welcome back customer')}}
                </p>
                <form @submit.prevent="Submit" autocomplete="off">
                    <div class="space-y-2">
                        <div>
                            <label for="email" class="text-gray-600 mb-2 block">{{$t('Email address')}}</label>
                            <input v-model="form.email" type="email" name="email" id="email"
                                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-pink-500 placeholder-gray-400"
                                placeholder="youremail.@domain.com">
                            <p class="text-red-600 text-xs" v-if="form.errors.email">*{{form.errors.email}}</p>
                        </div>
                        <div>
                            <label for="password" class="text-gray-600 mb-2 block">{{$t('Password')}}</label>
                            <input v-model="form.password" type="password" name="password" id="password"
                                class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-pink-500 placeholder-gray-400"
                                placeholder="*******">
                            <p class="text-red-600 text-xs" v-if="form.errors.password">*{{form.errors.password}}</p>
                        </div>

                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center">
                            <input v-model="form.remember" type="checkbox" name="remember" id="remember"
                                class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                            <label for="remember" class="text-gray-600 ml-3 cursor-pointer">{{$t('Remember me')}}</label>
                        </div>
                        <a href="#" class="text-primary">{{$t('Forgot password')}}</a>
                    </div>
                    <div class="mt-4">
                        <button type="submit"
                            class="block w-full py-2 text-center text-white bg-rose-500 border border-rose-500 rounded hover:bg-transparent hover:text-rose-500 transition uppercase font-roboto font-medium">Login</button>
                    </div>
                </form>

                <!-- login with -->
                <div class="mt-6 flex justify-center relative">
                    <div class="text-gray-600 uppercase px-3 bg-white z-10 relative">{{$t('Or login with')}}</div>
                    <div class="absolute left-0 top-3 w-full border-b-2 border-gray-200"></div>
                </div>
                <div class="mt-4 flex gap-4">
                    <a href="#"
                        class="w-1/2 py-2 text-center text-white bg-red-600 rounded uppercase font-roboto font-medium text-sm hover:bg-red-500">google</a>
                </div>
                <!-- ./login with -->

                <p class="mt-4 text-center text-gray-600">{{$t("Don't have account?")}} <Link :href="route('custom.register')"
                        class="text-rose-500">{{$t('Register now')}}</Link></p>
            </div>
        </div>
    </ClientLayout>
</template>

<style lang="">

</style>
