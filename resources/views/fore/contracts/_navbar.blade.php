<div class="card-header mb-3 bg-white">
  <ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('fore.contracts.leases.show')) }}" aria-current="true" href="{{ route('fore.contracts.leases.show', $roomCustomer->id) }}">基本信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('fore.contracts.contracts.show')) }}" href="{{ route('fore.contracts.contracts.show', $roomCustomer->id) }}">合同信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('fore.contracts.contractCustomers.show')) }}" href="{{ route('fore.contracts.contractCustomers.show', $roomCustomer->id) }}">入住人信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('fore.contracts.orders.show')) }}" href="{{ route('fore.contracts.orders.show', $roomCustomer->id) }}">房租账单</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('fore.contracts.utilities.show')) }}" href="{{ route('fore.contracts.utilities.show', $roomCustomer->id) }}">水电费明细</a>
    </li>
  </ul>
</div>
