<?php

namespace App\Services\Admin;

use App\Repositories\Member\NotificationRepository;
use App\Jobs\SendNotificationToMembers;

class NotificationService
{
    public function __construct(
        NotificationRepository $notificationRepository
    ) {
        $this->notificationRepository = $notificationRepository;
    }

    public function create($request)
    {
        $notification = $this->notificationRepository->create($request);

        SendNotificationToMembers::dispatch($notification);
    }
}
