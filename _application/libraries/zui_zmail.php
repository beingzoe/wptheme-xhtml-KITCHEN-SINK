<?php

### EMAIL FUNCTIONS ###

/**
 * Email class abstraction
 * Very simple emailer currently accepts (1) attachment
 * Currently using email classes by Manuel Lemos from PHPClasses.org
 * 
 * $to_address          =
 * $from_address        = also sets $reply_address, $error_delivery_address
 * $subject             = 
 * $text_message        = body message
 * $response_message    = message to display/flash on success; returns error message if problem
 * $file_to_attach      = OPTIONAL path to file
 *
 * Returns null string on success or error message (this seems wrong)
 * 
 * @uses clean_user_input($str) to protect from XSS attack (in functions.php_
 * TODO: 
 * html email, multiple file attachements, alt reply/error_delivery addresses, Return-Path
 * 
 */
function zmail($to_address, $from_address, $subject, $text_message, $response_message, $file_to_attach = NULL) 
{
    require TEMPLATEPATH . '/_application/classes/email_message.php'; //Email message class by Manuel Lemos from PHPClasses.org
    
    #Addresses
        //$from_address="";
        //$from_name="";
        $reply_address=clean_user_input($from_address);
        //$reply_name=$from_name;
        $error_delivery_address=clean_user_input($from_address);
        //$error_delivery_name=$from_name;
        //$to_name="Manuel Lemos";
        //$to_address="mlemos@acm.org";

    #Instantiate the email object
        $email_message=new email_message_class;
        $email_message->SetEncodedEmailHeader("To",clean_user_input($to_address),NULL); //,$to_name
        $email_message->SetEncodedEmailHeader("From",clean_user_input($from_address),NULL); //,$from_name
        $email_message->SetEncodedEmailHeader("Reply-To",clean_user_input($reply_address),NULL); //,$reply_name
        $email_message->SetHeader("Sender",clean_user_input($from_address));
    
    /*
     *  Set the Return-Path header to define the envelope sender address to which bounced messages are delivered.
     *  If you are using Windows, you need to use the smtp_message_class to set the return-path address.
     */
        if(defined("PHP_OS")
        && strcmp(substr(PHP_OS,0,3),"WIN"))
            //$email_message->SetHeader("Return-Path",$error_delivery_address);
    
    #SUBJECT, MESSAGE(s)
        $email_message->SetEncodedHeader("Subject",clean_user_input($subject));
        $email_message->AddQuotedPrintableTextPart($email_message->WrapText( clean_user_input($text_message) ));
        
    #SEND
        $error=$email_message->Send();
        if(strcmp($error,""))
            $response_message = "Error: $error\n";
            
    return $response_message;
}
if ( !function_exists('clean_user_input') ) {
    function clean_user_input($string) {
        return $string;
    }
}
?>
