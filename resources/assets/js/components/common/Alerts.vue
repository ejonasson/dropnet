<template>
    <div class="c-alerts">
      <alert
        v-for="alert in alerts"
        :key="alert.uid"
        :parent-id="id"
        :type="alert.type"
        :message="alert.message"
        :id="alert.uid"
      ></alert>
    </div>
</template>

<script>
    let Alert = require('./Alert')
    export default {
        name: 'alerts',
        data () {
          return {
            alerts: []
          }
        },
        components: {
            'alert': Alert
        },
        props: {
          id: {
            type: String,
            required: true
          }
        },
        methods: {
          addAlert (id, type, message) {
            if (id === this.id) {
              this.alerts.push({
                  type: type,
                  message: message,
                  uid: Math.random()
              })
            }
          },
          deleteAlert(id, index)
          {
            if (id === this.id) {
              this.alerts.splice(index, 1)
            }
          }
        },
        created () {
          Event.$on('addAlert', this.addAlert)
          Event.$on('deleteAlert', this.deleteAlert)
        }
    }
</script>
<style lang="scss">
</style>
