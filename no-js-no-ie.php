<?php 

// Add this to header.php, just below wp_head() //

if (!$_GET['no-js']) { ?>
    <noscript><meta http-equiv="refresh" content="0;url=/?no-js=1"></noscript>
<?php } ?>

<?php if (!$_GET['ie']) { ?>
<!--[if IE]>
    <meta http-equiv="refresh" content="0;url=/?ie=1">
<![endif]-->
<?php } ?>







<?php 

//Create no-js.php in the _includes folder & add the following code:

?>

<div class="no-js">
    <div class="box">
        <img class="pvl-logo pvl-logo-no-js" src="/wp-content/themes/sophiek2018/img/baclk.png" alt="Sophie Kinsella Logo"/>
        <h1>Please enable JavaScript</h1>
        <p>To enjoy the full functionality of Sophie Kinsella's website you need to enable JavaScript.<br/>Here are some simple <a href="https://www.enable-javascript.com" target="_blank"> instructions how to enable JavaScript in your web browser</a></p>
    </div>
</div>


<?php 

//Create browser-not-supported.php in the _includes folder & add the following code:

?>

<div class="no-js">
    <div class="box">
        <img class="pvl-logo pvl-logo-no-js" src="/wp-content/themes/sophiek2018/img/baclk.png" alt="Sophie Kinsella Logo"/>
        <h1>Improve your experience</h1>
        <p>You're using a web browser that we don't support.<br/><br/>Try <a href="https://www.google.com/chrome/browser/desktop" target="_blank">Google Chrome</a>, <a href="https://www.mozilla.org/en-GB/firefox/" target="_blank">Mozilla Firefox</a>, <a href="https://www.opera.com/download" target="_blank">Opera</a> or <a href="https://www.microsoft.com/en-gb/download/internet-explorer.aspx" target="_blank">Microsoft Internet Explorer 11</a> for a faster, safer and better experience using Sophie Kinsella's website.</p>
    </div>
</div>


<?php 

//Wrap everything in header.php after the body tag with:

if (!$_GET['no-js'] && !$_GET['ie']) {} ?>

?>


<?php 

//Wrap everything in your home page code with:


//If Javascript IS enabled...
if (!$_GET['no-js'] && !$_GET['ie']) {
    
    //Home Page content

} 

//If Javascript is NOT enabled...
elseif ($_GET['no-js']) { 

    include __DIR__ . '/_includes/no-js.php';
              
} 

//If Internet Explorer is detected...
elseif ($_GET['ie']) {
    
    include __DIR__ . '/_includes/browser-not-supported.php';
    
}  else { /* Nothing to do here */ }
?>