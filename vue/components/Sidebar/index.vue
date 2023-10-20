<template>
    <div>
        <div :class="`sidebar-wrapper bg-white border-r border-gray-5002  w-[248px]`">

            <div :class="`logo-segment flex justify-between items-center bg-white  z-[9] py-6  sticky top-0 px-4 border-b border-r border-gray-5002  w-[248px]`">
                <router-link to="/app/search">
                    <div class="w-8"> <img :src="logo" alt="" /> </div>
                </router-link>
            </div>

            <div class="h-[60px] absolute top-[80px] nav-shadow z-[1] w-full transition-all duration-200 pointer-events-none opacity-0"></div>

            <Navmenu :items="menuItems" />

        </div>
    </div>
</template>
<script>
import { defineComponent } from "vue"
import { menuItems } from "../../constant/data"
import Navmenu from "./Navmenu"
import logo from "@/assets/images/logo/logo.svg"

export default defineComponent({
    components: {
        Navmenu,
    },
    setup () {
        return {
            logo,
            menuItems,
        }
    },
});
</script>

<style lang="scss">
.sidebar-wrapper {
    @apply fixed ltr:left-0 rtl:right-0 top-0   h-screen   z-[999];
    transition: width 0.2s cubic-bezier(0.39, 0.575, 0.565, 1);
    will-change: width;
}

.nav-shadow {
    background: linear-gradient(rgb(255, 255, 255) 5%, rgba(255, 255, 255, 75%) 45%, rgba(255, 255, 255, 20%) 80%, transparent);
}
.sidebar-wrapper.sidebar-hovered {
    width: 248px !important;
}
.logo-segment.logo-hovered {
    width: 248px !important;
}
</style>
