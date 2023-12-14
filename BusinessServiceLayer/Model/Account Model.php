<?php

class accountModel{

    //Function connect to database
    function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=ers', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    //User Page
    //View All Participant List
    function viewAllParticipant(){
        $sql = "select * from participant";
        return accountModel::connect()->query($sql);;
    }

    //User Page
    //View All Event Organizer List
    function viewAllOrganizer(){
        $sql = "select * from event_organizer";
        return accountModel::connect()->query($sql);;
    }

    //Account Information Page
    //View selected participant information
    function viewSelectedParticipant(){
        $sql = "select * from participant where participant.participant_id = :participant_id";
        $args = [':participant_id'=>$this->participant_id];
        $stmt = accountModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //Account Information Page
    //View selected event organizer information
    function viewSelectedOrganizer(){
        $sql = "select * from event_organizer where event_organizer.event_organizer_id = :event_organizer_id";
        $args = [':event_organizer_id'=>$this->event_organizer_id];
        $stmt = accountModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //Account Information Page
    //Blacklist or Unblacklist Participant 
    function participantAccountStatus(){
        $sql = "update participant set participant_account_status=:participant_account_status
        where participant_id=:participant_id"; 
        $args = [':participant_id'=>$this->participant_id, ':participant_account_status'=>$this->participant_account_status];
        $stmt = accountModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //Account Information Page
    //Blacklist or Unblacklist Participant 
    function organizerAccountStatus(){
        $sql = "update event_organizer set event_organizer_account_status=:event_organizer_account_status
        where event_organizer_id=:event_organizer_id"; 
        $args = [':event_organizer_id'=>$this->event_organizer_id, ':event_organizer_account_status'=>$this->event_organizer_account_status];
        $stmt = accountModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    //Account Information Page
    //Update Participant Account Information
    function updateParticipantAccountData(){
        $sql = "update participant set participant_name=:participant_name, participant_username=:participant_username, participant_password=:participant_password, 
        participant_matric_id=:participant_matric_id, participant_phone_number=:participant_phone_number, participant_address=:participant_address 
        where participant_id=:participant_id"; 
        $args = [':participant_name'=>$this->participant_name, ':participant_username'=>$this->participant_username, ':participant_password'=>$this->participant_password, 
        ':participant_phone_number'=>$this->participant_phone_number, ':participant_matric_id'=>$this->participant_matric_id, 
        ':participant_address'=>$this->participant_address,':participant_id'=>$this->participant_id];
        $stmt = accountModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    } 

    //Account Information Page
    //Update Event Organizer Account Information
    function updateOrganizerAccountData(){
        $sql = "update event_organizer set event_organizer_name=:event_organizer_name, event_organizer_username=:event_organizer_username, 
        event_organizer_password=:event_organizer_password, event_organizer_phone_number=:event_organizer_phone_number, 
        event_organizer_address=:event_organizer_address where event_organizer_id=:event_organizer_id";
        $args = [':event_organizer_name'=>$this->event_organizer_name, ':event_organizer_username'=>$this->event_organizer_username, 
        ':event_organizer_password'=>$this->event_organizer_password, ':event_organizer_phone_number'=>$this->event_organizer_phone_number, 
        ':event_organizer_address'=>$this->event_organizer_address, ':event_organizer_id'=>$this->event_organizer_id];
        $stmt = accountModel::connect()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

}
?>
