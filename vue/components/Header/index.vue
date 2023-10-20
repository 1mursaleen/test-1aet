<template>
    <header :class="navbarTypeClass()">
        <div :class="`app-header md:px-6 px-[15px]  dark:bg-slate-800 shadow-base dark:shadow-base3 bg-white bordered md:py-6 py-3 `">
            <div class="flex justify-between items-center h-full">
                <div></div>
                <div class="nav-tools flex items-center lg:space-x-5 space-x-3 rtl:space-x-reverse">
                    <Profile v-if="window.width > 768" />
                </div>
            </div>
        </div>
    </header>
</template>
<script>
import Profile from "./Navtools/Profile.vue"
import MonochromeMode from "./Navtools/MonochromeMode.vue"
import Icon from "../Icon"
import SearchModal from "./Navtools/SearchModal.vue"
import LanguageVue from "./Navtools/Language.vue"
import Logo from "./Navtools/Logo.vue"
import MobileLogo from "./Navtools/MobileLogo.vue"
import window from "@/mixins/window"
import HandleMobileMenu from "./Navtools/HandleMobileMenu.vue"

export default {
    mixins: [window],
    components: {
        Profile,
        MonochromeMode,
        Icon,
        LanguageVue,
        SearchModal,
        Logo,
        MobileLogo,
        HandleMobileMenu,
    },

    methods: {
        navbarTypeClass () {
            switch (this.$store.themeSettingsStore.navbarType) {
                case "floating":
                    return "floating"
                case "sticky":
                    return "sticky top-0 z-[999]"
                case "static":
                    return "static"
                case "hidden":
                    return "hidden"
                default:
                    return "sticky top-0"
            }
        },
    },
};
</script>
<style lang="scss" scoped>
.floating .app-header {
    @apply md:mx-6 md:my-8 mx-[15px] my-[15px] rounded-md;
}
</style>
