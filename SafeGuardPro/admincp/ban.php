<?php
/*======================================================================*\
|| #################################################################### ||
|| #                This file is part of SafeGuard Pro                # ||
|| # ---------------------------------------------------------------- # ||
|| #     Copyright © 2014 - 2015 Gewora.net. All Rights Reserved.     # ||
|| # This file may not be redistributed in whole or significant part  # ||
|| #                                                                  # ||
|| #            For more license information contact Gewora           # ||
|| #            and/or read the envato license details at:            # ||
|| #                  http://codecanyon.net/licenses                  # ||
|| # You are NOT allowed to modify/remove this copyright information  # ||
|| #                                                                  # ||
|| #              Any infringement of this copyright will             # ||
|| #               result in legal action by the holder               # ||
|| #                                                                  # ||
|| # ----------     SafeGuard Pro IS NOT FREE SOFTWARE     ---------- # ||
|| # -------------------- http://www.gewora.net --------------------- # ||
|| #################################################################### ||
\*======================================================================*/

require_once '../includes/global.inc.php';
require_once '../includes/global_admin.inc.php';

use Gewora\SafeGuardPro\Ban;
use Gewora\SafeGuardPro\Detect;

# Which action should we perform
$action = null;
$bans = null;
$bans_country = null;
$ban_object = new Ban($config, $db);


# Should we ban a new ip
if(isset($_POST['action']) && $_POST['action'] == 'ban_ip') {
    if(isset($_POST['ip']) && !empty($_POST['ip']) && isset($_POST['banned_until']) && !empty($_POST['banned_until'])) {
        $ip = $_POST['ip'];
        $banned_until = strtotime($_POST['banned_until']);

        $ban = $ban_object->ban_ip($ip, $banned_until);

        # Make sure that the ban has been added successfully
        if($ban !== FALSE) {
            $msg->add('s', '<strong>Success!</strong> The selected user has been banned.', 'ban.php');
        } else {
            $msg->add('e', '<strong>Error!</strong> Something went wrong. Unable to add the ban.', 'ban.php');
        }
    }
# Should we ban a country
} elseif(isset($_POST['action']) && $_POST['action'] == 'ban_country') {
    $country = $_POST['country'];

    $ban = $ban_object->ban_country($country);

    # Make sure that the ban has been added successfully
    if($ban !== FALSE) {
        $msg->add('s', '<strong>Success!</strong> The selected country has been banned.', 'ban.php');
    } else {
        $msg->add('e', '<strong>Error!</strong> Something went wrong. Unable to add the ban.', 'ban.php');
    }

# Should we ban an ISP
} elseif(isset($_POST['action']) && $_POST['action'] == 'ban_isp') {
    $isp_ip = $_POST['isp'];

    # Create a detection instance
    $detect = new Detect();

    # Detect the ISP
    $isp = $detect->ISP($isp_ip);

    if($isp != 'N/A') {
        $ban = $ban_object->ban_isp($isp);
    } else {
        $msg->add('e', '<strong>Error!</strong> Unable to retrieve the ISP. Make sure to enter a valid IP address.', 'ban.php');
    }

    # Make sure that the ban has been added successfully
    if($ban !== FALSE) {
        $msg->add('s', '<strong>Success!</strong> The selected ISP has been banned.', 'ban.php');
    } else {
        $msg->add('e', '<strong>Error!</strong> Something went wrong. Unable to add the ban. Maybe this ISP is already banned.', 'ban.php');
    }

# Or should we unban someone
} elseif(isset($_GET['action']) && $_GET['action'] == 'unban') {
    if(isset($_GET['type']) && $_GET['type'] == 'ip') {
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $unban = $ban_object->unban_ip($_GET['id']);
            $msg->add('s', '<strong>Success!</strong> The selected user has been unbanned', 'ban.php');
        }
    } elseif(isset($_GET['type']) && $_GET['type'] == 'country') {
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $unban = $ban_object->unban_country($_GET['id']);
                $msg->add('s', '<strong>Success!</strong> The selected country has been unbanned', 'ban.php');
            }
    } elseif(isset($_GET['type']) && $_GET['type'] == 'isp') {
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $unban = $ban_object->unban_isp($_GET['id']);
            $msg->add('s', '<strong>Success!</strong> The selected ISP has been unbanned', 'ban.php');
        }
    }


# Should we show the current bans
} else {
    $action = 'overview';

    # Get the current ip bans
    $bans = $ban_object->fetch('ip');

    # Get the current country bans
    $bans_country = $ban_object->fetch('country');

    # Get the current ISP bans
    $bans_isp = $ban_object->fetch('isp');
}

