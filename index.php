<?php
include("bin/const.php");
 $connect = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
 ?>
 <!DOCTYPE html>
<html lang="en">
	<head>
		<title>SemiA</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/main.css" type="text/css" />
        <link rel="stylesheet" href="css/animate.css" type="text/css" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">


		<!--[if lt IE 9]>
		     <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
    <p Style="background-color: #FF9933; color:#000000; font-weight:bold; text-align: center;">BETA / Best viewed on Google Chrome</p>

    <header>


             <h1 class="main-title"><a href="https://semia.000webhostapp.com/">SemiA</a><span class="bouncingSpan">
                        <ul class="texts" style="display: none; color: #FF0066;">
                            <li>utomatic</li>
                        </ul></span><br/><span>A tool to help you link and analyze parts of speech</span></h1>

    <nav class="main-nav">
    <ul>
    <li class="input-holder" ><input class="text-input" name="input" placeholder="Start typing.."/></li>
    <li><a href="#" class="submit-btn" id="submit-btn">submit</a></li>
    </ul>

    </nav>

	</header>

    <section class="main-content">
        <div class="welcome-section">
        <div class="welcome-text">

        <h3 class="welcome-title">Welcome to SemiA</h3>



            <p class="welcome-msg">This is a tool to help you segment and explore hierarchies between the parts of speech of a given sentence or phrase. Your journey with <span style="font-weight: bold;">SemiA</span> begins when you see the demonstration video.
            <br/><br/><span style="font-weight: bold; color:red;">NEW! 14-1-17 </span>  <span style="font-weight: bold;">SemiA</span> visualizes your input in a tree.
            <br/><br/><br/><a href="file/SemiA.pdf">How to Use SemiA (pdf format)</a><br/><a href="file/SemiA.pptx">How to Use SemiA (ppt format)</a></p>

        </div>
        <iframe class="welcome-vid"
            src="https://www.youtube.com/embed/z9Jo9vi1MuE" >
        </iframe>

        </div>

        <div class="work-space">
            <h3>Please fill in the following grid and click process when you're ready</h3>
            <div id="loading"></div>
            <div class="retrieve">

            <table class="dtable">
            </table>
        </div>
            <div class="processbtnspace">
                    <select class="adv-process" name="adv" size="1">
                    <option value="0" selected="selected">Without Specific Tags</option>
                    <option value="1">With Specific Tags</option>
                    </select>
                      <a class="btn process" href="#" id="processBtn">Process</a>
            </div>
        </div>
        <div class="result-space">
            <h3>Result</h3>

            <h5 class="result-place">(ROOT ())</h5>
             <div class="tree"></div>

            <div id="loadingR"></div>







           <br/>
        </div>
    </section>
    <footer  class="footer-sec">
        <a class="regex" href="/RegEngine/">PHP RegEx Engine</a>
        <a class="porter" href="/PorterStemm/">Porter's Stemmer Algorithm</a>
        <a class="copyright" href="https://www.fb.com/mourhafkazzaz">mourhaf kazzaz 2016/2017</a>
    </footer>



	</body>
</html>




           <script src="js/jquery-1.10.2.js"></script>

        <script src="js/jquery.easing.min.js"></script>


    <script src="js/jquery.lettering.js"></script>

    <script src="js/jquery.textillate.js"></script>



   <script src="js/op.js"></script>
