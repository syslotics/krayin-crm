
<tab name="{{ __('drivers::app.lead.form.create.heading') }}">
    <driver-information :data='@json(old('driver'))'></driver-information>
</tab>

@push('scripts')
    <script type="text/x-template" id="driver-information-template">
        <div class="driver-controls">
            <!-- Name -->
            <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}driver[name]') ? 'has-error' : '']">
                <label for="driver[name]" class="required">{{ __('drivers::app.datagrid.first_name') }}</label>

                <input
                    type="text"
                    name="drivers[name]"
                    class="control"
                    id="driver[first_name]"
                    v-model="driver.first_name"
                    autocomplete="off"
                    placeholder="{{ __('admin::app.common.start-typing') }}"
                    v-validate="'required'"
                    data-vv-as="&quot;{{ __('drivers::app.lead.form.create.name') }}&quot;"
                    v-on:keyup="search"
                />

                <input
                    type="hidden"
                    name="drivers[driver_id]"
                    v-model="driver.id"
                    v-validate="'required'"
                    data-vv-as="&quot;{{ __('drivers::app.lead.form.create.name') }}&quot;"
                    v-if="driver.id"
                />

                <div class="lookup-results" v-if="state == ''">
                    <ul>
                        <li v-for='(driver, index) in driverData' @click="addDriver(driver)">
                            <span>@{{ driver.first_name }}</span>
                        </li>

                        <li v-if="! driverData.length && driver['first_name'].length && ! is_searching">
                            <span>{{ __('admin::app.common.no-result-found') }}</span>
                        </li>

                        <li class="action" v-if="driver['first_name'].length && ! is_searching" @click="addAsNew()">
                            <span>
                                + {{ __('admin::app.common.add-as') }}
                            </span> 
                        </li>
                    </ul>
                </div>

                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}driver[name]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}driver[first_name]') }}
                </span>
            </div>

            <!-- Last Name -->
            <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}driver[last_name]') ? 'has-error' : '']">
                <label for="driver[last_name]" class="required">{{ __('drivers::app.datagrid.last_name') }}</label>

                <input
                    type="text"
                    name="drivers[last_name]"
                    class="control"
                    id="driver[last_name]"
                    v-model="driver.last_name"
                    autocomplete="off"
                    placeholder="{{ __('drivers::app.datagrid.last_name') }}"
                    v-validate="'required'"
                    data-vv-as="&quot;{{ __('drivers::app.datagrid.last_name') }}&quot;"
                />

                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}driver[last_name]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}driver[last_name]') }}
                </span>
            </div>

            <!-- Phone -->
            <div class="form-group contact-numbers">
                <label for="driver[phone]">{{ __('drivers::app.lead.form.create.phone') }}</label>

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
                        'first_name': ''
                    },

                    driverData: [],
                }
            },
            methods: {
                search: debounce(function () {
                    this.state = '';

                    this.driver = {
                        'first_name': this.driver['first_name']
                    };

                    this.is_searching = true;

                    if (this.driver['first_name'].length < 2) {
                        this.driverData = [];

                        this.is_searching = false;

                        return;
                    }

                    var self = this;
                    
                    this.$http.get("{{ route('drivers.information.search') }}", {params: {query: this.driver['first_name']}})
                        .then (function(response) {
                            self.driverData = response.data;

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
