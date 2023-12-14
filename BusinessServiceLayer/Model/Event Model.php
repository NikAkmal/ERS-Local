<?php

class eventModel{

    //Function connect to database
    function connect()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=ers', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

        //View All Participant
        //Check first before deleting  
        function viewAllParticipant(){
            $sql = "select * from participant";
            return eventModel::connect()->query($sql);;
        }

        //Participant Homepage
        //Used for viewing all event list for Participant
        function viewEventAvailable(){
            $sql = "select * from event where event_request_status = 'APPROVE' and :date <= event_end_date order by event_start_date";
            $args = [':date'=>$this->date];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //Participant Homepage
        //Used for viewing selected event category for Participant
        function viewEventCategory(){
            $sql = "select * from event where event.event_request_status = 'APPROVE' and event.event_category = :event_category 
            and :date <= event_end_date order by event_start_date";
            $args = [':event_category'=>$this->event_category,':date'=>$this->date];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //History Page
        //Used for viewing all past event registration for participant (history)
        function viewAllHistory(){
            $sql = "select * from event inner join registration_record ON event.event_id = registration_record.event_id 
            where registration_record.participant_id = :participant_id";
            $args = [':participant_id'=>$this->participant_id];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //History Page
        //Used for viewing selected event category for past event Participant (history)
        function viewSelectedHistory(){
            $sql = "select * from event inner join registration_record ON event.event_id = registration_record.event_id 
            where registration_record.participant_id = :participant_id and event.event_category = :event_category";
            $args = [':participant_id'=>$this->participant_id, ':event_category'=>$this->event_category];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //QR code scanner page
        //Check whether the participant has registered or not before scanning
        function viewEventRecord(){
            $sql = "select * from registration_record where registration_record.event_id = :event_id";
            $args = [':event_id'=>$this->event_id];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //QR code scanner page
        //Register Participant Into The Registration Record
        function registerParticipant(){
            $sql = "insert into registration_record (event_id, participant_id, registration_time, registration_date) 
            values (:event_id, :participant_id, :time, :date)";
            $args = [':event_id'=>$this->event_id, ':participant_id'=>$this->participant_id, 
            ':time'=>$this->time,':date'=>$this->date];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        } 

        //Admin Homepage
        //Used for viewing all event list for Admin
        function viewAllEvent(){
            $sql = "select * from event order by event_start_date desc";
            return eventModel::connect()->query($sql);;
        }

        //Admin Homepage
        //Used for viewing selected event category for Admin
        function viewEventCategoryAdmin(){
            $sql = "select * from event where event_category = :event_category order by event_start_date desc";
            $args = [':event_category'=>$this->event_category];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //Event Organizer Homepage
        //Report Page
        //Used for viewing all event list for Event Organizer
        function viewAllEventOrganizer(){
            $sql = "select * from event where event_organizer_id = :event_organizer_id order by event_start_date desc";
            $args = [':event_organizer_id'=>$this->event_organizer_id];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //Event Organizer Homepage
        //Used for viewing selected event category for Event Organizer
        function viewEventCategoryOrganizer(){
            $sql = "select * from event where event_organizer_id = :event_organizer_id and
            event_category = :event_category order by event_start_date desc";
            $args = [':event_organizer_id'=>$this->event_organizer_id, ':event_category'=>$this->event_category];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //Information Page
        //Used for viewing selected event information for Participant, Admin and Event Organizer
        function viewSelectedEvent(){
            $sql = "select * from event where event.event_id = :event_id";
            $args = [':event_id'=>$this->event_id];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }
        
        //Information Page
        //Update Event Request Status
        function eventRequestStatus(){
            $sql = "update event set admin_id=:admin_id, event_request_status=:event_request_status where event_id=:event_id"; 
            $args = [':admin_id'=>$this->admin_id, ':event_request_status'=>$this->event_request_status, ':event_id'=>$this->event_id];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        } 

        //Information Page
        //Update Event Detail
        function updateEventDetail(){
            $sql = "update event set event_name=:event_name, event_venue=:event_venue, event_start_date=:event_start_date, event_end_date=:event_end_date,
            event_begin_time=:event_begin_time, event_end_time=:event_end_time, event_detail=:event_detail, event_category=:event_category 
            where event_id=:event_id"; 
            $args = [':event_name'=>$this->event_name, ':event_venue'=>$this->event_venue, ':event_start_date'=>$this->event_start_date, 
            ':event_end_date'=>$this->event_end_date, ':event_begin_time'=>$this->event_begin_time, ':event_end_time'=>$this->event_end_time, 
            ':event_detail'=>$this->event_detail, ':event_category'=>$this->event_category,':event_id'=>$this->event_id];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        } 

        //QR Code Generator
        //Update Event QR code
        function updateQRCODE(){
            $sql = "update event set event_qr_code=:event_qr_code where event_id=:event_id"; 
            $args = [':event_qr_code'=>$this->event_qr_code, ':event_id'=>$this->event_id];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //Report Page
        //Event Organizer Report
        //Participated List
        function participatedReport(){
            $sql = "select * from registration_record  inner join participant 
            ON participant.participant_id = registration_record.participant_id 
            where registration_record.event_id = :event_id";
            $args = [':event_id'=>$this->event_id];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //Report Page
        //Event Organizer Report
        //Report Title Display for Bar Chart
        function participatedReportTitle(){
            $sql = "select * from event
            where event.event_id = :event_id";
            $args = [':event_id'=>$this->event_id];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //Report Page
        //Event Organizer Report
        //Report Total Participant Registered Display for Bar Chart
        function totalParticipated(){
            $sql = "select count(event_id) as total_participated
            from registration_record 
            where registration_record.event_id = :event_id";
            $args = [':event_id'=>$this->event_id];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //Report Page
        //Admin Report
        //Total Admin in the system
        function totalAdmin(){
            $sql = "select count(admin_id) as total_admin
            from admin";
            return eventModel::connect()->query($sql);;
        }

        //Report Page
        //Admin Report
        //Total Event Organizer in the system
        function totalOrganizer(){
            $sql = "select count(event_organizer_id) as total_organizer
            from event_organizer";
            return eventModel::connect()->query($sql);;
        }

        //Report Page
        //Admin Report
        //Total Participant in the system
        function totalParticipant(){
            $sql = "select count(participant_id) as total_participant
            from participant";
            return eventModel::connect()->query($sql);;
        }

        //Report Page
        //Admin Report
        //Total Completed Event in the system
        function totalCompletedEvent(){
            $sql = "select count(event_id) as total_completed_event
            from event where event_request_status = 'APPROVE' and :date > event_end_date";
            $args = [':date'=>$this->date];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //Report Page
        //Admin Report
        //Total Today Event in the system
        function totalTodayEvent(){
            $sql = "select count(event_id) as total_today_event
            from event where event_request_status = 'APPROVE' and :date <= event_end_date and :date >= event_start_date";
            $args = [':date'=>$this->date];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //Report Page
        //Admin Report
        //Total Upcoming Event in the system
        function totalUpcomingEvent(){
            $sql = "select count(event_id) as total_upcoming_event
            from event where event_request_status = 'APPROVE' and :date < event_start_date";
            $args = [':date'=>$this->date];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        //Create Event Page
        //Used for creating event
        function createEvent(){
            $sql = "insert into event (admin_id, event_organizer_id, event_name, event_venue, event_start_date, event_end_date, event_begin_time, 
            event_end_time, event_detail, event_poster, event_brochure, event_request_status, event_category, event_qr_code)
            values (:admin_id, :event_organizer_id, :event_name, :event_venue, :event_start_date, :event_end_date, :event_begin_time, :event_end_time, 
            :event_detail, :event_poster, :event_brochure, :event_request_status, :event_category, :event_qr_code)";

            $args = [':admin_id'=>$this->admin_id,':event_organizer_id'=>$this->event_organizer_id,
            ':event_name'=>$this->event_name, ':event_venue'=>$this->event_venue,
            ':event_start_date'=>$this->event_start_date, ':event_end_date'=>$this->event_end_date,
            ':event_begin_time'=>$this->event_begin_time,':event_end_time'=>$this->event_end_time,
            ':event_detail'=>$this->event_detail, ':event_poster'=>$this->event_poster,
            ':event_brochure'=>$this->event_brochure,':event_request_status'=>$this->event_request_status,
            ':event_category'=>$this->event_category, ':event_qr_code'=>$this->event_qr_code];
            $stmt = eventModel::connect()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }
    }
?>
