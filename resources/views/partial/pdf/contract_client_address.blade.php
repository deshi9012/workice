<div>
  <div>{{ $contract->company->name }}</div>
  @if ($contract->company->primary_contact > 0)
  <div>{{ $contract->company->contact->name }}</div>
  @endif
  <div class="text-semibold">{{ $contract->company->email }}</div>
  <div>{{ $contract->company->address1 }} </div>
  <div>{{ $contract->company->address2 }} </div>
  <div>{{ $contract->company->city }}, {{ $contract->company->state }}, {{ $contract->company->zip }}, {{ $contract->company->country }}</div>

  </div>