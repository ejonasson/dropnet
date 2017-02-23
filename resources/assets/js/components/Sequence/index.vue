<template>
  <div class="container c-sequence--create">
    <alerts id="sequence-alerts"></alerts>
    <div class="columns content">
      <div class="column">
        <p class="control">
          <input type="text" class="input" v-model="name" placeholder="Sequence Name">
        </p>

        <subscription-selector
        :plans="plans"
        :selected-plan="selectedPlan"
        ></subscription-selector>

        <h3>Sequence Messages</h3>
        <sequence-email v-for="email in sequence"
        :subject="email.subject"
        :content="email.content"
        :send-delay="email.sendDelay"
        :index="email.index"
        ></sequence-email>
        <a href="#" class="button is-info" @click.prevent="createEmail"> Create New Sequence Email</a>
        <a href="#" class="button is-primary" @click.prevent="save">{{text.save}}</a>
      </div>
    </div>
  </div>
</template>

<script>
  let SubscriptionSelector = require('./SubscriptionSelector')
  let SequenceEmail = require('./SequenceEmail')
  let HasAlerts = require('../mixins/HasAlerts')

  export default {
    name: 'create-sequence',
    mixins: [HasAlerts],
    components: {
      'subscription-selector': SubscriptionSelector,
      'sequence-email': SequenceEmail
    },
    data () {
      return {
        name: '',
        selectedPlan: '',
        plans: [],
        sequence: [],
        saving: false
      }
    },
    props: {
      id: {
        type: Number,
        default: 0
      },
      data: {
        type: String,
        default: ''
      },
      sourcePlans: {
        type: String,
        default: ''
      }
    },
    computed: {
      urls () {
        return {
          create: SiteUrls.businessApiUrl + 'sequence',
          update: SiteUrls.businessApiUrl + '/sequence/' + this.id
        }
      },
      text () {
        return {
          save: !this.saving ? 'Save Changes' : 'Saving...'
        }
      },
      nextEmailIndex () {
        let lastEmail = (_.last(_.sortBy(this.sequence, ['index'])))
        if (lastEmail !== undefined) {
          return lastEmail.index + 1
        }

        return 0
      },
      entityData () {
        return {
          entity: 'sequence',
          name: this.name,
          selectedPlan: this.selectedPlan,
          sequence: this.sequence
        }
      }
    },
    methods: {
      // Still a WIP
      normalizeData (jsonData) {
        this.sequence = []

        let data = JSON.parse(jsonData)
          this.name         = jsonData.name,
          this.selectedPlan = jsonData.selectedPlan,
          _.each(jsonData.sequence, (email) => {
            this.sequence.push({
                subject: email.subject,
                content: email.content,
                sendDelay: email.sendDelay,
                index: email.index
            })
          })
      },
      createEmail () {
        let email = SequenceEmail.methods.new(this.nextEmailIndex)
        this.sequence.push(email)
      },
      save () {
        let saveUrl = this.id === 0 ? this.urls.create : this.urls.update
        this.saving = true;
        this.$http.post(saveUrl, this.entityData).then(
          (successResponse) => {
            this.addAlert('sequence-alerts', 'success', 'Your Sequence has successfully been saved')
            this.saving = false
          },
          (errorResponse) => {
            this.addAlert('sequence-alerts', 'danger', 'An error occurred when trying to save your Sequence')
            this.saving = false
          }
          )
      },
      updatePlanSelected (val) {
        this.selectedPlan = val
      },
      updateEmailSubject(index, val) {
        let email = _.find(this.sequence, ['index', index])
        email.subject = val
      },
      updateEmailContent(index, val) {
        let email = _.find(this.sequence, ['index', index])
        email.content = val
      },
      updateEmailSendDelay(index, val) {
        let email = _.find(this.sequence, ['index', index])
        email.sendDelay = val
      }
    },
    created () {
      this.plans = JSON.parse(this.sourcePlans)
      this.normalizeData(this.data)
      Event.$on('activePlanChange', this.updatePlanSelected)
      Event.$on('emailSubjectUpdate', this.updateEmailSubject)
      Event.$on('emailContentUpdate', this.updateEmailContent)
      Event.$on('emailSendDelayUpdate', this.updateEmailSendDelay)

    },
    mounted() {
      console.log('Create Sequence mounted.')
    }
  }
</script>
