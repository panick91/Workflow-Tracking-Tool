<?php
/**
 * Created by PhpStorm.
 * User: Patrick
 * Date: 15.09.2015
 * Time: 20:28
 */

namespace WTT\Enumerations;


use JsonSerializable;

class WorkflowState implements JsonSerializable
{
    const NoData = -1;
    const PlanningPhase = 0;
    const StartOrder = 1;
    const EquipmentInstallation = 2;
    const End = 3;

    public static function getCSV()
    {
        return WorkflowState::NoData . ','
        . WorkflowState::PlanningPhase . ','
        . WorkflowState::StartOrder . ','
        . WorkflowState::EquipmentInstallation . ','
        . WorkflowState::End;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        $states = array();
        array_push($states,['key'=>WorkflowState::PlanningPhase,'name'=>'Planning phase', 'longName'=>'Planning phase']);
        array_push($states,['key'=>WorkflowState::StartOrder,'name'=>'Start order','longName'=>'Start order']);
        array_push($states,['key'=>WorkflowState::EquipmentInstallation,'name'=>'Equipment inst.','longName'=>'Equipment installation']);
        array_push($states,['key'=>WorkflowState::End,'name'=>'End','longName'=>'End']);

        return $states;
    }
}