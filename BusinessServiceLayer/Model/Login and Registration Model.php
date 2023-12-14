<?php

class loginRegistrationModel{

    //Function connect to database
    function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=ers', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

        //Login
        //Used for Login Validation for Admin
        function AdminAccountData(){
            $sql = "select * from admin";
            return loginRegistrationModel::connect()->query($sql);;
            }

        //Login
        //Used for Login Validation for Participant
        function ParticipantAccountData(){
            $sql = "select * from participant";
            return loginRegistrationModel::connect()->query($sql);;
            }

        //Login
        //Used for Login Validation for Organizer
        function EventOrganizerAccountData(){
            $sql = "select * from event_organizer";
            return loginRegistrationModel::connect()->query($sql);;
            }

        //Register
        //View All Participant Username
        function participantUsername(){
            $sql = "select * from participant";
            return loginRegistrationModel::connect()->query($sql);;
        }

        //Register
        //View All Event Organizer Username
        function organizerUsername(){
            $sql = "select * from event_organizer";
            return loginRegistrationModel::connect()->query($sql);;
        }
    
        //Register
        //Used for Participant Registration
        function registerParticipant(){
            $sql = "insert into participant (participant_name, participant_username, participant_password, participant_matric_id, 
            participant_phone_number, participant_address, participant_account_status, account_type, participant_profile_picture)
            values (:participant_name, :participant_username, :participant_password, :participant_matric_id, :participant_phone_number, 
            :participant_address, :participant_account_status, :account_type, :participant_profile_picture)";
            $args = [':participant_name'=>$this->participant_name,':participant_username'=>$this->participant_username,
            ':participant_password'=>$this->participant_password, ':participant_matric_id'=>$this->participant_matric_id,
            ':participant_phone_number'=>$this->participant_phone_number, ':participant_address'=>$this->participant_address,
            ':participant_account_status'=>$this->participant_account_status,':account_type'=>$this->account_type,
            ':participant_profile_picture'=>$this->participant_profile_picture];
            $stmt = loginRegistrationModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //Register
        //Used for Event Organizer Registration
        function registerEventOrganizer(){
            $sql = "insert into event_organizer (event_organizer_name, event_organizer_username, event_organizer_password,  
            event_organizer_phone_number, event_organizer_address, event_organizer_account_status, account_type, event_organizer_profile_picture)
            values (:event_organizer_name, :event_organizer_username, :event_organizer_password, :event_organizer_phone_number, 
            :event_organizer_address, :event_organizer_account_status, :account_type, :event_organizer_profile_picture)";
            $args = [':event_organizer_name'=>$this->event_organizer_name,':event_organizer_username'=>$this->event_organizer_username,
            ':event_organizer_password'=>$this->event_organizer_password, ':event_organizer_phone_number'=>$this->event_organizer_phone_number, 
            ':event_organizer_address'=>$this->event_organizer_address,':event_organizer_account_status'=>$this->event_organizer_account_status,
            ':account_type'=>$this->account_type,':event_organizer_profile_picture'=>$this->event_organizer_profile_picture];
            $stmt = loginRegistrationModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

    }
?>