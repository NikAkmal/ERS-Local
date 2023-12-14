<?php

require_once $_SERVER["DOCUMENT_ROOT"].'/Event Registration System/BusinessServiceLayer/Model/Event Model.php';

class eventController
{
    //View All Participant
    //Check first before deleting 
    function viewAllParticipant(){
        $viewAllParticipant = new eventModel();
        return $viewAllParticipant->viewAllParticipant();
    }

    //Participant Homepage
    //Used for viewing all event list for Participant
    function viewEventAvailable(){
        $viewEventAvailable = new eventModel();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date('Y-m-d');
        $viewEventAvailable->date = $date;
        return $viewEventAvailable->viewEventAvailable();
    }

    //Participant Homepage
    //Used for viewing selected event category for Participant
    function viewEventCategory($event_category){
        $viewEventCategory = new eventModel();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date('Y-m-d');
        $viewEventCategory->date = $date;
        $viewEventCategory->event_category = $event_category;
        return $viewEventCategory->viewEventCategory();
    }

    //History Page
    //Used for viewing all past event registration for participant (history)
    function viewAllHistory($participant_id){
        $viewAllHistory = new eventModel();
        $viewAllHistory->participant_id = $participant_id;
        return $viewAllHistory->viewAllHistory();
    }

    //History Page
    //Used for viewing selected event category for past event Participant (history)
    function viewSelectedHistory($participant_id, $event_category){
        $viewSelectedHistory = new eventModel();
        $viewSelectedHistory->participant_id = $participant_id;
        $viewSelectedHistory->event_category = $event_category;
        return $viewSelectedHistory->viewSelectedHistory();
    }

    //QR code scanner page
    //Check whether the participant has registered or not before scanning
    function viewEventRecord($event_id){
        $viewEventRecord = new eventModel();
        $viewEventRecord->event_id = $event_id;
        return $viewEventRecord->viewEventRecord();
    }

    //QR code scanner page
    //Register Participant Into The Registration Record
    function registerParticipant($event_id, $participant_id){
        $registerParticipant = new eventModel();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date('Y-m-d');
		$time = date('H:i:s A');
        $registerParticipant->event_id = $event_id;
        $registerParticipant->participant_id = $participant_id;
        $registerParticipant->time = $time;
        $registerParticipant->date = $date;
        if($registerParticipant->registerParticipant()){
            $message = "Event Registered Successfully!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = 'Participant Homepage.php';</script>";
        }
    } 

    //Admin Homepage
    //Used for viewing all event list for Admin
    function viewAllEvent(){
        $viewAllEvent = new eventModel();
        return $viewAllEvent->viewAllEvent();
    }

    //Admin Homepage
    //Used for viewing selected event category for Admin
    function viewEventCategoryAdmin($event_category){
        $viewEventCategoryAdmin = new eventModel();
        $viewEventCategoryAdmin->event_category = $event_category;
        return $viewEventCategoryAdmin->viewEventCategoryAdmin();
    }

    //Event Organizer Homepage
    //Report Page
    //Used for viewing all event list for Event Organizer
    function viewAllEventOrganizer($event_organizer_id){
        $viewAllEventOrganizer = new eventModel();
        $viewAllEventOrganizer->event_organizer_id = $event_organizer_id;
        return $viewAllEventOrganizer->viewAllEventOrganizer();
    }

    //Event Organizer Homepage
    //Used for viewing selected event category for Event Organizer
    function viewEventCategoryOrganizer($event_organizer_id, $event_category){
        $viewEventCategoryOrganizer = new eventModel();
        $viewEventCategoryOrganizer->event_organizer_id = $event_organizer_id;
        $viewEventCategoryOrganizer->event_category = $event_category;
        return $viewEventCategoryOrganizer->viewEventCategoryOrganizer();
    }

    //Information Page
    //Used for viewing selected event information
    function viewSelectedEvent($event_id){
        $viewSelectedEvent = new eventModel();
        $viewSelectedEvent->event_id = $_GET['event_id'];
        return $viewSelectedEvent->viewSelectedEvent();
    }

    //Information Page
    //Approve or Disapprove Event 
    function eventRequestStatus($event_id, $admin_id, $event_request_status){
        $eventRequestStatus = new eventModel();
        $eventRequestStatus->event_id = $_GET['event_id'];
        $eventRequestStatus->admin_id = $admin_id;
        $eventRequestStatus->event_request_status = $event_request_status;
        if($eventRequestStatus->eventRequestStatus()){
            $message = "Event Request Status Updated Successfully!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = 'Admin Homepage.php';</script>";
        }
    }

