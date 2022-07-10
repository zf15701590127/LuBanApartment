<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ active_class(if_route('fore.reports.payments.index')) }}" aria-current="page" href="{{ route('fore.reports.payments.index')}}">交易流水</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ active_class(if_route('fore.reports.bills.index')) }}" aria-current="page" href="{{ route('fore.reports.bills.index') }}">流水明细</a>
  </li>
</ul>
