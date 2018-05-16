<?php
return
[
    /*队列配置*/
    'rabbitmq_queue' => env('RABBITMQ_QUEUE', ''),
    'rabbitmq_host' => env('RABBITMQ_HOST', '127.0.0.1'),
    'rabbitmq_port' => env('RABBITMQ_PORT', '5672'),
    'rabbitmq_vhost' => env('RABBITMQ_VHOST', '/'),
    'rabbitmq_login' => env('RABBITMQ_LOGIN', 'guest'),
    'rabbitmq_password' => env('RABBITMQ_PASSWORD','guest'),

    /*模型命名空间配置*/
    'models_namespace' =>'App\Models',

    /*事件监听者设置*/
    'listens' =>
    [
        // Foundation Init
        'wiltechsteam\FoundationService\Events\FoundationInitializationEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\FoundationInitializationEventListener',
        ],

        // CN Staff
        'wiltechsteam\FoundationService\Events\StaffCNAddedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\StaffCNAddedEventListener',
        ],
        'wiltechsteam\FoundationService\Events\StaffCNUpdatedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\StaffCNUpdatedEventListener',
        ],
        'wiltechsteam\FoundationService\Events\UserAccountCNAddedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\UserAccountCNAddedEventListener',
        ],

        // CN Position
        'wiltechsteam\FoundationService\Events\PositionCNAddedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\PositionCNAddedEventListener',
        ],
        'wiltechsteam\FoundationService\Events\PositionCNDeletedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\PositionCNDeletedEventListener',
        ],
        'wiltechsteam\FoundationService\Events\PositionCNUpdatedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\PositionCNUpdatedEventListener',
        ],

        // CN Unit
        'wiltechsteam\FoundationService\Events\UnitCNAddedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\UnitCNAddedEventListener',
        ],
        'wiltechsteam\FoundationService\Events\UnitCNDeletedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\UnitCNDeletedEventListener',
        ],
        'wiltechsteam\FoundationService\Events\UnitCNUpdatedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\UnitCNUpdatedEventListener',
        ],
        'wiltechsteam\FoundationService\Events\UnitCNMovedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\UnitCNMovedEventListener',
        ],

        // US Staff
        'wiltechsteam\FoundationService\Events\StaffUSAddedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\StaffUSAddedEventListener',
        ],

        'wiltechsteam\FoundationService\Events\StaffUSUpdatedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\StaffUSUpdatedEventListener',
        ],

        // US Position
        'wiltechsteam\FoundationService\Events\PositionUSAddedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\PositionUSAddedEventListener',
        ],
        'wiltechsteam\FoundationService\Events\PositionUSDeletedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\PositionUSDeletedEventListener',
        ],
        'wiltechsteam\FoundationService\Events\PositionUSUpdatedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\PositionUSUpdatedEventListener',
        ],

        // US Unit
        'wiltechsteam\FoundationService\Events\UnitUSAddedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\UnitUSAddedEventListener',
        ],
        'wiltechsteam\FoundationService\Events\UnitUSUpdatedEvent' =>
        [
            'wiltechsteam\FoundationService\Listeners\UnitUSUpdatedEventListener',
        ],
    ]
];