@section('title', __t($pageTitle))

@push('styles')
  <style>
    .raksmeypay-logo {
      max-width: 180px;
      height: auto;
    }
  </style>
@endpush

<x-app-layout>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    <div class="card">
      <div class="card-body flex flex-col p-6">
        <header class="-mx-6 mb-5 flex items-center border-b border-slate-100 px-6 pb-5 dark:border-slate-700">
          <div class="flex-1">
            <div class="card-title text-slate-900 dark:text-white">{{ __t('Deposit with Bakong Wallet') }}</div>
          </div>
        </header>
        <div class="card-text h-full space-y-4">
          <div class="flex justify-center mb-4 p-3">
            <img src="/cmsnt/cmsnt_light.png" class="raksmeypay-logo" alt="RaksmeypPay" width="250px">
          </div>

          <form id="raksmeypay-form">
            <div class="mb-3">
              <label for="amount" class="form-label">{{ __t('Enter amount') }}: (USD)</label>
              <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount', 5) }}" min="1" step="0.01" required>
              <small class="text-muted">{{ __t('Minimum') }}: $1.00 USD</small>
            </div>

            <div class="mb-3 text-center">
              <button class="btn btn-success w-100" type="submit" id="raksmeypay-btn">
                <i class="fas fa-credit-card"></i> <span>{{ __t('Pay Now') }}</span>
              </button>
            </div>

            <div id="exchange-info" class="alert alert-success text-center" style="display: none;">
              <strong>{{ __t('Exchange Rate') }}:</strong> <span id="exchange-text"></span>
            </div>
          </form>

          <!-- Loading spinner -->
          <div id="loading" class="text-center" style="display: none;">
            <div class="spinner-border text-success" role="status">
              <span class="sr-only">{{ __t('Processing...') }}</span>
            </div>
            <p class="mt-2">{{ __t('Creating payment and redirecting...') }}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body flex flex-col p-6">
        <header class="-mx-6 mb-5 flex items-center border-b border-slate-100 px-6 pb-5 dark:border-slate-700">
          <div class="flex-1">
            <div class="card-title text-slate-900 dark:text-white">{{ __t('Important Notes') }}</div>
          </div>
        </header>
        <div class="card-text h-full space-y-4">
          {!! Helper::getNotice('page_deposit_raksmeypay') !!}
        </div>
      </div>
    </div>
    <div class="card col-span-2">
      <header class="card-header noborder">
        <h4 class="card-title">{{ __t('Invoice List') }}</h4>
      </header>
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <span class="col-span-8 hidden"></span>
          <span class="col-span-4 hidden"></span>
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden">
              <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 whitespace-nowrap" id="data-table">
                <thead class="border-t border-slate-100 dark:border-slate-800">
                  <tr>
                    <th scope="col" class="table-th">
                      Id
                    </th>

                    <th scope="col" class="table-th">
                      {{ __t('Action') }}
                    </th>

                    <th scope="col" class="table-th">
                      {{ __t('Transaction ID') }}
                    </th>

                    <th scope="col" class="table-th">
                      {{ __t('Amount') }}
                    </th>

                    <th scope="col" class="table-th">
                      {{ __t('Status') }}
                    </th>

                    <th scope="col" class="table-th">
                      {{ __t('Time') }}
                    </th>

                    <th scope="col" class="table-th">
                      {{ __t('Update') }}
                    </th>

                    <th scope="col" class="table-th">
                      {{ __t('Note') }}
                    </th>

                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                  @foreach ($invoices as $item)
                    <tr>
                      <td class="table-td">{{ $item->id }}</td>
                      <td class="table-td">
                        @if ($item->status === 'processing')
                          @if (isset($item->payment_details['payment_link']))
                            <a href="{{ $item->payment_details['payment_link'] }}" target="_blank" class="btn btn-sm btn-success">
                              <i class="fas fa-external-link-alt"></i> <span>{{ __t('Pay') }}</span>
                            </a>
                          @else
                            <span class="text-muted">{{ __t('Processing...') }}</span>
                          @endif
                        @endif
                      </td>
                      <td class="table-td">{{ $item->code }}</td>
                      <td class="table-td">{{ Helper::formatCurrency($item->amount) }}</td>
                      <td class="table-td">{!! Helper::formatStatus($item->status) !!}</td>
                      <td class="table-td">{{ $item->created_at }}</td>
                      <td class="table-td">{{ $item->updated_at }}</td>

                      <td class="table-td">
                        <span class="text-wrap">{{ $item->description }}</span>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

          </div>
        </div>
        <div class="p-4">
          {{ $invoices->links() }}
        </div>
      </div>
    </div>
    @push('scripts')
      <script>
        (function($) {
          const exchangeRate = {{ $config['exchange_kh'] ?? 4000 }};

          // Update exchange rate display
          function updateExchangeInfo() {
            const usdAmount = parseFloat($('#amount').val()) || 0;
            const khrAmount = usdAmount * exchangeRate;

            if (usdAmount > 0) {
              // $('#exchange-text').text(`1 USD = ${exchangeRate.toLocaleString()} KHR | $${usdAmount.toFixed(2)} ≈ ${khrAmount.toLocaleString()} KHR`);
              $('#exchange-text').text(`$${usdAmount.toFixed(2)} ≈ ${khrAmount.toLocaleString()} KHR`);
              $('#exchange-info').show();
            } else {
              $('#exchange-info').hide();
            }
          }

          // Update exchange info when amount changes
          $('#amount').on('input change', updateExchangeInfo);
          updateExchangeInfo();

          // Handle form submission
          $('#raksmeypay-form').on('submit', function(e) {
            e.preventDefault();

            const amount = parseFloat($('#amount').val());

            if (amount < 1) {
              Swal.fire('Error', 'Minimum amount is $1.00 USD', 'error');
              return;
            }

            // Show loading
            $('#loading').show();
            $('#raksmeypay-form').hide();
            $('#raksmeypay-btn').prop('disabled', true);

            // Create payment link
            axios.post('/api/deposit/raksmeypay-create', {
              amount: amount,
              currency: 'USD'
            }).then(({
              data: result
            }) => {
              if (result.status === 200) {
                // Redirect immediately to payment link
                if (result.data.payment_link) {
                  window.location.href = result.data.payment_link;
                } else {
                  throw new Error('Cannot get payment link');
                }
              } else {
                throw new Error(result.message || 'An error occurred');
              }
            }).catch(error => {
              $('#loading').hide();
              $('#raksmeypay-form').show();
              $('#raksmeypay-btn').prop('disabled', false);
              Swal.fire('Error', $catchMessage(error), 'error');
            });
          });

        })(jQuery);
      </script>
    @endpush
</x-app-layout>
