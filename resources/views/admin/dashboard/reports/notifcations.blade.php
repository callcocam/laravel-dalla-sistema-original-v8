<div class="card mb-30">
    <div class="card-body">
        @if($notifications)
            <div class="card-title">Ùltimos Nofificações</div>
            @foreach($notifications as $notification)
                <a href="{{ route('admin.posts.show', $notification->id) }}" class="dropdown-item d-flex">
                    <div class="notification-icon">
                        <i class="i-Speach-Bubble-6 text-primary mr-1"></i>
                    </div>
                    <div class="notification-details flex-grow-1">
                        <p class="m-0 d-flex align-items-center">
                            <span>{{ $notification->name }}</span>
                            @if($notification->created_at->isCurrentDay())
                                <span class="badge badge-pill badge-primary ml-1 mr-1">nova</span>
                            @endif
                            <span class="flex-grow-1"></span>
                            <span
                                class="text-small text-muted ml-auto">{{ $notification->created_at->diffForHumans() }}</span>
                        </p>
                        <p class="text-small text-muted m-0">{{ $notification->user->name }}</p>
                    </div>
                </a>
            @endforeach
            <a href="{{ route('admin.posts.all.index') }}" class="font-weight-359  mt-5 rounded d-flex btn btn-block btn-secondary">
                <span>Ver todas as notificações?</span>
            </a>
        @endif
    </div>
</div>
