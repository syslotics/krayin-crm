<lead-driver-information></lead-driver-information>

@push('scripts')
<script type="text/x-template" id="lead-driver-information-template">
    <div class="panel">
        <div class="panel-header">
            {{ __('drivers::app.lead.view.index.title') }}
        </div>

        <div class="panel-body custom-attribute-view" style="position: relative">
            <div v-if="driver.driver">
                <div class="attribute-value-row">
                    <div class="label">{{ __('drivers::app.lead.view.index.name') }}</div> 

                    <div class="value" v-text="driver.driver.name"></div>
                </div>

                <div class="attribute-value-row">
                    <div class="label">{{ __('drivers::app.lead.view.index.email') }}</div> 
                
                    <div class="value">
                        <span class="multi-value" v-for="email in driver.driver.email">
                            <span style="color:#263238;"  v-text="email.value"></span>
                            
                            <span v-text="'(' + email.label + ')'"></span>
                        </span>
                    </div>
                </div>

                <div class="attribute-value-row">
                    <div class="label">{{ __('drivers::app.lead.view.index.phone') }}</div> 
                
                    <div class="value">
                        <span class="multi-value" v-for="phone in driver.driver.phone">
                            <span style="color:#263238;" v-text="phone.value"></span>
                            
                            <span v-text="'(' + phone.label + ')'"></span>
                        </span>
                    </div>
                </div>

                <div class="attribute-value-row">
                    <div class="label">{{ __('drivers::app.lead.view.index.cost') }}</div> 
                    
                    <div class="value" v-text="driver.cost"></div>
                </div>

                <div class="attribute-value-row">
                    <div class="label">{{ __('drivers::app.lead.view.index.tax') }}</div> 
                    
                    <div class="value" v-text="driver.tax"></div>
                </div>

                <div class="attribute-value-row">
                    <div class="label">{{ __('drivers::app.lead.view.index.gratuity') }}</div> 
                    
                    <div class="value" v-text="driver.gratuity"></div>
                </div>

                <div class="attribute-value-row">
                    <div class="label">{{ __('drivers::app.lead.view.index.extra-addons') }}</div> 
                    
                    <div class="value" v-text="driver.extra_addons"></div>
                </div>

                <div class="attribute-value-row">
                    <div class="label">{{ __('drivers::app.lead.view.index.total-cost') }}</div> 
                    
                    <div class="value" v-text="driver.total_cost"></div>
                </div>

                <div class="attribute-value-row">
                    <div class="label">{{ __('drivers::app.lead.view.index.source-of-lead') }}</div> 
                    
                    <div class="value" v-text="driver.source_of_lead"></div>
                </div>
            </div>

            <div class="empty-record" v-else>
                <img src="{{ asset('vendor/webkul/admin/assets/images/empty-table-icon.svg') }}">

                <span>{{ __('drivers::app.lead.view.index.no-records-found') }}</span>
            </div>
        </div>
    </div>
</script>

<script>
    Vue.component('lead-driver-information', {

        template: '#lead-driver-information-template',

        data: function () {
            return {
                driver: {},
            }
        },

        mounted() {
            this.get();
        },

        methods: {
            get() {
                this.$http.get(`{{ route('drivers.lead.information.get', ['lead_id' => $lead->id]) }}`)
                    .then(response => {
                        if(response.data.status) {
                            this.driver = response.data.driver;
                        }
                    })
                    .catch(error => {});
            }
        }
    });
</script>
@endpush