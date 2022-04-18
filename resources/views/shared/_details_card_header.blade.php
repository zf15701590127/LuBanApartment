<div class="card-header">
  <ul class="nav nav-tabs card-header-tabs">
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('leaseDetails.show')) }}" aria-current="true" href="{{ route('leaseDetails.show', 1) }}">基本信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('contractDetails.show')) }}" href="{{ route('contractDetails.show', 1) }}">合同信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('residentDetails.show')) }}" href="{{ route('residentDetails.show', 1) }}">入住人信息</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('accountDetails.show')) }}" href="{{ route('accountDetails.show', 1) }}">房租账单</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ active_class(if_route('utilityDetails.show')) }}" href="{{ route('utilityDetails.show', 1) }}">水电费明细</a>
    </li>
  </ul>
</div>
