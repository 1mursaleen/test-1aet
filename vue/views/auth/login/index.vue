<template>
    <div class="loginwrapper">
        <div class="lg-inner-column">
            <div class="left-column relative z-[1]">
                <div class="max-w-[520px] pt-20 pl-20 ">
                    <router-link to="/">
                        <div class="w-20">
                            <img :src="logo" alt="" class="mb-10" />
                        </div>
                    </router-link>

                    <h4>
                        Awesome
                        <br>
                        <span class="text-slate-900 font-bold">
                            Rank Tracker App
                        </span>
                    </h4>
                </div>
            </div>
            <div class="right-column relative">
                <div class="inner-content h-full flex flex-col bg-white ">
                    <div class="auth-box h-full flex flex-col justify-center">
                        <div class="w-20 mobile-logo text-center mb-6 mx-auto block">
                            <router-link to="/">
                                <img :src="logo" alt="" class="mx-auto" />
                            </router-link>
                        </div>
                        <div class="text-center 2xl:mb-10 mb-4">
                            <h4 class="font-medium">Sign in</h4>
                            <div class="text-slate-500 text-base">
                                Sign in to your account to start using RankTracker
                            </div>
                        </div>

                        <Signin />

                        <div class="md:max-w-[345px] mx-auto font-normal text-slate-500  mt-12 uppercase text-sm">
                            Don’t have an account?
                            <router-link to="/register" class="text-slate-900  font-medium hover:underline">
                                Sign up
                            </router-link>
                        </div>
                    </div>
                    <div class="auth-footer text-center">
                        Copyright 2023, RankTracker All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Signin from "../common/Signin"
import logo from "@/assets/images/logo/logo.svg"

export default {
    components: {
        Signin,
    },
    setup () {
        return {
            logo
        }
    }
};
</script>

<style lang="scss"></style>
