<template>
    <router-view />
</template>

<script>
import { useThemeSettingsStore } from "@/store/themeSettings"
import { useAuthStore } from "./store/authStore"
import { ref, onMounted } from "vue"
import { useRouter } from "vue-router"

export default {
    mounted () {
        this.$store.themeSettingsStore = useThemeSettingsStore()
    },
    setup () {

        const loaded = ref(false)

        const router = useRouter()
        const authStore = useAuthStore()

        const checkSession = async () => {
            try {
                await authStore.getUser()
            } catch (error) {
                router.push("/")
            }

            // loaded.value = true
        }

        onMounted(() => {
            checkSession()
        })

        return {
            loaded,
        }
    }
}
</script>

<style></style>
