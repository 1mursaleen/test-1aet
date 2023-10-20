export default function auth ({ next, to, from, authStore }) {

    if (!localStorage.user) {
        return next({ name: "Login" })
    }

    // if (!authStore.isAuthenticated) {
    //     return next({ name: "Login" })
    // }

    // if (localStorage.activeUser) {
    //     return next()
    // }

    return next()
}
