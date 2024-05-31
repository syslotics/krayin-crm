<tab name="{{ __('drivers::app.lead.form.create.heading') }}">
    <driver-information :data='@json(old('driver'))'></driver-information>
</tab>

@push('scripts')
    <script type="text/x-template" id="driver-information-template">
        <div class="driver-controls">
            <!-- Name -->
            <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}driver[name]') ? 'has-error' : '']">
                <label for="driver[name]" class="required">{{ __('drivers::app.lead.form.create.name') }}</label>
    
                <input
                    type="text"
                    name="drivers[name]"
                    class="control"
                    id="driver[name]"
                    v-model="driver.name"
                    autocomplete="off"
                    placeholder="{{ __('admin::app.common.start-typing') }}"
                    v-validate="'required'"
                    data-vv-as="&quot;{{ __('drivers::app.lead.form.create.name') }}&quot;"
                    v-on:keyup="search"
                />

                <input
                    type="hidden"
                    name="drivers[driver_id]"
                    v-model="driver.driver_id"
                    v-validate="'required'"
                    data-vv-as="&quot;{{ __('drivers::app.lead.form.create.name') }}&quot;"
                    v-if="drivers.id"
                />

                <div class="lookup-results" v-if="search_drivers.length">
                    <ul>
                        <li v-for='(driver, index) in search_drivers' @click="addDriver(driver)">
                            <span>@{{ driver.name }}</span>
                        </li>

                        <li v-if="! search_drivers.length && ! is_searching">
                            <span>{{ __('admin::app.common.no-result-found') }}</span>
                        </li>

                        <li class="action" v-if="! is_searching" @click="addAsNew()">
                            <span>
                                + {{ __('admin::app.common.add-as') }}
                            </span> 
                        </li>
                    </ul>
                </div>

                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}driver[name]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}driver[name]') }}
                </span>
            </div>

            <!-- Phone -->
            <div class="form-group contact-numbers">
                <label for="drivers[phone]">{{ __('drivers::app.lead.form.create.phone') }}</label>

                @include('admin::common.custom-attributes.edit.phone', ['formScope' => $formScope ?? ''])
                    
                <phone-component
                    :attribute="{'code': 'drivers[phone]', 'name': 'Contact Numbers'}"
                    :data="driver.phone"
                ></phone-component>
            </div>

            <!-- email -->
            <div class="form-group email">
                <label for="driver[email]">{{ __('drivers::app.lead.form.create.email') }}</label>

                @include('admin::common.custom-attributes.edit.email', ['formScope' => $formScope ?? ''])
                    
                <email-component
                    :attribute="{'code': 'drivers[email]', 'name': 'Email Address'}"
                    :data="driver.email"
                ></email-component>
            </div>

            <!-- Cost -->
            <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}driver[cost]') ? 'has-error' : '']">
                <label for="driver[cost]" class="required">{{ __('drivers::app.lead.form.create.cost') }}</label>

                <input
                    type="text"
                    name="drivers[cost]"
                    class="control"
                    id="driver[cost]"
                    v-model="driver.cost"
                    autocomplete="off"
                    v-validate="'required|decimal:10'"
                    data-vv-as="&quot;{{ __('drivers::app.lead.form.create.cost') }}&quot;"
                />

                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}driver[cost]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}driver[cost]') }}
                </span>
            </div>

            <!-- Tax -->
            <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}driver[tax]') ? 'has-error' : '']">
                <label for="driver[tax]" class="required">{{ __('drivers::app.lead.form.create.tax') }}</label>

                <input
                    type="text"
                    name="drivers[tax]"
                    class="control"
                    id="driver[tax]"
                    v-model="driver.tax"
                    autocomplete="off"
                    v-validate="'required|decimal:10'"
                    data-vv-as="&quot;{{ __('drivers::app.lead.form.create.tax') }}&quot;"
                />

                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}driver[tax]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}driver[tax]') }}
                </span>
            </div>

            <!-- Gratuity -->
            <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}driver[gratuity]') ? 'has-error' : '']">
                <label for="driver[gratuity]" class="required">{{ __('drivers::app.lead.form.create.gratuity') }}</label>

                <input
                    type="text"
                    name="drivers[gratuity]"
                    class="control"
                    id="driver[gratuity]"
                    v-model="driver.gratuity"
                    autocomplete="off"
                    v-validate="'required|decimal:10'"
                    data-vv-as="&quot;{{ __('drivers::app.lead.form.create.gratuity') }}&quot;"
                />

                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}driver[gratuity]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}driver[gratuity]') }}
                </span>
            </div>

            <!-- Extra Addons -->
            <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}driver[extra_addons]') ? 'has-error' : '']">
                <label for="driver[extra_addons]" class="required">{{ __('drivers::app.lead.form.create.extra-addons') }}</label>

                <input
                    type="text"
                    name="drivers[extra_addons]"
                    class="control"
                    id="driver[extra_addons]"
                    v-model="driver.extra_addons"
                    autocomplete="off"
                    v-validate="'required|decimal:10'"
                    data-vv-as="&quot;{{ __('drivers::app.lead.form.create.extra-addons') }}&quot;"
                />

                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}driver[extra_addons]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}driver[extra_addons]') }}
                </span>
            </div>

            <!-- Total Cost -->
            <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}driver[total_cost]') ? 'has-error' : '']">
                <label for="driver[total_cost]" class="required">{{ __('drivers::app.lead.form.create.total-cost') }}</label>

                <input
                    type="text"
                    name="drivers[total_cost]"
                    class="control"
                    id="driver[total_cost]"
                    v-model="driver.total_cost"
                    autocomplete="off"
                    v-validate="'required|decimal:10'"
                    data-vv-as="&quot;{{ __('drivers::app.lead.form.create.total-cost') }}&quot;"
                />

                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}driver[total_cost]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}driver[total_cost]') }}
                </span>
            </div>

            <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}driver[source_of_lead]') ? 'has-error' : '']">
                <label for="driver[source_of_lead]" class="required">{{ __('drivers::app.lead.form.create.source-of-lead') }}</label>

                <input
                    type="text"
                    name="drivers[source_of_lead]"
                    class="control"
                    id="driver[source_of_lead]"
                    v-model="driver.source_of_lead"
                    autocomplete="off"
                    v-validate="'required'"
                    data-vv-as="&quot;{{ __('drivers::app.lead.form.create.source-of-lead') }}&quot;"
                />

                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}driver[source_of_lead]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}driver[source_of_lead]') }}
                </span>
            </div>
        </div>
    </script>

    <script>
        Vue.component('driver-information', {

            template: '#driver-information-template',
            
            props: ['data'],

            inject: ['$validator'],
            
            data: function () {
                return {
                    is_searching: false,

                    state: this.data ? 'old': '',

                    driver: this.data ? this.data : {
                        'name': ''
                    },

                    drivers: [],

                    search_drivers: [],
                }
            },

            mounted() {
                this.get();
            },

            methods: {
                get() {
                    var self = this;

                    this.$http.get("{{ route('drivers.lead.edit') }}", {
                        params: {
                                driver_id: `{{ $lead->driver?->driver_id }}`,
                                lead_id: `{{ $lead->id }}`
                            }
                        })
                        .then (function(response) {
                            self.driver = response.data.driver_lead;
                        })
                        .catch (function (error) {
                        })
                },

                search: debounce(function () {
                    this.state = '';

                    this.driver = {
                        'name': this.drivers.name
                    };

                    this.is_searching = true;

                    var self = this;

                    this.$http.get("{{ route('drivers.information.search') }}", {
                        params: {
                            query: this.drivers.name
                        }})
                        .then (function(response) {

                            self.driver = [];

                            self.search_drivers = response.data;

                            self.is_searching = false;
                        })
                        .catch (function (error) {
                            self.is_searching = false;
                        })
                }, 500),

                addDriver: function(result) {
                    this.state = 'old';
                    
                    this.driver = result;
                },

                addAsNew: function() {
                    this.state = 'new';
                }
            }
        });
    </script>
@endpush