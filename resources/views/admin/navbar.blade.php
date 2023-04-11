<nav class="main-header navbar navbar-expand navbar-black navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('admin.home') }}" class="nav-link">Trang chủ</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Liên hệ</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <style>
      .fa-comments {
        font-size: 25px;
        align-items: center;
        margin-top: 10px;
      }
    </style>
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">{{ empty($messages) ? 0 : count($messages->toArray()) }}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        @if(!empty($messages))
        @foreach ($messages ?? [] as $message)
        <a href="{{ route('chats.index') }}" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src=" ./imgUser/{{ $message->user?->filename}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                {{$message->user}}
                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm"> {{$message->message}}</p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ $message->created_at->diffForHumans()}}</p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        
        @endforeach
        
        @else
          <a href="{{ route('chats.index') }}" class="dropdown-item dropdown-footer">Không có tin nhắn mới </a>
        @endif
        <a href="{{ route('chats.index') }}" class="dropdown-item dropdown-footer">Xem tất cả </a>
      </div>
    </li> 
    <x-app-layout>
    </x-app-layout>
  </ul>
</nav>