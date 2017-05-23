<script>
    let Alerts = require('../common/Alerts')
    export default {
        components: {
            'alerts': Alerts
        },
        methods: {
            addAlert (id, type, message) {
                Event.$emit('addAlert', id, type, message)
            }
        }
    }
</script>
