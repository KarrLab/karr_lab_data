<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

      	<meta name="description" content="The Karr Lab is a computational systems biology research lab at the Icahn School of Medicine at Mount Sinai." />
      	<meta name="keywords" content="Jonathan Karr, systems biology, translational medicine, whole-cell, modeling" />
      	<meta name="author" content="Jonathan Karr" />
      	<meta name="revised" content="Jonathan Karr, 03/03/2018" />
      	<meta name="copyright" content="&copy; 2013-2018 Karr Lab" />
      	<meta name="robots" content="ALL" />
      	<meta http-equiv="content-language" content="en-US" />
      	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>Karr Lab</title>
        <link rel="stylesheet" href="http://www.karrlab.org/static/css/foundation.css" />
        <link rel="stylesheet" href="http://www.karrlab.org/static/css/foundation-icons.css" />
        <link rel="stylesheet" href="http://www.karrlab.org/static/css/extras.css" />
        <script src="http://www.karrlab.org/static/js/vendor/modernizr.js"></script>

        <link rel="icon" type="image/x-icon" href="http://www.karrlab.org/static/img/logo-mssm-16x16.ico" />

        <style>
            #data{
                width: 100%;
            }
            #data th {
                background: #999;
            }
            #data th,
            #data td {
                padding-left: 2px;
                padding-right: 2px;
                padding-top: 4px;
                padding-bottom: 4px;
            }
            #data th.version, #data td.version {
                width: 8%;
            }
            #data th.date, #data td.date {
                width: 16%;
            }
        </style>
    </head>
    <body>
        <div class="off-canvas-wrap" data-offcanvas>
            <div class="inner-wrap">
                <nav class="tab-bar hide-for-medium-up">
                   <section class="left-small">
                        <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
                    </section>

                    <section class="right tab-bar-section">
                        <h1 class="title">Karr Systems Biology Lab</h1>
                    </section>
                </nav>

                <aside class="left-off-canvas-menu">
                    <ul class="off-canvas-list">
                        <li><label>Karr Systems Biology Lab</label></li>
                        <li><a href="http://www.karrlab.org/">Home</a></li>
                        <li><a href="http://www.karrlab.org/research">Research</a></li>
                        <li><a href="http://www.karrlab.org/resources">Resources</a></li>
                        <li><a href="http://www.karrlab.org/publications">Publications</a></li>
                        <li><a href="http://www.karrlab.org/press">Press</a></li>
                        <li><a href="http://www.karrlab.org/funding">Funding</a></li>
                        <li><a href="http://www.karrlab.org/people">People</a></li>
                        <li><a href="http://www.karrlab.org/join">Join us</a></li>
                        <li><a href="http://www.karrlab.org/contact">Contact</a></li>
                    </ul>
                </aside>

                <section class="main-section">
                <!-- canvas wrapping -->

                    <!-- top bar -->
                    <div class="top-bar row show-for-medium-up">
                        <div class="small-12 columns">
                            <dl class="sub-nav">
                                <dd><a href="http://www.karrlab.org/">Home</a></dd>
                                <dd><a href="http://www.karrlab.org/research">Research</a></dd>
                                <dd class="active"><a href="http://www.karrlab.org/resources">Resources</a></dd>
                                <dd><a href="http://www.karrlab.org/publications">Publications</a></dd>
                                <dd><a href="http://www.karrlab.org/press">Press</a></dd>
                                <dd><a href="http://www.karrlab.org/funding">Funding</a></dd>
                                <dd><a href="http://www.karrlab.org/people">People</a></dd>
                                <dd><a href="http://www.karrlab.org/join">Join us</a></dd>
                                <dd><a href="http://www.karrlab.org/contact">Contact</a></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="top-bar-bg show-for-medium-up">
                    </div>

                    <!-- content -->
                    <div class="row content">
                        <div class="centered">
                        <!-- end common header -->
                            <h3>Data</h3>

                            <table cellpadding=0 cellspacing=0 id="data">                                
<?php

if ($_GET['token'] && $_GET['token'] == file_get_contents('token')) {
    $show_private = true;
} else {
    $show_private = false;
}
?>

                                <thead>
                                    <tr>
                                        <th>File</th>
                                        <th class="version">Version</th>
                                        <th class="date">Created</th>
                                        <th class="date">Updated</th>
                                    </tr>
                                </thead>
                                <tbody>

<?php

function list_files($show_private, $dir, $access){
    foreach (scandir($dir) as $file) {
        if ($file != '.' && $file != '..' && is_dir("$dir/$file")) {
            $version = count(scandir("$dir/$file")) - 3;
            $created = date('Y-m-d H:i:s', filemtime("$dir/$file/0"));
            $updated = date('Y-m-d H:i:s', filemtime("$dir/$file/$version"));
                        
            if ($show_private) {
                $url = "download.php?file=$file&version=$version&dir=$dir&token=$token";
            } else {
                $url = "download.php?file=$file&version=$version";
            }
            echo "<tr>";
            if ($show_private) {
                echo "<td><a href='$url'>$dir/$file</a></td>"; 
            } else {
                echo "<td><a href='$url'>$file</a></td>"; 
            }
            echo "<td class='version'><a href='$url'>$version</a></td>";
            echo "<td class='date'>$created</td>";
            echo "<td class='date'>$updated</td>";
            echo "</tr>";
        }
    }
}

list_files($show_private, 'public', 'Public');
if ($show_private) {
    list_files($show_private, 'private', 'Private');
}

?>
                                </tbody>
                            </table>

                        <!-- common footer -->
                        </div>
                    </div>

                    <!-- bottom bar -->
                    <div class="row bottom-bar">
                        <div class="logo">
                            <a href="http://www.mssm.edu"><img src="http://www.karrlab.org/static/img/logo-mssm-32x32.png" /></a>
                        </div>

                        <div class="text-left">
                            <a href="http://icahn.mssm.edu/departments-and-institutes/genomics">Icahn Institute for Genomics &amp; Multiscale Biology</a><br/>
                            <a href="http://icahn.mssm.edu/departments-and-institutes/genomics">Department of Genetics &amp; Genomic Sciences</a><br/>
                            <a href="http://www.mssm.edu">Icahn School of Medicine at Mount Sinai</a>
                        </div>

                        <div class="text-right show-for-medium-up">
                            &copy; Karr Lab 2018
                        </div>

                        <div class="clear"></div>
                    </div>

                <!-- canvas wrapping -->
                </section>
                <a class="exit-off-canvas"></a>
            </div>
        </div>

        <script src="http://www.karrlab.org/static/js/vendor/jquery.js"></script>
        <script src="http://www.karrlab.org/static/js/foundation.min.js"></script>
        <script>
        $(document).foundation();
        </script>
    </body>
</html>