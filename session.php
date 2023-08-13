<?php
    session_start();

    $db = new mysqli('localhost', 'root', '', 'egcs');

    // student information
    if( isset($_SESSION['student']) )
    {
        $student = $db->query("SELECT * FROM students LEFT JOIN courses ON courseid=studCourse WHERE studentid='".$_SESSION['student']."'")->fetch_array();

        extract($student);

        $surname = $surname;
        $studentid = $studentid;
        $firstname = $othernames;
        $email = $studmail;
        
        $phone = $studPhone;
        $course = $courseName;
        $regnum = $regNumber;
        $idnum = $iDNumber;
        $join = $joinYear;
        $dateOfComp = $dateOfCompletion;
    }

    //Website settings
    $settings = $db->query("SELECT * FROM settings")->fetch_array();

    $sitename = $settings['name'];
    $sitelogo = $settings['logo'];
    $address = $settings['address'];
    $sitemail = $settings['email'];
    $sitephone = $settings['phone'];
    $sitefax = $settings['fax'];
    $smtp_mail = $settings['smtp_mail'];
    $smtp_host = $settings['smtp_host'];
    $smtp_user = $settings['smtp_user'];
    $smtp_port = $settings['smtp_port'];
    $smtp_pass = $settings['smtp_pass'];
    $footer_text = $settings['footer_text'];
    $facebook_link = $settings['facebook_link'];
    $twitter_link = $settings['twitter_link'];
    $google_plus_link = $settings['google_plus_link'];
    $whatsapp_link = $settings['whatsapp_link'];
    $linkedin_link = $settings['linkedin_link'];
    $instagram_link = $settings['instagram_link'];

    function filterPriv($str,$priv) 
    {
        $match = (preg_match( "/".$str."/",$priv)) ? 1 : 0;
        return $match;
    }
?>