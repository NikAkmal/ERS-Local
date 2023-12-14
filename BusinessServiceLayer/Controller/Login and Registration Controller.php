<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/Event Registration System/BusinessServiceLayer/Model/Login and Registration Model.php';

class loginRegistrationController
{
    //Login
    //Used for Login Validation for Admin
    function AdminAccountData(){
        $AdminAccountData = new loginRegistrationModel();
        return $AdminAccountData->AdminAccountData();
    }

    //Login
    //Used for Login Validation for Participant
    function ParticipantAccountData(){
        $ParticipantAccountData = new loginRegistrationModel();
        return $ParticipantAccountData->ParticipantAccountData();
    }

    //Login
    //Used for Login Validation for Organizer
    function EventOrganizerAccountData(){
        $EventOrganizerAccountData = new loginRegistrationModel();
        return $EventOrganizerAccountData->EventOrganizerAccountData();
    }

    //Register
    //View All Participant Username
    function participantUsername(){
        $participantUsername = new loginRegistrationModel();
        return $participantUsername->participantUsername();
    }

   //Register
    //View All Event Organizer Username
    function organizerUsername(){
        $organizerUsername = new loginRegistrationModel();
        return $organizerUsername->organizerUsername();
    }

    //Register
    //Used for Participant Registration
    function registerParticipant($profile_picture){
        $register = new loginRegistrationModel();
        $register->participant_name	= $_POST['name'];
        $register->participant_username = $_POST['username'];
        $register->participant_password = $_POST['password'];
        $register->participant_matric_id = $_POST['matric_id'];
        $register->participant_phone_number = $_POST['phone_number'];
        $register->participant_address = $_POST['address'];
        $register->participant_account_status = "Unblacklisted";
        $register->account_type = $_POST['account_type'];
        $register->participant_profile_picture = $profile_picture;
        if($register->registerParticipant()){
            $message = "Registered Successfully. Please Login.";
            echo "<script type='text/javascript'>alert('$message');
            window.location = 'Login.php';</script>";
        }
    }

    //Register
    //Used for Event Organizer Registration
    function registerEventOrganizer($profile_picture){
        $register = new loginRegistrationModel();
        $register->event_organizer_name	= $_POST['name'];
        $register->event_organizer_username = $_POST['username'];
        $register->event_organizer_password = $_POST['password'];
        $register->event_organizer_phone_number = $_POST['phone_number'];
        $register->event_organizer_address = $_POST['address'];
        $register->event_organizer_account_status = "Unblacklisted";
        $register->account_type = $_POST['account_type'];
        $register->event_organizer_profile_picture = $profile_picture;
        if($register->registerEventOrganizer()){
            $message = "Registered Successfully. Please Login.";
            echo "<script type='text/javascript'>alert('$message');
            window.location = 'Login.php';</script>";
        }
    }

}
?>