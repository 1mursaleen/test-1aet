<template>
    <form @submit.prevent="onSubmit" class="space-y-4">
        <Textinput label="Email" type="email" placeholder="Type your email" name="emil" v-model="email" :error="emailError" classInput="h-[48px]" />
        <Textinput label="Password" type="password" placeholder="8+ characters, 1 capitat letter " name="password" v-model="password" :error="passwordError" hasicon classInput="h-[48px]" />

        <div class="flex justify-between">
            <label class="cursor-pointer flex items-start">
                <input type="checkbox" class="hidden" @change="() => (checkbox = !checkbox)" />
                <span class="h-4 w-4 border rounded flex-none inline-flex mr-3 relative top-1 transition-all duration-150" :class=" checkbox ? 'ring-2 ring-black-500 ring-offset-2 bg-slate-900' : 'bg-slate-100 border-slate-100' ">
                    <img src="@/assets/images/icon/ck-white.svg" alt="" class="h-[10px] w-[10px] block m-auto" v-if="checkbox" />
                </span>
                <span class="text-slate-500  text-sm leading-6">Keep me signed in</span>
            </label>
        </div>

        <button type="submit" class="btn btn-primary block w-full text-center">
            Sign in
        </button>
    </form>
</template>
<script>
import Textinput from "@/components/Textinput"
import { useField, useForm } from "vee-validate"
import * as yup from "yup"

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
            email: yup.string().required("Email is required").email(),
            password: yup.string().required("Password is required").min(8),
        })

        const toast = useToast()
        const router = useRouter()
        const authStore = useAuthStore()

        const formValues = {
            email: "user1@example.com",
            password: "password",
        }

        const { handleSubmit } = useForm({
            validationSchema: schema,
            initialValues: formValues,
        })

        const { value: email, errorMessage: emailError } = useField("email")
        const { value: password, errorMessage: passwordError } =
            useField("password")

        const onSubmit = handleSubmit(async (credentials) => {

            try {
                await authStore.login(credentials)

                router.push("/app/search")
            } catch (error) {
                toast.error("Login failed: " + error.message, {
                    timeout: 2000,
                })
            }
        })

        return {
            email,

            emailError,
            password,
            passwordError,
            onSubmit,
        }
    },
};
</script>

<style lang="scss"></style>
