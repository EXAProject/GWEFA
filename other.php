<?php

/*
 * MailWatch for MailScanner
 * Copyright (C) 2003-2011  Steve Freegard (steve@freegard.name)
 * Copyright (C) 2011  Garrod Alwood (garrod.alwood@lorodoes.com)
 * Copyright (C) 2014-2017  MailWatch Team (https://github.com/mailwatch/1.2.0/graphs/contributors)
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
 *
 * In addition, as a special exception, the copyright holder gives permission to link the code of this program with
 * those files in the PEAR library that are licensed under the PHP License (or with modified versions of those files
 * that use the same license as those files), and distribute linked combinations including the two.
 * You must obey the GNU General Public License in all respects for all of the code used other than those files in the
 * PEAR library that are licensed under the PHP License. If you modify this program, you may extend this exception to
 * your version of the program, but you are not obligated to do so.
 * If you do not wish to do so, delete this exception statement from your version.
 *
 * As a special exception, you have permission to link this program with the JpGraph library and distribute executables,
 * as long as you follow the requirements of the GNU GPL in regard to all of the software in the executable aside from
 * JpGraph.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write to the Free
 * Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

// Include of necessary functions
require_once __DIR__ . '/functions.php';

// Authentication checking
require __DIR__ . '/login.function.php';

html_start(__('toolslinks10'), '0', false, false);



echo '<table width="100%" class="boxtable">';
echo '<tr><th colspan="2">' . __('toolslinks03') . '</th></tr>';
echo '<tr>
<td>
         <p style ="font-size: 20px; font-weight: bold; color: #636262;">' . __('tools10') . '</p>

</td>
<td>
 <p style ="font-size: 20px; font-weight: bold; color: #636262;">Insights</p>

</td>
</tr>';
echo '<tr>
        <td>
      <ul class="tool_list">';

//echo '<li><a href="user_manager.php">' . __('usermgnt10') . '</a>';
if ($_SESSION['user_type'] === 'A') {
    $virusScanner = get_conf_var('VirusScanners');
    if (preg_match('/sophos/i', $virusScanner)) {
        echo '<li><a href="sophos_status.php">' . __('avsophosstatus10') . '</a>';
    }
    if (preg_match('/f-secure/i', $virusScanner)) {
        echo '<li><a href="f-secure_status.php">' . __('avfsecurestatus10') . '</a>';
    }
    if (preg_match('/clam/i', $virusScanner)) {
        echo '<li><a href="clamav_status.php">' . __('avclamavstatus10') . '</a>';
    }
    if (preg_match('/mcafee/i', $virusScanner)) {
        echo '<li><a href="mcafee_status.php">' . __('avmcafeestatus10') . '</a>';
    }
    if (preg_match('/f-prot/i', $virusScanner)) {
        echo '<li><a href="f-prot_status.php">' . __('avfprotstatus10') . '</a>';
    }

    echo '<li><a href="mysql_status.php">'.__('mysqldatabasestatus10').'</a>';
    echo '<li><a href="msconfig.php">' . __('viewconfms10') . '</a>';
    if (defined('MSRE') && MSRE === true) {
        echo '<li><a href="msre_index.php">' . __('editmsrules10') . '</a>';
    }
    if (!DISTRIBUTED_SETUP && get_conf_truefalse('UseSpamAssassin') === true) {
        echo '
     <li><a href="bayes_info.php">'.__('spamassassinbayesdatabaseinfo10').'</a>
     <li><a href="sa_lint.php">SpamAssassin Lint (Test)</a>
     <li><a href="ms_lint.php">MailScanner Lint (Test)</a>
     <li><a href="sa_rules_update.php">' . __('updatesadesc10') . '</a>';
    }
    if (!DISTRIBUTED_SETUP && get_conf_truefalse('MCPChecks') === true) {
        echo '<li><a href="mcp_rules_update.php">' . __('updatemcpdesc10') . '</a>';
    }
    echo '<li><a href="geoip_update.php">' . __('updategeoip10') . '</a>';
    /*Begin EFA*/
    echo '<li><a href="mailgraph.php">View Mailgraph Statistics</a>';
    $hostname = gethostname();
    echo '<li><a href="https://' . $hostname . ':10000">Webmin</a>';
    $efa_config = preg_grep('/^MUNINPWD/', file('/etc/EFA-Config'));
    foreach($efa_config as $num => $line) {
      if ($line) {
        $munin_pass = chop(preg_replace('/^MUNINPWD:(.*)/','$1', $line));
      }
    }
    echo '<li><a href="https://munin:' . $munin_pass . '@'  . $hostname . '/munin">View Munin Statistics</a>';
    /*End EFA*/
}
echo '</ul>';
////////////////////////// REMOVE LINKS /////////////////////////////
// if ($_SESSION['user_type'] === 'A') {
//     echo '
//    <p>' . __('links10') . '</p>
//    <ul>
//     <li><a href="http://mailwatch.org">MailWatch for MailScanner</a>
//     <li><a href="http://www.mailscanner.info">MailScanner</a>';

//     if (true === get_conf_truefalse('UseSpamAssassin')) {
//         echo '<li><a href="http://spamassassin.apache.org/">SpamAssassin</a>';
//     }

//     if (preg_match('/sophos/i', $virusScanner)) {
//         echo '<li><a href="http://www.sophos.com">Sophos</a>';
//     }

//     if (preg_match('/clam/i', $virusScanner)) {
//         echo '<li><a href="http://clamav.net">ClamAV</A>';
//     }

//     echo '
//     <li><a href="http://www.dnsstuff.com">DNSstuff</a>
//     <li><a href="http://mxtoolbox.com/NetworkTools.aspx">MXToolbox Network Tools</a>
//     <li><a href="http://www.anti-abuse.org/multi-rbl-check/">Multi-RBL Check</a>
//    </ul>';
// }

echo '
   </td>';
 echo '<td>';
 echo '<table width="100%">';
echo '<tr>';
/////// Add Service Status //////////
    if ($_SESSION['user_type'] === 'A' || $_SESSION['user_type'] === 'D') {
        echo '  <td align="left" valign="top">' . "\n";

        // Status table
        echo '   <table border="0" cellpadding="1" cellspacing="1" class="mail">' . "\n";
        // echo '    <tr><th colspan="3">' . __('status03') . '</th></tr>' . "\n";

        printServiceStatus();
        printAverageLoad();

        if ($_SESSION['user_type'] === 'A') {
            printMTAQueue();
            printFreeDiskSpace();
        }
        echo '  </table>' . "\n";
        echo '  </td>' . "\n";
    }
/////// END  Service Status //////////  
echo '</tr>';
echo '</table>';
echo '
   </td>
 </tr>
</table>';


// Add footer
html_end();
// Close any open db connections
dbclose();
