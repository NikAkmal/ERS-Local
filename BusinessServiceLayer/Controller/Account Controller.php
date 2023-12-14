<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/Event Registration System/BusinessServiceLayer/Model/Account Model.php';

class accountController
{   
    //User Page
    //View All Participant List
    function viewAllParticipant(){
        $viewAllParticipant = new accountModel();
        return $viewAllParticipant->viewAllParticipant();
    }

    //User Page
    //View All Event Organizer List
    function viewAllOrganizer(){
        $viewAllOrganizer = new accountModel();
        return $viewAllOrganizer->viewAllOrganizer();
    }

    //Account Information Page
    //View selected participant information
    function viewSelectedParticipant($participant_id){
        $viewSelectedParticipant = new accountModel();
        $viewSelectedParticipant->participant_id = $participant_id;
        return $viewSelectedParticipant->viewSelectedParticipant();
    }

    //Account Information Page
    //View selected event organizer information
    function viewSelectedOrganizer($event_organizer_id){
        $viewSelectedOrganizer = new accountModel();
        $viewSelectedOrganizer->event_organizer_id = $event_organizer_id;
        return $viewSelectedOrganizer->viewSelectedOrganizer();
    }

    //Account Information Page
    //Blacklist or Unblacklist Participant 
    function participantAccountStatus($participant_id, $participant_account_status){
        $participantAccountStatus = new accountModel();
        $participantAccountStatus->participant_id = $participant_id;
        $participantAccountStatus->participant_account_status = $participant_account_status;
        if($participantAccountStatus->participantAccountStatus()){
            $message = "Account Status Updated Successfully!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = 'User Page.php';</script>";
        }
    }

    //Account Information Page
    //Blacklist or Unblacklist Participant 
    function organizerAccountStatus($event_organizer_id, $event_organizer_account_status){
        $organizerAccountStatus = new accountModel();
        $organizerAccountStatus->event_organizer_id = $event_organizer_id;
        $organizerAccountStatus->event_organizer_account_status = $event_organizer_account_status;
        if($organizerAccountStatus->organizerAccountStatus()){
            $message = "Account Status Updated Successfully!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = 'User Page.php';</script>";
        }
    }

    //Account Information Page
    //Update Participant Account Information
    function updateParticipantAccountData($participant_id){
        $updateParticipantAccountData = new accountModel();
        $updateParticipantAccountData->participant_id = $participant_id;
        $updateParticipantAccountData->participant_name= $_POST['participant_name'];
        $updateParticipantAccountData->participant_username= $_POST['participant_username'];
        $updateParticipantAccountData->participant_password= $_POST['participant_password'];
        $updateParticipantAccountData->participant_phone_number= $_POST['participant_phone_number'];
        $updateParticipantAccountData->participant_matric_id= $_POST['participant_matric_id'];
        $updateParticipantAccountData->participant_address= $_POST['participant_address'];
        if($updateParticipantAccountData->updateParticipantAccountData()){
            $message = "Account Information Updated Successfully!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = 'Account Information Page.php';</script>";
        }
    }

    //Account Information Page
    //Update Event Organizer Account Information
    function updateOrganizerAccountData($event_organizer_id){
        $updateOrganizerAccountData = new accountModel();
        $updateOrganizerAccountData->event_organizer_id = $event_organizer_id;
        $updateOrganizerAccountData->event_organizer_name= $_POST['event_organizer_name'];
        $updateOrganizerAccountData->event_organizer_username= $_POST['event_organizer_username'];
        $updateOrganizerAccountData->event_organizer_password= $_POST['event_organizer_password'];
        $updateOrganizerAccountData->event_organizer_phone_number= $_POST['event_organizer_phone_number'];
        $updateOrganizerAccountData->event_organizer_address= $_POST['event_organizer_address'];
        if($updateOrganizerAccountData->updateOrganizerAccountData()){
            $message = "Account Information Updated Successfully!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = 'Account Information Page.php';</script>";
        }
    }
}
?>














