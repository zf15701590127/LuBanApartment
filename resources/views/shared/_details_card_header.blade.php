<div class="card-header">
  <ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('fore.contracts.leaseDetails.show')) }}" aria-current="true" href="{{ route('fore.contracts.leaseDetails.show', 1) }}">基本信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('fore.contracts.contractDetails.show')) }}" href="{{ route('fore.contracts.contractDetails.show', 1) }}">合同信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('fore.contracts.residentDetails.show')) }}" href="{{ route('fore.contracts.residentDetails.show', 1) }}">入住人信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('fore.contracts.accountDetails.show')) }}" href="{{ route('fore.contracts.accountDetails.show', 1) }}">房租账单</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('fore.contracts.utilityDetails.show')) }}" href="{{ route('fore.contracts.utilityDetails.show', 1) }}">水电费明细</a>
    </li>
  </ul>
</div>
