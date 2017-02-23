<template>
    <p class="control">
        <label for="selected-plan" class="label">Select a Stripe Subscription</label>
        <span class="select">
            <select name="selected-plan" v-model="activePlan">
                <option disabled>Select a Subscription Plan...</option>
                <option v-for="plan in plans" v-bind:value="plan.id">{{plan.name}}</option>
            </select>
        </span>
    </p>
</template>

<script>
    export default {
        name: 'subscription-selector',
        data () {
            return {
                activePlan: '',
            }
        },
        props: {
            plans: {
                type: Array,
                required: true
            },
            selectedPlan : {
                type: String
            }
        },
        created () {
            this.activePlan = this.selectedPlan
        },
        watch: {
            activePlan (val, oldVal) {
                Event.$emit('activePlanChange', val)
            }
        }
    }
</script>