# Country codes
$countries = array(
    'AD' => 'Andorra',
    'AE' => 'United Arab Emirates',
    'AF' => 'Afghanistan',
    'AG' => 'Antigua and Barbuda',
    'AI' => 'Anguilla',
    'AL' => 'Albania',
    'AM' => 'Armenia',
    'AN' => 'Netherlands Antilles',
    'AO' => 'Angola',
    'AQ' => 'Antarctica',
    'AR' => 'Argentina',
    'AS' => 'American Samoa',
    'AT' => 'Austria',
    'AU' => 'Australia',
    'AW' => 'Aruba',
    'AZ' => 'Azerbaijan',
    'BA' => 'Bosnia and Herzegovina',
    'BB' => 'Barbados',
    'BD' => 'Bangladesh',
    'BE' => 'Belgium',
    'BF' => 'Burkina Faso',
    'BG' => 'Bulgaria',
    'BH' => 'Bahrain',
    'BI' => 'Burundi',
    'BJ' => 'Benin',
    'BM' => 'Bermuda',
    'BN' => 'Brunei Darussalam',
    'BO' => 'Bolivia',
    'BR' => 'Brazil',
    'BS' => 'Bahama',
    'BT' => 'Bhutan',
    'BV' => 'Bouvet Island',
    'BW' => 'Botswana',
    'BY' => 'Belarus',
    'BZ' => 'Belize',
    'CA' => 'Canada',
    'CC' => 'Cocos (Keeling) Islands',
    'CF' => 'Central African Republic',
    'CG' => 'Congo',
    'CH' => 'Switzerland',
    'CI' => 'Côte D\'ivoire (Ivory Coast)',
    'CK' => 'Cook Iislands',
    'CL' => 'Chile',
    'CM' => 'Cameroon',
    'CN' => 'China',
    'CO' => 'Colombia',
    'CR' => 'Costa Rica',
    'CU' => 'Cuba',
    'CV' => 'Cape Verde',
    'CX' => 'Christmas Island',
    'CY' => 'Cyprus',
    'CZ' => 'Czech Republic',
    'DE' => 'Germany',
    'DJ' => 'Djibouti',
    'DK' => 'Denmark',
    'DM' => 'Dominica',
    'DO' => 'Dominican Republic',
    'DZ' => 'Algeria',
    'EC' => 'Ecuador',
    'EE' => 'Estonia',
    'EG' => 'Egypt',
    'EH' => 'Western Sahara',
    'ER' => 'Eritrea',
    'ES' => 'Spain',
    'ET' => 'Ethiopia',
    'FI' => 'Finland',
    'FJ' => 'Fiji',
    'FK' => 'Falkland Islands (Malvinas)',
    'FM' => 'Micronesia',
    'FO' => 'Faroe Islands',
    'FR' => 'France',
    'FX' => 'France, Metropolitan',
    'GA' => 'Gabon',
    'GB' => 'United Kingdom (Great Britain)',
    'GD' => 'Grenada',
    'GE' => 'Georgia',
    'GF' => 'French Guiana',
    'GH' => 'Ghana',
    'GI' => 'Gibraltar',
    'GL' => 'Greenland',
    'GM' => 'Gambia',
    'GN' => 'Guinea',
    'GP' => 'Guadeloupe',
    'GQ' => 'Equatorial Guinea',
    'GR' => 'Greece',
    'GS' => 'South Georgia and the South Sandwich Islands',
    'GT' => 'Guatemala',
    'GU' => 'Guam',
    'GW' => 'Guinea-Bissau',
    'GY' => 'Guyana',
    'HK' => 'Hong Kong',
    'HM' => 'Heard and McDonald Islands',
    'HN' => 'Honduras',
    'HR' => 'Croatia',
    'HT' => 'Haiti',
    'HU' => 'Hungary',
    'ID' => 'Indonesia',
    'IE' => 'Ireland',
    'IL' => 'Israel',
    'IN' => 'India',
    'IO' => 'British Indian Ocean Territory',
    'IQ' => 'Iraq',
    'IR' => 'Islamic Republic of Iran',
    'IS' => 'Iceland',
    'IT' => 'Italy',
    'JM' => 'Jamaica',
    'JO' => 'Jordan',
    'JP' => 'Japan',
    'KE' => 'Kenya',
    'KG' => 'Kyrgyzstan',
    'KH' => 'Cambodia',
    'KI' => 'Kiribati',
    'KM' => 'Comoros',
    'KN' => 'St. Kitts and Nevis',
    'KP' => 'Korea, Democratic People\'s Republic of',
    'KR' => 'Korea, Republic of',
    'KW' => 'Kuwait',
    'KY' => 'Cayman Islands',
    'KZ' => 'Kazakhstan',
    'LA' => 'Lao People\'s Democratic Republic',
    'LB' => 'Lebanon',
    'LC' => 'Saint Lucia',
    'LI' => 'Liechtenstein',
    'LK' => 'Sri Lanka',
    'LR' => 'Liberia',
    'LS' => 'Lesotho',
    'LT' => 'Lithuania',
    'LU' => 'Luxembourg',
    'LV' => 'Latvia',
    'LY' => 'Libyan Arab Jamahiriya',
    'MA' => 'Morocco',
    'MC' => 'Monaco',
    'MD' => 'Moldova, Republic of',
    'MG' => 'Madagascar',
    'MH' => 'Marshall Islands',
    'ML' => 'Mali',
    'MN' => 'Mongolia',
    'MM' => 'Myanmar',
    'MO' => 'Macau',
    'MP' => 'Northern Mariana Islands',
    'MQ' => 'Martinique',
    'MR' => 'Mauritania',
    'MS' => 'Monserrat',
    'MT' => 'Malta',
    'MU' => 'Mauritius',
    'MV' => 'Maldives',
    'MW' => 'Malawi',
    'MX' => 'Mexico',
    'MY' => 'Malaysia',
    'MZ' => 'Mozambique',
    'NA' => 'Namibia',
    'NC' => 'New Caledonia',
    'NE' => 'Niger',
    'NF' => 'Norfolk Island',
    'NG' => 'Nigeria',
    'NI' => 'Nicaragua',
    'NL' => 'Netherlands',
    'NO' => 'Norway',
    'NP' => 'Nepal',
    'NR' => 'Nauru',
    'NU' => 'Niue',
    'NZ' => 'New Zealand',
    'OM' => 'Oman',
    'PA' => 'Panama',
    'PE' => 'Peru',
    'PF' => 'French Polynesia',
    'PG' => 'Papua New Guinea',
    'PH' => 'Philippines',
    'PK' => 'Pakistan',
    'PL' => 'Poland',
    'PM' => 'St. Pierre and Miquelon',
    'PN' => 'Pitcairn',
    'PR' => 'Puerto Rico',
    'PT' => 'Portugal',
    'PW' => 'Palau',
    'PY' => 'Paraguay',
    'QA' => 'Qatar',
    'RE' => 'Réunion',
    'RO' => 'Romania',
    'RU' => 'Russian Federation',
    'RW' => 'Rwanda',
    'SA' => 'Saudi Arabia',
    'SB' => 'Solomon Islands',
    'SC' => 'Seychelles',
    'SD' => 'Sudan',
    'SE' => 'Sweden',
    'SG' => 'Singapore',
    'SH' => 'St. Helena',
    'SI' => 'Slovenia',
    'SJ' => 'Svalbard and Jan Mayen Islands',
    'SK' => 'Slovakia',
    'SL' => 'Sierra Leone',
    'SM' => 'San Marino',
    'SN' => 'Senegal',
    'SO' => 'Somalia',
    'SR' => 'Suriname',
    'ST' => 'Sao Tome and Principe',
    'SV' => 'El Salvador',
    'SY' => 'Syrian Arab Republic',
    'SZ' => 'Swaziland',
    'TC' => 'Turks and Caicos Islands',
    'TD' => 'Chad',
    'TF' => 'French Southern Territories',
    'TG' => 'Togo',
    'TH' => 'Thailand',
    'TJ' => 'Tajikistan',
    'TK' => 'Tokelau',
    'TM' => 'Turkmenistan',
    'TN' => 'Tunisia',
    'TO' => 'Tonga',
    'TP' => 'East Timor',
    'TR' => 'Turkey',
    'TT' => 'Trinidad and Tobago',
    'TV' => 'Tuvalu',
    'TW' => 'Taiwan, Province of China',
    'TZ' => 'Tanzania, United Republic of',
    'UA' => 'Ukraine',
    'UG' => 'Uganda',
    'UM' => 'United States Minor Outlying Islands',
    'US' => 'United States of America',
    'UY' => 'Uruguay',
    'UZ' => 'Uzbekistan',
    'VA' => 'Vatican City State (Holy See)',
    'VC' => 'St. Vincent and the Grenadines',
    'VE' => 'Venezuela',
    'VG' => 'British Virgin Islands',
    'VI' => 'United States Virgin Islands',
    'VN' => 'Viet Nam',
    'VU' => 'Vanuatu',
    'WF' => 'Wallis and Futuna Islands',
    'WS' => 'Samoa',
    'YE' => 'Yemen',
    'YT' => 'Mayotte',
    'YU' => 'Yugoslavia',
    'ZA' => 'South Africa',
    'ZM' => 'Zambia',
    'ZR' => 'Zaire',
    'ZW' => 'Zimbabwe'
);

# Render template
$template = $twig->loadTemplate('ban.html.twig');
echo $template->render(array(
    'msg' => $msg,
    'action' => $action,
    'bans' => $bans,
    'bans_country' => $bans_country,
    'bans_isp' => $bans_isp,
    'countries' => $countries,
));
