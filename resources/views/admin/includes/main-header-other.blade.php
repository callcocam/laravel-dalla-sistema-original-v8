<div class="main-header bg-white d-flex justify-content-between p-2">
    <div style="margin: auto"></div>
    <div class="header-part-right mr-16">
    @if($notifications)
        <!-- Notificaiton -->
            <div class="dropdown">
                <div class="badge-top-container" role="button" id="dropdownNotification" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                    <span class="badge badge-primary">{{ $notificationsCount }}</span>
                    <i class="i-Bell text-muted header-icon"></i>
                </div>
                <!-- Notification dropdown -->
                <div class="dropdown-menu dropdown-menu-right notification-dropdown rtl-ps-none"
                     aria-labelledby="dropdownNotification" data-perfect-scrollbar data-suppress-scroll-x="true">
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
                        <a href="{{ route('admin.posts.index') }}" class="dropdown-item d-flex btn btn-block btn-secondary">
                            <div class="notification-icon">
                                <i class="i-Library text-primary mr-1"></i>
                            </div>
                            <div class="notification-details flex-grow-1">
                                <p class="m-0 mb-3 d-flex align-items-center">
                                    <span>Ver todas as notificações?</span>
                                    <span class="flex-grow-1"></span>
                                </p>
                            </div>
                        </a>
                </div>
            </div>
            <!-- Notificaiton End -->
        @endif
    </div>
</div>
