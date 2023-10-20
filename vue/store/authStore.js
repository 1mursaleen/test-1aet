import endpoints from '@/api/endpoints'
import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
    }),

    getters: {
        isAuthenticated: (state) => Boolean(state.user),
    },

    actions: {

        async login (credentials) {
            return new Promise(async (resolve, reject) => {

                const loginResponse = await axios.post(endpoints.login(), credentials)

                const userResponse = await axios.get(endpoints.user())

                this.user = userResponse.data

                localStorage.setItem("user", JSON.stringify(this.user))

                localStorage.setItem("activeUser", JSON.stringify(this.user))

                return resolve(this.user)
            })
        },

        async getUser () {
            return new Promise(async (resolve, reject) => {

                const userResponse = await axios.get(endpoints.user())

                this.user = userResponse.data

                localStorage.setItem("user", JSON.stringify(this.user))

                localStorage.setItem("activeUser", JSON.stringify(this.user))

                return resolve(this.user)
            })
        },

        async register (credentials) {
            return new Promise(async (resolve, reject) => {
                const registerResponse = await axios.post(endpoints.register(), credentials)

                const userResponse = await axios.get(endpoints.user())

                this.user = userResponse.data

                localStorage.setItem("user", JSON.stringify(this.user))

                localStorage.setItem("activeUser", JSON.stringify(this.user))

                return resolve(this.user)
            })
        },

        async logout () {

            axios.post(endpoints.logout())

            this.user = null

            localStorage.removeItem("user")

        },

    },
})
