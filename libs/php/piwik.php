<?php
  function piwikJS() {

    $js_root	= dirname(  __FILE__ ) . "/";

    include( $js_root . "../../conf/piwik.php" );
  
    $piwik["siteID"] = $piwik_site_id;
    $piwik["script"] = '
    var pkBaseURL = (("https:" == document.location.protocol) ? "https://' . $piwik_host . '/" : "http://' . $piwik_host . '/");
    document.write(unescape("%3Cscript src=\'" + pkBaseURL + "piwik.js\' type=\'text/javascript\'%3E%3C/script%3E"));

    try {
      var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 4);
      piwikTracker.trackPageView();
      piwikTracker.enableLinkTracking();
    } catch( err ) {}
    ';
    
    return $piwik;
  }
?>