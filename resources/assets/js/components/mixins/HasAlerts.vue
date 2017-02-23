<script>
    let Alerts = require('../common/alerts')
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
