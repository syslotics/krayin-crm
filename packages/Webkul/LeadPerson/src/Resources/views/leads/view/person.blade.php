<contact-lead-view></contact-lead-view>

@push('scripts')
    <script type="text/x-template" id="contact-lead-view-template">
        <div class="panel">
            <div class="panel-header">
                {{ __('admin::app.leads.contact-person') }}
            </div>

            <div class="panel-body custom-attribute-view">

                <div class="attribute-value-row">
                    <div class="label">{{ __('drivers::app.datagrid.first_name') }}</div>

                    <div class="value">
                        <a href="{{ route('admin.contacts.persons.edit', $lead->person->id) }}" target="_blank">
                            {{ $lead->person->first_name }}
                        </a>
                    </div>
                </div>

                <div class="attribute-value-row">
                    <div class="label">{{ __('drivers::app.datagrid.last_name') }}</div>

                    <div class="value">                        
                        {{ $lead->person->last_name }}
                    </div>
                </div>

                <div class="attribute-value-row">
                    <div class="label">Email</div>

                    <div class="value">
                        @include ('admin::common.custom-attributes.view.email', ['value' => $lead->person->emails])
                    </div>
                </div>

                <div class="attribute-value-row">
                    <div class="label">Contact Numbers</div>

                    <div class="value">
                        @include ('admin::common.custom-attributes.view.phone', ['value' => $lead->person->contact_numbers])
                    </div>
                </div>

                <div class="attribute-value-row">
                    <div class="label">Organization</div>

                    <div class="value">
                        @if ($lead->person->organization)
                            <a href="{{ route('admin.contacts.organizations.edit', $lead->person->organization->id) }}" target="_blank">
                                {{ $lead->person->organization->name }}
                            </a>
                        @else
                            {{ __('admin::app.common.not-available') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script>
        Vue.component('contact-lead-view', {
            template: '#contact-lead-view-template',

            data: function () {
                return {
                    personsView: [],
                }
            },

            mounted() {
                this.getPerson();
            },

            methods: {
                getPerson() {
                    var self = this;

                    this.$http.get("{{ route('lead.person.index') }}", {
                        params: {
                                person_id: `{{ $lead->person->id }}`,
                                lead_id: `{{ $lead->id }}`
                            }
                        })
                        .then (function(response) {
                            self.personsView = response.data.person;
                        })
                        .catch (function (error) {
                        })
                }
            }
        });
    </script>
@endpush