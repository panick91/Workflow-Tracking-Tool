<?php

use WTT\Enumerations\WorkflowState;

return [

    'milestones' => [
        'MS02' => WorkflowState::PlanningPhase,
        'MS06' => WorkflowState::StartOrder,
        'MS07' => WorkflowState::EquipmentInstallation,
        'MS09' => WorkflowState::End
    ],

    'activityTypes' => [
        'ATTRIBUTE_MODIFIED',
        'DECISION',
        'ATTRIBUTE_REMOVED',
        'NOTICE',
        'REPORT'
    ],

    'requestTypes' => [
        'SIPVPN'
        , 'SID'
        , 'SBV'
        , 'IIPA'
    ]
];