<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 15.09.2015
 * Time: 20:28
 */

namespace WTT\Enumerations;


abstract class WorkflowState
{
    const PlanningPhase = 0;
    const StartOrder = 1;
    const EquipmentInstallation = 2;
    const End = 3;
}