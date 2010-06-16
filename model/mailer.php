<?php
	session_start();
	
	require_once "Mail.php";

	class mailer {

		var $from;
		var $to;
		var $subject;
		var $body;
		var $reply_to;
		
		var $host;

		function mailer() {
			$this->from    = "Whube <whube-noreply@whube.com>";
			$this->reply_to = $this->from;
			$this->host    = "127.0.0.1";
			$this->subject = "Bug System Mail";
			
			if ( isset ( $_SESSION['email'] ) ) {
				$this->reply_to = $_SESSION['email'];
			}
			
		}
		function setTo( $addr ) {
			$this->to = $addr;
		}
		function setSubject( $subject ) {
			$this->subject = $subject;
		}
		function setBody( $body ) {
			$this->body = $body;
		}
		function send() {

			$to       = $this->to;
			$from     = $this->from;
			$subject  = $this->subject;
			$body     = $this->body;
			$host     = $this->host;
			$reply_to = $this->reply_to;

			$headers = array ('From' => $from,
				'To' => $to,
				'Subject' => $subject,
				'Reply-To' => $reply_to
				
				);
			$smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => false ));

			$mail = $smtp->send($to, $headers, $body);

			if (PEAR::isError($mail)) {
				$_SESSION['msg'] = "Emailer Failed to Send out Notification Mail! This is kinda an issue. I would file a bug for you, but this here is kinda the bug tracker.";
			}
		}
	}
?>
