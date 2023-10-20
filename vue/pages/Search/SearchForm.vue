<template>
    <form @submit.prevent="onSubmit" class="grid lg:grid-cols-7 grid-cols-1 gap-5 items-start">

        <div class="lg:col-span-1 col-span-7">
            <Select label="Location" v-model="location_code" name="location_code" placeholder="Select Location" :options="locationOptions" v-if="locationOptions.length" :error="location_codeError" />
        </div>

        <div class="lg:col-span-1 col-span-7">
            <Select label="Device" v-model="device" name="device" placeholder="Select Device" :options="deviceOptions" :error="deviceError" />
        </div>

        <div class="lg:col-span-1 col-span-7">
            <Textinput label="Repetitions" type="number" placeholder="1" name="repetitions" v-model="repetitions" :error="repetitionsError" />
        </div>

        <div class="lg:col-span-4 col-span-7">
            <InputGroup label="Keyword" v-model="keyword" type="text" placeholder="Enter Keywords" :error="keywordError">
                <template v-slot:append>
                    <Button type="submit" icon="heroicons-outline:search" text="Track" btnClass="btn-outline-primary" :isLoading="isSubmitting" :disabled="isSubmitting" />
                </template>
            </InputGroup>
        </div>

    </form>
</template>

  <script>
import Button from "@/components/Button"
import Textinput from "@/components/Textinput"
import { useField, useForm } from "vee-validate"
import * as yup from "yup"
import InputGroup from "@/components/InputGroup"
import Select from "@/components/Select"
import { ref, onMounted } from 'vue'
import endpoints from '@/api/endpoints'
import { useToast } from "vue-toastification"
import { useRouter } from 'vue-router'

export default {
    components: {
        Textinput,
        Button,
        InputGroup,
        Select,
    },

    setup () {

        const toast = useToast()
        const router = useRouter()

        const deviceOptions = ref([
            {
                value: "desktop",
                label: "Desktop",
            },
            {
                value: "mobile",
                label: "Mobile",
            },
        ])

        const locationOptions = ref([])

        const schema = yup.object({
            repetitions: yup.number().required().min(1).max(100),
            keyword: yup.string().required(),
            location_code: yup.number().required(),
            device: yup.string().required(),
        })

        const { errors, values, handleSubmit, isSubmitting } = useForm({
            validationSchema: schema,
        })

        const { value: repetitions, errorMessage: repetitionsError } = useField("repetitions")

        const { value: keyword, errorMessage: keywordError } = useField("keyword")
        const { value: location_code, errorMessage: location_codeError } = useField("location_code")
        const { value: device, errorMessage: deviceError } = useField("device")

        let isFormSubmitting = false

        const onSubmit = handleSubmit(async () => {
            try {
                if (isFormSubmitting) return null

                isFormSubmitting = true

                const response = await axios.post(endpoints.trackRank(), {
                    keyword: values.keyword,
                    device: values.device,
                    location_code: Number(values.location_code),
                    repetitions: Number(values.repetitions),
                })

                const search = response.data.data.search

                router.push({ name: 'search-details', params: { id: search.id } })

                isFormSubmitting = false
            } catch (error) {
                toast.error("Error tracking ranks: " + error.message, {
                    timeout: 2000,
                })

                isFormSubmitting = false
            }

        })

        const fetchLocations = async () => {
            try {
                const response = await axios.get('location')

                const locations = response.data.data.locations?.map(location => ({
                    label: location.label,
                    value: location.code,
                }))

                locationOptions.value = locations
            } catch (error) {
                toast.error("Error fetching locations: " + error.message, {
                    timeout: 2000,
                })
            }
        }

        onMounted(() => {
            fetchLocations()
        })

        return {
            isSubmitting,
            repetitions,
            repetitionsError,
            keyword,
            keywordError,
            location_code,
            location_codeError,
            device,
            deviceError,
            deviceOptions,
            locationOptions,
            onSubmit,
        }
    },
};
  </script>
  <style lang="scss"></style>
