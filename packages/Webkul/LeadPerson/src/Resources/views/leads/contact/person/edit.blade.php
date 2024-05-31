
@push('scripts')
    <script type="text/x-template" id="contact-lead-form-edit-template">
        <span>
            <div v-for="attribute in attributes" class="form-group">
                <div v-if="attribute.type == 'select'">
                    <label :for="attribute.code" :class="attribute.is_required ? 'required' : ''" v-text="attribute.name"></label>

                    <select 
                        v-validate="attribute.is_required ? 'required' : ''" 
                        class="control" 
                        :id="attribute.code" 
                        :name="'persons[' + attribute.code + ']'" 
                        data-vv-as="attribute.name"
                    >
                        <option value="" selected="selected" disabled="disabled">
                            {{ __('admin::app.settings.attributes.select') }}
                        </option>

                        <template v-for="option in attribute.options">
                            <option :value="option.id" :selected="option.id == persons[attribute.code]">
                                <span v-text="option.name"></span>
                            </option>
                        </template>
                    </select>
                </div>

                <div class="" v-else-if="attribute.type == 'date'">
                    <label :for="attribute.code" :class="attribute.is_required ? 'required' : ''" v-text="attribute.name"></label>

                    <date>
                        <input
                            type="text"
                            :name="'persons[' + attribute.code + ']'"
                            class="control"
                            :id="attribute.code"
                            :value="persons[attribute.code]"
                            v-validate="attribute.is_required ? 'required' : ''" 
                            data-vv-as="attribute.name"
                        />
                    </date>
                </div>

                <div class="form-group time" v-else-if="attribute.type == 'time'">
                    <label :for="attribute.code" :class="attribute.is_required ? 'required' : ''" v-text="attribute.name"></label>

                    <time-component>
                        <input 
                            type="text" 
                            :name="'persons[' + attribute.code + ']'"
                            class="control"
                            :id="attribute.code"
                            :value="persons[attribute.code]"
                            v-validate="attribute.is_required ? 'required' : ''" 
                            data-vv-as="attribute.name"
                        />
                    </time-component>
                </div>

                <div class="form-group" v-else>
                    <label :for="attribute.code" :class="attribute.is_required ? 'required' : ''" v-text="attribute.name"></label>

                    <input
                        :type="attribute.type"
                        :name="'persons[' + attribute.code + ']'"
                        class="control"
                        :id="attribute.code" 
                        :value="persons[attribute.code]"
                        v-validate="attribute.is_required ? 'required' : ''" 
                        data-vv-as="attribute.name"
                    />
                </div>
            </div>
        </span>
    </script>

    <script>
        Vue.component('contact-lead-form-edit', {
            template: '#contact-lead-form-edit-template',
    
            props: ['data'],

            data: function () {
                return {
                    attributes: @json(app('Webkul\Attribute\Repositories\AttributeRepository')->with('options')->findWhere(['entity_type' => 'persons', 'is_user_defined' => 1])),
                    persons: [],
                }
            },

            mounted() {
                this.get();
            },

            methods: {
                get() {
                    var self = this;

                    this.$http.get("{{ route('lead.person.index') }}", {
                        params: {
                                person_id: this.data.id,
                                lead_id: `{{ $lead->id }}`
                            }
                        })
                        .then (function(response) {
                            self.persons = response.data.person;
                        })
                        .catch (function (error) {
                        })
                }
            }
        });
    </script>
@endpush