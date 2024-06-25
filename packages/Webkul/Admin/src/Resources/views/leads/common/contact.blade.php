@push('scripts')
    <script type="text/x-template" id="contact-component-template">
        <div class="contact-controls">
            
            <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}person[first_name]') ? 'has-error' : '']">
                <label for="person[first_name]" class="required">{{ __('drivers::app.datagrid.first_name') }}</label>

                <input
                    type="text"
                    name="persons[first_name]"
                    class="control"
                    id="person[first_name]"
                    v-model="person.first_name"
                    autocomplete="off"
                    placeholder="{{ __('admin::app.common.start-typing') }}"
                    v-validate="'required'"
                    data-vv-as="&quot;{{ __('admin::app.leads.first_name') }}&quot;"
                    v-on:keyup="search"
                />

                <input
                    type="hidden"
                    name="persons[id]"
                    v-model="person.id"
                    v-validate="'required'"
                    data-vv-as="&quot;{{ __('admin::app.leads.name') }}&quot;"
                    v-if="person.id"
                />

                <div class="lookup-results" v-if="state == ''">
                    <ul>
                        <li v-for='(person, index) in persons' @click="addPerson(person)">
                            <span>@{{ person.first_name }}</span>
                        </li>

                        <li v-if="! persons.length && person['first_name'].length && ! is_searching">
                            <span>{{ __('admin::app.common.no-result-found') }}</span>
                        </li>

                        <li class="action" v-if="person['first_name'].length && ! is_searching" @click="addAsNew()">
                            <span>
                                + {{ __('admin::app.common.add-as') }}
                            </span> 
                        </li>
                    </ul>
                </div>

                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}person[first_name]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}person[first_name]') }}
                </span>
            </div>

            <!-- Last Name -->
            <div class="form-group" :class="[errors.has('{!! $formScope ?? '' !!}driver[last_name]') ? 'has-error' : '']">
                <label for="driver[last_name]" class="required">{{ __('drivers::app.datagrid.last_name') }}</label>
    
                <input
                    type="text"
                    name="person[last_name]"
                    class="control"
                    id="person[last_name]"
                    v-model="person.last_name"
                    autocomplete="off"
                    placeholder="{{ __('drivers::app.datagrid.last_name') }}"
                    v-validate="'required'"
                    data-vv-as="&quot;{{ __('drivers::app.datagrid.last_name') }}&quot;"
                />

                <span class="control-error" v-if="errors.has('{!! $formScope ?? '' !!}person[last_name]')">
                    @{{ errors.first('{!! $formScope ?? '' !!}person[last_name]') }}
                </span>
            </div>

            <div class="form-group email">
                <label for="person[emails]" class="required">{{ __('admin::app.leads.email') }}</label>

                @include('admin::common.custom-attributes.edit.email', ['formScope' => $formScope ?? ''])
                    
                <email-component
                    :attribute="{'code': 'persons[emails]', 'name': 'Email'}"
                    :data="person.emails"
                    validations="required|email"
                ></email-component>
            </div>

            <div class="form-group contact-numbers">
                <label for="person[contact_numbers]">{{ __('admin::app.leads.contact-numbers') }}</label>

                @include('admin::common.custom-attributes.edit.phone', ['formScope' => $formScope ?? ''])
                
                <phone-component
                    :attribute="{'code': 'persons[contact_numbers]', 'name': 'Contact Numbers'}"
                    :data="numbers"
                ></phone-component>
            </div>

            <div class="form-group organization">
                <label for="address">{{ __('admin::app.leads.organization') }}</label>

                @php
                    $organizationAttribute = app('Webkul\Attribute\Repositories\AttributeRepository')->findOneWhere([
                        'entity_type' => 'persons',
                        'code'        => 'organization_id'
                    ]);

                    $organizationAttribute->code = 'persons[' . $organizationAttribute->code . ']';
                @endphp

                @include('admin::common.custom-attributes.edit.lookup')

                <lookup-component
                    :attribute='@json($organizationAttribute)'
                    :data="person.organization"
                ></lookup-component>
            </div>
        </div>
    </script>

    <script>
        Vue.component('contact-component', {

            template: '#contact-component-template',
    
            props: ['detail', 'numbers'],

            inject: ['$validator'],

            data: function () {
                return {
                    is_searching: false,

                    state: this.detail ? 'old': '',

                    person: this.detail ? this.detail : {
                        'first_name': ''
                    },

                    persons: [],
                }
            },

            methods: {
                search: debounce(function () {
                    this.state = '';

                    this.person = {
                        'first_name': this.person['first_name']
                    };

                    this.is_searching = true;

                    if (this.person['first_name'].length < 2) {
                        this.persons = [];

                        this.is_searching = false;

                        return;
                    }

                    var self = this;
                    
                    this.$http.get("{{ route('admin.contacts.persons.search') }}", {params: {query: this.person['first_name']}})
                        .then (function(response) {
                            self.persons = response.data;

                            self.is_searching = false;
                        })
                        .catch (function (error) {
                            self.is_searching = false;
                        })
                }, 500),

                addPerson: function(result) {
                    this.state = 'old';

                    this.person = result;
                },

                addAsNew: function() {
                    this.state = 'new';
                }
            }
        });
    </script>
@endpush