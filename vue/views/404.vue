<template>
    <div class="min-h-screen flex flex-col justify-center items-center text-center py-20">
        <img src="@/assets/images/all-img/404.svg" alt="" />
        <div class="max-w-[546px] mx-auto w-full mt-12">
            <h4 class="text-slate-900 mb-4">Page not found</h4>
            <div class="text-slate-600 text-base font-normal mb-10">
                The page you are looking for cannot be found.
            </div>
        </div>
        <div class="max-w-[300px] mx-auto w-full">
            <router-link to="/app/search" class="btn btn-primary  block text-center">
                Go to search page
            </router-link>
        </div>
    </div>
</template>
<script>
export default {};
</script>
<style lang=""></style>
