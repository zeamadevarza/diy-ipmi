<!doctype html>
<head>
    <meta charset="utf-8">
    <title>diy-ipmi</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/solarized_dark.css">
    <script src="js/keypress-2.1.4.min.js"></script>
    <script src="js/monitor.js"></script>
	<script>
 	var servers = [];
 	//servers['Test Server'] = { name:'Test Server', tty:'/dev/ttyUSB0', vid:'/dev/video0', inp: 1, pin:2 }
 	//servers['Test Server 2'] = { name:'Test Server 2', tty:'/dev/ttyUSB1', vid:'/dev/video1', inp: 1, pin:3 }
<?php
	$configuration = parse_ini_file("/etc/ipmi.conf", true);
	$servers = array_keys($configuration);
	foreach ($servers as $server) {
		echo "servers['".$server."'] = { name:'".$server."', tty:'".$configuration[$server]['TTY']."', vid:'".$configuration[$server]['VID']."', inp: ".$configuration[$server]['INP'].", pin:".$configuration[$server]['PIN']." };";
	}
?>
    </script>
</head>
<body onload="startRefresh()">
    <div class="fixed_width_wrapper">
    <center>
       <div style="float: right">
             <br><br>
             <img onclick="resetServer()" src="images/power.png">
       </div>
       <img style="position: absolute; top: 30px; left: 156px" id="monitor" src="">
       <img style="position: relative; width: 480; height:720" src="images/monitor.png">
    </center>
    </div>
    <center>
         <select onchange="onSelectChange(this)" id="servers">
         </select>
     </center>
    <br>
    <div class="fixed_width_wrapper">
        <div class="keyboard">
            <section>
                <div class="row">
                    <div id="key_accent" class="key"><em>~</em><br><strong>`</strong></div>
                    <div id="key_one" class="key"><em>!</em><br><strong>1</strong></div>
                    <div id="key_two" class="key"><em>@</em><br><strong>2</strong></div>
                    <div id="key_three" class="key"><em>#</em><br><strong>3</strong></div>
                    <div id="key_four" class="key"><em>$</em><br><strong>4</strong></div>
                    <div id="key_five" class="key"><em>%</em><br><strong>5</strong></div>
                    <div id="key_six" class="key"><em>^</em><br><strong>6</strong></div>
                    <div id="key_seven" class="key"><em>&</em><br><strong>7</strong></div>
                    <div id="key_eight" class="key"><em>*</em><br><strong>8</strong></div>
                    <div id="key_nine" class="key"><em>(</em><br><strong>9</strong></div>
                    <div id="key_zero" class="key"><em>)</em><br><strong>0</strong></div>
                    <div id="key_hyphen" class="key"><em>_</em><br><strong>-</strong></div>
                    <div id="key_equals" class="key"><em>+</em><br><strong>=</strong></div>
                    <div id="key_backspace" class="key wide_2"><span class="right"><strong>backspace</strong></span></div>
                </div>
                <div class="row">
                    <div id="key_tab" class="key wide_2"><span class="left"><strong>tab</strong></span></div>
                    <div id="key_q" class="key single"><strong>Q</strong></div>
                    <div id="key_w" class="key single"><strong>W</strong></div>
                    <div id="key_e" class="key single"><strong>E</strong></div>
                    <div id="key_r" class="key single"><strong>R</strong></div>
                    <div id="key_t" class="key single"><strong>T</strong></div>
                    <div id="key_y" class="key single"><strong>Y</strong></div>
                    <div id="key_u" class="key single"><strong>U</strong></div>
                    <div id="key_i" class="key single"><strong>I</strong></div>
                    <div id="key_o" class="key single"><strong>O</strong></div>
                    <div id="key_p" class="key single"><strong>P</strong></div>
                    <div id="key_left_bracket" class="key"><em>{</em><br><strong>[</strong></div>
                    <div id="key_right_bracket" class="key"><em>}</em><br><strong>]</strong></div>
                    <div id="key_backslash" class="key"><em>|</em><br><strong>\</strong></div>
                </div>
                <div class="row">
                    <div id="key_caps_lock" class="key wide_3"><span class="left"><strong>caps lock</strong></span></div>
                    <div id="key_a" class="key single"><strong>A</strong></div>
                    <div id="key_s" class="key single"><strong>S</strong></div>
                    <div id="key_d" class="key single"><strong>D</strong></div>
                    <div id="key_f" class="key single"><strong>F</strong></div>
                    <div id="key_g" class="key single"><strong>G</strong></div>
                    <div id="key_h" class="key single"><strong>H</strong></div>
                    <div id="key_j" class="key single"><strong>J</strong></div>
                    <div id="key_k" class="key single"><strong>K</strong></div>
                    <div id="key_l" class="key single"><strong>L</strong></div>
                    <div id="key_semicolon" class="key"><em>:</em><br><strong>;</strong></div>
                    <div id="key_apostrophe" class="key"><em>"</em><br><strong>'</strong></div>
                    <div id="key_enter" class="key wide_3"><span class="right"><strong>enter</strong></span></div>
                </div>
                <div class="row">
                    <div id="key_left_shift" class="key wide_4"><span class="left"><strong>shift</strong></span></div>
                    <div id="key_z" class="key single"><strong>Z</strong></div>
                    <div id="key_x" class="key single"><strong>X</strong></div>
                    <div id="key_c" class="key single"><strong>C</strong></div>
                    <div id="key_v" class="key single"><strong>V</strong></div>
                    <div id="key_b" class="key single"><strong>B</strong></div>
                    <div id="key_n" class="key single"><strong>N</strong></div>
                    <div id="key_m" class="key single"><strong>M</strong></div>
                    <div id="key_comma" class="key"><em>&lt;</em><br><strong>,</strong></div>
                    <div id="key_period" class="key"><em>&gt;</em><br><strong>.</strong></div>
                    <div id="key_forwardslash" class="key"><em>?</em><br><strong>/</strong></div>
                    <div id="key_right_shift" class="key wide_4"><span class="right"><strong>shift</strong></span></div>
                </div>
                <div class="row">
                    <div id="key_left_ctrl" class="key wide_1"><span class="left"><strong>ctrl</strong></span></div>
                    <div id="key_left_alt" class="key wide_1"><span class="left"><strong>alt</strong></span></div>
                    <div id="key_left_cmd" class="key wide_1"><span class="left"><strong>cmd</strong></span></div>
                    <div id="key_space" class="key wide_5"></div>
                    <div id="key_right_cmd" class="key wide_1"><span class="right"><strong>cmd</strong></span></div>
                    <div id="key_right_alt" class="key wide_1"><span class="right"><strong>alt</strong></span></div>
                    <div id="key_right_ctrl" class="key wide_1"><span class="right"><strong>ctrl</strong></span></div>
                </div>
                <p class="message">
                    &nbsp;
                </p>
            </section>
            <section>
                <div class="row">
                    <div id="key_print" class="key"><span><strong>print</strong></span></div>
                    <div id="key_scroll_lock" class="key"><span><strong>scroll lock</strong></span></div>
                    <div id="key_pause_break" class="key"><span><strong>pause break</strong></span></div>
                </div>
                <div class="row">
                    <div id="key_insert" class="key"><span><strong>insert</strong></span></div>
                    <div id="key_home" class="key"><span><strong>home</strong></span></div>
                    <div id="key_page_up" class="key"><span><strong>page up</strong></span></div>
                </div>
                <div class="row">
                    <div id="key_delete" class="key"><span><strong>delete</strong></span></div>
                    <div id="key_end" class="key"><span><strong>end</strong></span></div>
                    <div id="key_page_down" class="key"><span><strong>page down</strong></span></div>
                </div>
                <div class="row">
                    <div class="key_filler"></div>
                    <div id="key_up" class="key"><div class="triangle up"></div></div>
                    <div class="key_filler"></div>
                </div>
                <div class="row">
                    <div id="key_left" class="key"><div class="triangle left"></div></div>
                    <div id="key_down"z class="key"><div class="triangle down"></div></div>
                    <div id="key_right" class="key"><div class="triangle right"></div></div>
                </div>
            </section>
            <section>
                <div class="row">
                    <div id="key_num_lock" class="key"><span><strong>num lock</strong></span></div>
                    <div id="key_divide" class="key single"><strong>/</strong></div>
                    <div id="key_multiply" class="key single"><strong>*</strong></div>
                    <div id="key_subtract" class="key single"><strong>-</strong></div>
                </div>
                <div class="row">
                    <div id="key_num_7" class="key"><strong>7</strong><span>home</span></div>
                    <div id="key_num_8" class="key"><strong>8</strong><br><div class="triangle up"></div></div>
                    <div id="key_num_9" class="key"><strong>9</strong><span>pgup</span></div>
                    <div id="key_add" class="key tall"><strong>+</strong></div>
                </div>
                <div class="row">
                    <div id="key_num_4" class="key"><strong>4</strong><br><div class="triangle left"></div></div>
                    <div id="key_num_5" class="key"><strong>5</strong></div>
                    <div id="key_num_6" class="key"><strong>6</strong><br><div class="triangle right"></div></div>
                </div>
                <div class="row">
                    <div id="key_num_1" class="key"><strong>1</strong><span>end</span></div>
                    <div id="key_num_2" class="key"><strong>2</strong><br><div class="triangle down"></div></div>
                    <div id="key_num_3" class="key"><strong>3</strong><span>pgdn</span></div>
                    <div id="key_num_enter" class="key tall"><span><strong>enter</strong></span></div>
                </div>
                <div class="row">
                    <div id="key_num_0" class="key wide_6"><strong>0</strong><span class="right">insert</span></div>
                    <div id="key_num_decimal" class="key"><strong>.</strong><br>del</div>
                </div>
                <p class="note">
                    Some browsers do not distinguish some or all of the numpad keys.
                </p>
            </section>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    
    <script src="js/main.js"></script>
    <script src="js/highlight.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
</body>
</html>
