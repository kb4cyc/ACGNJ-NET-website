<?php
	// require_once('check.php');
  // First, put all of the spam-content
  // that you want to check for into an
  // array (not individual variables!):
  //
	// JLR - Mon 26 May 2014
	// remove DEPRECATED 'ereg' replace with 'preg_match' below at 67ish

  $terms_array = array(
	'/chesoggioga.com/',
	'/feroadetade.com/',
	'/quellefoci.com/',
	'/pareadavanti.com/',
	'/moltoradi.com/',
	'/gentilpersona.com/',
	'/madrivolesti.com/',
	'/carifrutti.com/',
	'/oise.utoronto.ca/',
	'/miebrevi.com/',
	'/dimennobil.com/',
	'/lapietosa.com/',
	'/albattesmo.com/',
	'/email@example.com/',
	'/sdfxvf3@usa.net/',
  );

  // Then define the url of your thank-you
  // page--this should be the sam url you
  // use in the hidden 'redirect' field in
  // your form. We're going to redirect to
  // that page ***so that it looks like the
  // form submission was successful***
  // (just in case anyone is watching):
  //
	// $thank_you_page = 'http://domain.tld/thanks.html';
  $thank_you_page = 'http://www.acgnj.net/pfm/nty.html';
  // The contents of the message:
  //
  $incoming_message = $_POST['message'];

// JLR 10/2006
// In the attempt to find more information about some spammer who seems intent
//  on sending me and any other people on the list lots of jumk, I'm setting up an error log
// Setup for error_log file storage
$this_directory = getcwd(); // current directory
$log_name = '/check.log';
$log_file_name = $this_directory . $log_name;

  // Now, loop through each of the terms in
  // $terms_array and check the message
  // body for each term individually:
  //
  // Note: for forms that may contain long
  // messages, it may make sense to combine
  // all the terms in the array into one regular
  // expression (e.g. /lorem|ipsum|dolor|sit|amet/)
  // and run through the message body only ONCE.
  // I don't actually know which will be faster.
  //

  foreach ($terms_array as $forbidden_content) {
	
    // If we find something bad, we can IMMEDIATELY exit the script:

    // Warning This function "ereg" has been DEPRECATED as of PHP 5.3.0.
	// Relying on this feature is highly discouraged.
    // if(ereg($forbidden_content, $incoming_message)):
	if( preg_match ( $forbidden_content, $incoming_message )):
		echo "FC: $forbidden_content<br />\n";
		$dat = date('r T');
		error_log('[PFMCheck] Banned domain: $forbidden_content. ('
			. getenv('HTTP_REFERER') . ')' . "| $dat\n", 3, $log_file_name);
      header('location:' . $thank_you_page);
      exit;
    endif;
  }
?>