    //Information Page
    //Update Event Detail
    function updateEventDetail($event_id){
        $updateEventDetail = new eventModel();
        $updateEventDetail->event_id= $_GET['event_id'];
        $updateEventDetail->event_name= $_POST['event_name'];
        $updateEventDetail->event_venue= $_POST['event_venue'];
        $updateEventDetail->event_start_date= $_POST['event_start_date'];
        $updateEventDetail->event_end_date= $_POST['event_end_date'];
        $updateEventDetail->event_begin_time= $_POST['event_begin_time'];
        $updateEventDetail->event_end_time= $_POST['event_end_time'];
        $updateEventDetail->event_detail= $_POST['event_detail'];
        $updateEventDetail->event_category= $_POST['event_category'];
        if($updateEventDetail->updateEventDetail()){
            $message = "Event Detail Updated Successfully!";
            echo "<script type='text/javascript'>alert('$message');
            window.location = 'Event Organizer Homepage.php';</script>";
        }
    }

    //QR Code Generator
    //Update Event QR code
    function updateQRCODE($event_id, $event_qr_code){
        $updateQRCODE = new eventModel();
        $updateQRCODE->event_id= $event_id;
        $updateQRCODE->event_qr_code= $event_qr_code;
        if($updateQRCODE->updateQRCODE()){
            $message = "Save Successfully!";
        echo "<script type='text/javascript'>alert('$message');
        </script>";
        }
    }
    
    //Report Page
    //Event Organizer Report
    //Participated List
    function participatedReport($event_id){
        $participatedReport = new eventModel();
        $participatedReport->event_id= $event_id;
        return $participatedReport->participatedReport();
    }

    //Report Page
    //Event Organizer Report
    //Report Title Display for Bar Chart
    function participatedReportTitle($event_id){
        $participatedReportTitle = new eventModel();
        $participatedReportTitle->event_id= $event_id;
        return $participatedReportTitle->participatedReportTitle();
    }

    //Report Page
    //Event Organizer Report
    //Report Total Participant Registered Display for Bar Chart
    function totalParticipated($event_id){
        $totalParticipated = new eventModel();
        $totalParticipated->event_id= $event_id;
        return $totalParticipated->totalParticipated();
    }

    //Report Page
    //Admin Report
    //Total Admin in the system
    function totalAdmin(){
        $totalAdmin = new eventModel();
        return $totalAdmin->totalAdmin();
    }

    //Report Page
    //Admin Report
    //Total Event Organizer in the system
    function totalOrganizer(){
        $totalOrganizer = new eventModel();
        return $totalOrganizer->totalOrganizer();
    }

    //Report Page
    //Admin Report
    //Total Participant in the system
    function totalParticipant(){
        $totalParticipant = new eventModel();
        return $totalParticipant->totalParticipant();
    }

    //Report Page
    //Admin Report
    //Total Completed Event in the system
    function totalCompletedEvent(){
        $totalCompletedEvent = new eventModel();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date('Y-m-d');
        $totalCompletedEvent->date = $date;
        return $totalCompletedEvent->totalCompletedEvent();
    }

    //Report Page
    //Admin Report
    //Total Today Event in the system
    function totalTodayEvent(){
        $totalTodayEvent = new eventModel();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date('Y-m-d');
        $totalTodayEvent->date = $date;
        return $totalTodayEvent->totalTodayEvent();
    }

    //Report Page
    //Admin Report
    //Total Upcoming Event in the system
    function totalUpcomingEvent(){
        $totalUpcomingEvent = new eventModel();
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date('Y-m-d');
        $totalUpcomingEvent->date = $date;
        return $totalUpcomingEvent->totalUpcomingEvent();
    }

    //Create Event Page
    //Used for creating event
    function createEvent($event_organizer_id, $event_poster, $event_brochure){
        $create = new eventModel();
        $create->admin_id= "0";
        $create->event_organizer_id= $event_organizer_id;
        $create->event_name= $_POST['event_name'];
        $create->event_venue= $_POST['event_venue'];
        $create->event_start_date= $_POST['event_start_date'];
        $create->event_end_date= $_POST['event_end_date'];
        $create->event_begin_time= $_POST['event_begin_time'];
        $create->event_end_time= $_POST['event_end_time'];
        $create->event_detail= $_POST['event_detail'];
        $create->event_poster= $event_poster;
        $create->event_brochure= $event_brochure;
        $create->event_request_status= "Pending";
        $create->event_category= $_POST['event_category'];
        $create->event_qr_code= "0";
        if($create->createEvent()){
            $message = "Create Event Successfully. Please wait for admin approval.";
        echo "<script type='text/javascript'>alert('$message');
        window.location = 'Event Organizer Homepage.php';</script>";
        }
    }
}
?>














