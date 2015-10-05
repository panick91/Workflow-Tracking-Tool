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
        'MS08'   => 2,
        'MS07'   => 2,
        'SRMS03' => 0,
        'MS06'   => 3,
        'MS05'   => 4,
        'MS04'   => 2,
        'MS03'   => 0,
        'MS02'   => 20,
        'MS01'   => 1,
        'SRMS02' => 0,
    ]
];