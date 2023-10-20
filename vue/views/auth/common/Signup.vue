<template>
    <form @submit.prevent="onSubmit" class="space-y-4">
        <Textinput label="Full name" type="text" placeholder="Full Name" name="name" v-model="name" :error="nameError" classInput="h-[48px]" />
        <Textinput label="Email" type="email" placeholder="Type your email" name="emil" v-model="email" :error="emailError" classInput="h-[48px]" />
        <Textinput label="Password" type="password" placeholder="8+ characters, 1 capitat letter " name="password" v-model="password" :error="passwordError" hasicon classInput="h-[48px]" />
        <Textinput label="Confirm Password" type="password" placeholder="8+ characters, 1 capitat letter " name="password_confirmation" v-model="password_confirmation" :error="password_confirmationError" hasicon classInput="h-[48px]" />

        <label class="cursor-pointer flex items-start">
            <input type="checkbox" class="hidden" @change="() => (checkbox = !checkbox)" />
            <span class="h-4 w-4 border rounded inline-flex mr-3 relative flex-none top-1 transition-all duration-150" :class="
          checkbox
            ? 'ring-2 ring-black-500 ring-offset-2 bg-slate-900'
            : 'bg-slate-100  border-slate-100  '
        ">
                <img src="@/assets/images/icon/ck-white.svg" alt="" class="h-[10px] w-[10px] block m-auto" v-if="checkbox" />
            </span>
            <span class="text-slate-500  text-sm leading-6">You accept our Terms and Conditions and Privacy Policy</span>
        </label>

        <button type="submit" class="btn btn-primary block w-full text-center">
            Create an account
        </button>
    </form>
</template>
<script>
import Textinput from "@/components/Textinput"
import { useField, useForm } from "vee-validate"
import * as yup from "yup"

import { inject } from "vue"
import { useRouter } from "vue-router"
import { useToast } from "vue-toastification"

import { useAuthStore } from "@/store/authStore"

export default {
    components: {
        Textinput,
    },
    data () {
        return {
            checkbox: false,
        }
    },
    setup () {

        const schema = yup.object({
            email: yup.string().required(" Email is required").email(),
            password: yup.string().required("Password is  required").min(8),
            password_confirmation: yup.string().required("Confirm Password is  required").min(8),
            name: yup.string().required("Full name is required"),
        })

        const swal = inject("$swal")
        const toast = useToast()
        const router = useRouter()
        const authStore = useAuthStore()

        const users = []

        const { handleSubmit } = useForm({
            validationSchema: schema,
        })

        const { value: email, errorMessage: emailError } = useField("email")
        const { value: name, errorMessage: nameError } = useField("name")
        const { value: password, errorMessage: passwordError } = useField("password")
        const { value: password_confirmation, errorMessage: password_confirmationError } = useField("password_confirmation")

        const onSubmit = handleSubmit(async (values) => {

            try {
                await authStore.register(values)

                router.push("/app/search")
            } catch (error) {
                toast.error("Signup failed: " + error.message, {
                    timeout: 2000,
                })
            }

            return null

        })

        return {
            email,
            name,
            nameError,
            emailError,
            password,
            passwordError,
            password_confirmation,
            password_confirmationError,
            onSubmit,
        }
    },
};
</script>
<style lang="scss"></style>
