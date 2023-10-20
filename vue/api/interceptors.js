
import { useToast } from "vue-toastification"
// import { useAuthStore } from "@/store/authStore"

axios.interceptors.request.use(
    (config) => {
        return config
    },
    (error) => {
        return Promise.reject(error)
    }
)

axios.interceptors.response.use(
    (response) => {
        return response
    },
    (error) => {
        const toast = useToast()

        if (error.response) {
            const status = error.response.status
            const data = error.response.data

            if (status === 401) {

                // const authStore = useAuthStore()

                // authStore.logout()

                // toast.error("You are unauthenticated.", {
                //     timeout: 2000,
                // })

            } else if (status === 403) {
                toast.error("Forbidden Action.", {
                    timeout: 2000,
                })
            } else if (status === 404) {
                toast.error("Record Not Found", {
                    timeout: 2000,
                })
            } else if (status === 500) {
                toast.error("Internal Server Error", {
                    timeout: 2000,
                })
            } else {
                //
            }

            console.error(`Error: Request failed - status ${ status }:`, data)

            return Promise.reject(error)
        } else if (error.request) {
            console.error('Request error:', error.request)

            return Promise.reject(error)
        } else {
            console.error('Unhandled error:', error.message)

            return Promise.reject(error)
        }
    }
)
