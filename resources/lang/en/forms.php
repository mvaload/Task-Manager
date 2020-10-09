<?php

return [
    'submits' => [
        'filter' => 'Apply',
        'update' => 'Update',
        'create' => 'Create'
    ],
    'placeholders' => [
        'base' => [
            'status_id' => 'Status',
            'name' => 'Name',
            'description' => 'Description',
        ],
        'task' => [
            'status_id' => 'Status',
            'assigned_to_id' => 'Assignee',
            'created_by_id' => 'Creator',
            'tags' => ''
        ],
    ],
    'labels' => [
        'base' => [
            'name' => 'Name',
            'description' => 'Description',
            'body' => 'Content',
        ],
        'task' => [
            'status_id' => 'Status',
            'assigned_to_id' => 'Assignee',
            'tags' => 'Tags'
        ],
        'taskFilter' => [
            'name' => 'Status'
        ]
    ],
];
