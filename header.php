<!--
Smart Chat
Authors:
    Rishi Dua <https://github.com/rishirdua>
    Harvineet Singh <https://github.com/harvineet>
File description: Header with links
This projected is licensed under the terms of the MIT license. See LICENCE.txt for details
-->
<header>
    	<div class="row-top">
        	<div class="main">
                <div class="wrapper">
                    <h1><a class="logo" href="index.php">Smart Chat</a></h1>
                    <nav>
                        <ul class="menu">
                        <?php
                        include "config.php";
                        
                        if (empty($_GET)) {
                            echo "<li><a href=\"index.php\">Login</a></li>";
                        }
                        else {
                            if (empty($_GET['alert'])) {
                                echo "<li><a href=\"logout.php?" . $_SERVER['QUERY_STRING'] . "\">Logout</a></li>";   
                            }
                            else {
                                echo "<li><a href=\"index.php\">Login</a></li>";   
                            }
                        }
                        
                        ?>
                            
                            <li><a href="about.php">About</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        
    </header>