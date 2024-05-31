<quote-invoice></quote-invoice>

@push('scripts')
    <script type="text/x-template" id="quote-invoice-template">
        <button 
            type="button" 
            class="btn btn-md btn-success"
            @click="sendInvoice(quote.id)"
            style="margin-right:0px;"
            :disabled="isDisabled"
        >
            <span v-if="isSending">
                {{ __('stripe::app.quotes.sending') }}
            </span>

            <span v-else>
                {{ __('stripe::app.quotes.send-invoice-btn') }}
            </span>
        </button>
    </script>

    <script>
        Vue.component('quote-invoice', {

            template: '#quote-invoice-template',

            data: function () {
                return {
                    quote: @json($quote),
                    isDisabled: true,
                    isSending: false,
                }
            },

            mounted() {
                this.isDisabled = this.quote.is_payment_completed == null;
            },

            methods: {
                sendInvoice(id) {
                    if(this.isDisabled) {
                        return false;
                    }

                    this.isSending = true;
                    this.isDisabled = true;

                    this.$http.get("{{ route('payment.send.invoice') }}", {
                        params: {
                            quote_id: id,
                        }
                    })
                    .then (response => {
                        this.isSending = false;
                        this.isDisabled = false;

                        if(response.data.status) {
                            window.flashMessages = [{'type': 'success', 'message': response.data.message}];
                        } else {
                            window.flashMessages = [{'type': 'error', 'message': response.data.message}];
                        }
                        
                        this.$root.addFlashMessages();
                    })
                    .catch (error => {
                        window.flashMessages = [{'type': 'error', 'message': response.data.message}];
                        
                        this.$root.addFlashMessages();
                    })
                }
            }
        });
    </script>
@endpush