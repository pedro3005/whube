			</div>
		</div>
		<div class = "foot" >
			Copyright (c) Whube Hackers, 2009 - <?php echo date("o"); ?><br />Peace and Love to Y'all.
				<div class = "clear" ></div>
		</div>
    <?php
    if ( isset ( $PIWIK ) && $PIWIK ) {
      $view_root = dirname(  __FILE__ ) . "/";
      include($view_root . "../libs/php/piwik.php");
      $piwik = piwikJS();
    ?>
    <script type="text/javascript">
    <?php
      print $piwik["script"];
    ?>
    </script>
    <noscript><p><img src="http://<?php echo $piwik["host"]; ?>/piwik.php?idsite=<?php echo $piwik["siteID"]; ?>" style="border:0" alt="" /></p></noscript>
    <?php
    }
    ?>
	</body>
</html>
