<template>
    <div class="c-sequence--email">
        <h3>Message {{messageNumber}}</h3>
        <label for="subject" class="label">Subject</label>
        <div class="control">
            <input type="text" v-model="emailSubject" placeholder="Email Subject" name="subject" class="input">
        </div>
        <label for="content" class="label">Content</label>
        <div class="control">
            <textarea name="content" v-model="emailContent" placeholder="Enter your email content" class="textarea"></textarea>
        </div>
        <div class="control">
            <label for="send-delay">Hours to wait before sending: </label>
            <input type="number" v-model="emailSendDelay" class="input" name="send-delay">
        </div>
        <hr>
    </div>
</template>

<script>
    export default {
        name: 'sequence-email',
        data () {
            return {
                emailSubject: '',
                emailContent: '',
                emailSendDelay: 0,
            }
        },
        props: {
            id: {
                type: Number,
                default: 0
            },
            subject: {
                type: String,
                default: ''
            },
            content: {
                type: String,
                default: ''
            },
            sendDelay: {
                type: Number,
                default: 0
            },
            index: {
                type: Number,
                required: true
            }
        },
        computed: {
            messageNumber () {
                return this.index + 1
            }
        },
        methods: {
            new (index) {
                return {
                    id: 0,
                    subject: '',
                    content: '',
                    sendDelay: 0,
                    index: index
                }
            }
        },
        watch: {
            emailSubject (val, oldVal) {
                Event.$emit('emailSubjectUpdate', this.index, val)
            },
            emailContent (val, oldVal) {
                Event.$emit('emailContentUpdate', this.index, val)
            },
            emailSendDelay (val, oldVal) {
                Event.$emit('emailSendDelayUpdate', this.index, val)
            }
        },
        created () {
            this.emailSubject = this.subject
            this.emailContent = this.content
            this.emailSendDelay = this.sendDelay
        }
    }
</script>
<style lang="scss">
    .c-sequence--email {
        margin-bottom: 2rem;
    }
</style>
