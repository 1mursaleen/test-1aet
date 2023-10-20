<template>
    <div class="loginwrapper">
        <div class="lg-inner-column">
            <div class="left-column relative z-[1]">
                <div class="max-w-[520px] pt-20 pl-20">
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
            <div class="right-column relative bg-white">
                <div class="inner-content h-full flex flex-col bg-white">
                    <div class="auth-box h-full flex flex-col justify-center">
                        <div class="w-20 mobile-logo text-center mb-6 mx-auto block">
                            <router-link to="/">
                                <img :src="logo" alt="" class="mx-auto" />
                            </router-link>
                        </div>
                        <div class="text-center 2xl:mb-10 mb-5">
                            <h4 class="font-medium">Sign up</h4>
                            <div class="text-slate-500 text-base">
                                Create an account to start using RankTracker
                            </div>
                        </div>

                        <Signup />

                        <div class="max-w-[215px] mx-auto font-normal text-slate-500 2xl:mt-12 mt-6 uppercase text-sm">
                            Already registered?
                            <router-link to="/" class="text-slate-900 font-medium hover:underline"> Sign In</router-link>
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
import Signup from "../common/Signup"
import logo from "@/assets/images/logo/logo.svg"

export default {
    components: {
        Signup,
    },
    setup () {
        return {
            logo,
        }
    }
};
</script>
<style lang="scss"></style>
