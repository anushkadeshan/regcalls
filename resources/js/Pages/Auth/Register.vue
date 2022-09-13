<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Components/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import JetButton from '@/Components/Button.vue';
import JetInput from '@/Components/Input.vue';
import JetInputError from '@/Components/InputError.vue';
import JetCheckbox from '@/Components/Checkbox.vue';
import JetLabel from '@/Components/Label.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    phone: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />
    <form @submit.prevent="submit">
        <div class="py-6 bg-gray-100">
            <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-6xl">
                <div class="hidden lg:block lg:w-4/12 bg-cover" style="background-image:url('https://images.unsplash.com/photo-1546514714-df0ccc50d7bf?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=667&q=80')"></div>
                <div class="w-full px-8 py-8 lg:w-8/12">
                    <h2 class="text-xl font-semibold text-gray-700 text-center">{{ $t('Join or Ecommerce Platform') }}</h2>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="border-b w-1/5 lg:w-1/4"></span>
                        <a href="#" class="text-xs text-center text-gray-500 uppercase">{{ $t('Enter Required Fields') }}</a>
                        <span class="border-b w-1/5 lg:w-1/4"></span>
                    </div>
                    <div class="md:flex md:space-x-2">
                        <div class="mt-4 w-full">
                            <label class="block text-gray-700 text-sm font-bold mb-2">{{ $t('Your Name') }} *</label>
                            <input v-model="form.name"
                            class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="text">
                            <JetInputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="mt-4 w-full">
                            <label class="block text-gray-700 text-sm font-bold mb-2">{{ $t('Email Address') }} *</label>
                            <input
                                v-model="form.email"
                                class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="email">
                            <JetInputError class="mt-2" :message="form.errors.email" />
                        </div>
                    </div>
                    <div class="md:flex md:space-x-2">
                        <div class="mt-4 w-full">
                            <div class="flex justify-between">
                                <label class="block text-gray-700 text-sm font-bold mb-2">{{ $t('Password') }} *</label>
                            </div>
                            <input
                            v-model="form.password"
                            class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password">
                            <JetInputError class="mt-2" :message="form.errors.password" />
                        </div>
                        <div class="mt-4 w-full">
                            <div class="flex justify-between">
                                <label class="block text-gray-700 text-sm font-bold mb-2">{{ $t('Confirm Password') }} *</label>
                            </div>
                            <input
                            v-model="form.password_confirmation"
                            class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password">
                            <JetInputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>
                    </div>
                    <div class="md:flex md:space-x-2 items-end">
                        <div class="mt-4 md:w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2">{{ $t('Phone') }}</label>
                            <input
                            v-model="form.phone"
                            class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="text">
                            <JetInputError class="mt-2" :message="form.errors.phone" />
                        </div>
                        <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4 md:w-1/2">
                            <JetLabel for="terms">
                                <div class="flex items-center">
                                    <JetCheckbox id="terms" v-model:checked="form.terms" name="terms" />

                                    <div class="ml-2">
                                        I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                                    </div>
                                </div>
                                <JetInputError class="mt-2" :message="form.errors.terms" />
                            </JetLabel>
                        </div>
                    </div>
                    <div class="md:flex justify-center md:space-x-2 mt-8 item">
                        <button
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        class="md:w-1/2 w-full my-2 md:my-0 bg-gray-700 text-white font-bold py-2 px-4 rounded hover:bg-gray-600">{{ $t('Register') }}</button>
                        <a href="#" class="md:w-1/2 flex items-center justify-center bg-gray-700 text-white rounded-lg shadow-md hover:bg-gray-600">
                            <div class="px-4 py-2">
                                <svg class="h-6 w-6" viewBox="0 0 40 40">
                                    <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.045 27.2142 24.3525 30 20 30C14.4775 30 10 25.5225 10 20C10 14.4775 14.4775 9.99999 20 9.99999C22.5492 9.99999 24.8683 10.9617 26.6342 12.5325L31.3483 7.81833C28.3717 5.04416 24.39 3.33333 20 3.33333C10.7958 3.33333 3.33335 10.7958 3.33335 20C3.33335 29.2042 10.7958 36.6667 20 36.6667C29.2042 36.6667 36.6667 29.2042 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#FFC107"/>
                                    <path d="M5.25497 12.2425L10.7308 16.2583C12.2125 12.59 15.8008 9.99999 20 9.99999C22.5491 9.99999 24.8683 10.9617 26.6341 12.5325L31.3483 7.81833C28.3716 5.04416 24.39 3.33333 20 3.33333C13.5983 3.33333 8.04663 6.94749 5.25497 12.2425Z" fill="#FF3D00"/>
                                <path d="M20 36.6667C24.305 36.6667 28.2167 35.0192 31.1742 32.34L26.0159 27.975C24.3425 29.2425 22.2625 30 20 30C15.665 30 11.9842 27.2359 10.5975 23.3784L5.16254 27.5659C7.92087 32.9634 13.5225 36.6667 20 36.6667Z" fill="#4CAF50"/>
                                <path d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.7592 25.1975 27.56 26.805 26.0133 27.9758C26.0142 27.975 26.015 27.975 26.0158 27.9742L31.1742 32.3392C30.8092 32.6708 36.6667 28.3333 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z" fill="#1976D2"/>
                            </svg>
                        </div>
                        <h1 class="w-5/6 text-center text-gray-100 font-bold">{{ $t('Sign in with Google') }}</h1>
                        </a>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="border-b w-1/5 md:w-1/4"></span>
                        <Link :href="route('login')" class="text-xs text-gray-500 uppercase">or sign in</Link>
                        <span class="border-b w-1/5 md:w-1/4"></span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
