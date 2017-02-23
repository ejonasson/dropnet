<template>
    <div class="notification" v-bind:class="alertType">
      <button class="delete" @click.prevent="deleteAlert"></button>
        {{message}}
    </div>
</template>

<script>
    export default {
        name: 'alert',
        props: {
            type: {
                type: String,
                default: 'success'
            },
            message: {
                type: String,
                required: true
            },
            parentId: {
                type: String,
                required: true
            },
            id: {
                type: Number,
                required: true
            }
        },
        computed: {
            alertType () {
                switch (this.type) {
                    case 'success':
                        return 'is-success'
                    case 'primary':
                        return 'is-primary'
                    case 'info':
                        return 'is-info'
                    case 'warning':
                        return 'is-warning'
                    case 'danger':
                        return 'is-danger'
                }
            }
        },
        methods: {
            deleteAlert () {
                Event.$emit('deleteAlert', this.parentId, this.id)
            }
        }
    }
</script>
<style lang="scss">
</style>
