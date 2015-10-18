<?php

use WTT\Enumerations\WorkflowState;

return [

    // Milestones, which are used for the overview of a order
    'milestones' => [
        'MS02' => WorkflowState::PlanningPhase,
        'MS06' => WorkflowState::StartOrder,
        'MS07' => WorkflowState::EquipmentInstallation,
        'MS09' => WorkflowState::End
    ],

    // Types of worklog activites, which are shown in the history of an order
    'activityTypes' => [
        'ATTRIBUTE_MODIFIED',
        'DECISION',
        'ATTRIBUTE_REMOVED',
        'NOTICE',
        'REPORT'
    ],

    // Request (Order) types, which are shown
    'requestTypes' => [
        'SIPVPN'
        , 'SID'
        , 'SBV'
        , 'IIPA'
    ],

    /*
     * List of milestones, which are considered for the calculation of the
     * progress report. The list is ordered from the last milestone to the first.
     * Each number shows the minimum of working days which need to be between the
     * completion dates of this milestone and it's predecessor.
     */
    'milestoneTimespans' => [
        'MS09'   => 0,
        'SRMS04' => 1,
        'MS08'   => 1,
        'MS07'   => 1,
        'SRMS03' => 0,
        'MS06'   => 0,
        'MS05'   => 1,
        'MS04'   => 2,
        'MS03'   => 1,
        'MS02'   => 4,
        'MS01'   => 2,
        'SRMS02' => 0,
    ]
];