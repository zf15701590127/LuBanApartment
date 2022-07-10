<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ active_class(if_route('fore.reserves.reserves.index')) }}" aria-current="page" href="{{ route('fore.reserves.reserves.index') }}">预定列表</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ active_class(if_route('fore.contracts.contracts.index')) }}" aria-current="page" href="{{ route('fore.contracts.contracts.index') }}">在住合同</a>
  </li>
</ul>
