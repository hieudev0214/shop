@section('title', __t($pageTitle))

<x-app-layout>
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">

    <!-- Success Result Card -->
    <div class="card col-span-1 lg:col-span-2">
      <div class="card-body flex flex-col p-6">
        <div class="card-text h-full space-y-4">
          <!-- Success Icon & Message -->
          <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
              <i class="fas fa-check-circle text-green-600" style="font-size: 4rem;"></i>
            </div>
            <h2 class="text-2xl font-bold text-green-600 mb-2">{{ __t('Payment Success!') }}</h2>
            <p class="text-gray-600">{{ __t('Your transaction has been successfully completed') }}</p>
          </div>

          <!-- Success Alert -->
          <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <strong>{{ __t('Success!') }}</strong>
            {{ __t('Your account balance has been updated. Thank you for using our service.') }}
          </div>

          <!-- Transaction Details -->
          <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <div class="form-group">
                  <label class="form-label">{{ __t('Transaction ID') }}</label>
                  <input type="text" class="form-control" value="{{ $transactionId }}" readonly>
                </div>
              </div>
              <div>
                <div class="form-group">
                  <label class="form-label">{{ __t('Invoice ID') }}</label>
                  <input type="text" class="form-control" value="{{ $invoice->code }}" readonly>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <div class="form-group">
                  <label class="form-label">{{ __t('USD Amount') }}</label>
                  <input type="text" class="form-control text-primary font-weight-bold" value="${{ number_format($invoice->payment_details['usd_amount'] ?? 0, 2) }}" readonly>
                </div>
              </div>
              <div>
                <div class="form-group">
                  <label class="form-label">{{ __t('VND Amount') }}</label>
                  <input type="text" class="form-control text-success font-weight-bold" value="{{ Helper::formatCurrency($invoice->amount) }}" readonly>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <div class="form-group">
                  <label class="form-label">{{ __t('Status') }}</label>
                  <input type="text" class="form-control text-success font-weight-bold" value="{{ __t('Success') }}" readonly>
                </div>
              </div>
              <div>
                <div class="form-group">
                  <label class="form-label">{{ __t('Time') }}</label>
                  <input type="text" class="form-control" value="{{ now()->format('d/m/Y H:i:s') }}" readonly>
                </div>
              </div>
            </div>
          </div>

          <!-- Back Button -->
          <div class="text-center mt-4">
            <a href="{{ route('account.deposits.raksmeypay') }}" class="btn btn-primary btn-lg">
              <i class="fas fa-arrow-left"></i> {{ __t('Back to Deposit Page') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
