<?php
/**
 * @file src/register/content.php
 * @brief HTML file for the register module
 * @author Paul Barbu
 *
 * @ingroup registerFiles
 */
?>

<form action="" method="post">
<table align="center" border=0 cellspacing=5>
<tr><td>
    <fieldset id="req">
    <legend>Required information</legend>
    <table border=0>
    <tr><td>

    <label for="f_n">First name:</label></td><td><input id="f_n" type="text" name="first_name" maxlength=10 />
    </td></tr><tr><td>
    <label for="l_n">Last name:</label></td><td><input id="l_n" type="text" name="last_name" maxlength=10 />
    </td></tr><tr><td>
    <label for="nick">Nickname:</label></td><td><input id="nick" type="text" name="nick" maxlength=20 />
    </td></tr><tr><td>
    <label for="email">E-mail:</label></td><td><input id="email" type="text" name="email" maxlength=255 />
    </td></tr><tr><td>
    <label for="tz">Timezone:</label></td><td><select id="tz" name="timezone">

    <optgroup label='America'>
        <option value="America/Adak">America/Adak</option>
        <option value="America/Anchorage">America/Anchorage</option>
        <option value="America/Antigua">America/Antigua</option>
        <option value="America/Argentina/Catamarca">America/Argentina/Catamarca</option>
        <option value="America/Argentina/Jujuy">America/Argentina/Jujuy</option>
        <option value="America/Asuncion">America/Asuncion</option>
        <option value="America/Bahia_Banderas">America/Bahia_Banderas</option>
        <option value="America/Barbados">America/Barbados</option>
        <option value="America/Belize">America/Belize</option>
        <option value="America/Blanc-Sablon">America/Blanc-Sablon</option>
        <option value="America/Boa_Vista">America/Boa_Vista</option>
        <option value="America/Bogota">America/Bogota</option>
        <option value="America/Boise">America/Boise</option>
        <option value="America/Buenos_Aires">America/Buenos_Aires</option>
        <option value="America/Cambridge_Bay">America/Cambridge_Bay</option>
        <option value="America/Cancun">America/Cancun</option>
        <option value="America/Caracas">America/Caracas</option>
        <option value="America/Cayenne">America/Cayenne</option>
        <option value="America/Cayman">America/Cayman</option>
        <option value="America/Chicago">America/Chicago</option>
        <option value="America/Chihuahua">America/Chihuahua</option>
        <option value="America/Costa_Rica">America/Costa_Rica</option>
        <option value="America/Curacao">America/Curacao</option>
        <option value="America/Danmarkshavn">America/Danmarkshavn</option>
        <option value="America/Dawson">America/Dawson</option>
        <option value="America/Dawson_Creek">America/Dawson_Creek</option>
        <option value="America/Denver">America/Denver</option>
        <option value="America/Detroit">America/Detroit</option>
        <option value="America/Edmonton">America/Edmonton</option>
        <option value="America/El_Salvador">America/El_Salvador</option>
        <option value="America/Fort_Wayne">America/Fort_Wayne</option>
        <option value="America/Godthab">America/Godthab</option>
        <option value="America/Goose_Bay">America/Goose_Bay</option>
        <option value="America/Grand_Turk">America/Grand_Turk</option>
        <option value="America/Guayaquil">America/Guayaquil</option>
        <option value="America/Guyana">America/Guyana</option>
        <option value="America/Halifax">America/Halifax</option>
        <option value="America/Havana">America/Havana</option>
        <option value="America/Hermosillo">America/Hermosillo</option>
        <option value="America/Inuvik">America/Inuvik</option>
        <option value="America/Iqaluit">America/Iqaluit</option>
        <option value="America/Juneau">America/Juneau</option>
        <option value="America/La_Paz">America/La_Paz</option>
        <option value="America/Lima">America/Lima</option>
        <option value="America/Los_Angeles">America/Los_Angeles</option>
        <option value="America/Managua">America/Managua</option>
        <option value="America/Martinique">America/Martinique</option>
        <option value="America/Merida">America/Merida</option>
        <option value="America/Mexico_City">America/Mexico_City</option>
        <option value="America/Miquelon">America/Miquelon</option>
        <option value="America/Moncton">America/Moncton</option>
        <option value="America/Montevideo">America/Montevideo</option>
        <option value="America/Nassau">America/Nassau</option>
        <option value="America/New_York">America/New_York</option>
        <option value="America/Nome">America/Nome</option>
        <option value="America/Noronha">America/Noronha</option>
        <option value="America/North_Dakota/Center">America/North_Dakota/Center</option>
        <option value="America/Panama">America/Panama</option>
        <option value="America/Pangnirtung">America/Pangnirtung</option>
        <option value="America/Paramaribo">America/Paramaribo</option>
        <option value="America/Phoenix">America/Phoenix</option>
        <option value="America/Port-au-Prince">America/Port-au-Prince</option>
        <option value="America/Porto_Acre">America/Porto_Acre</option>
        <option value="America/Puerto_Rico">America/Puerto_Rico</option>
        <option value="America/Rainy_River">America/Rainy_River</option>
        <option value="America/Rankin_Inlet">America/Rankin_Inlet</option>
        <option value="America/Regina">America/Regina</option>
        <option value="America/Resolute">America/Resolute</option>
        <option value="America/Santa_Isabel">America/Santa_Isabel</option>
        <option value="America/Santarem">America/Santarem</option>
        <option value="America/Santiago">America/Santiago</option>
        <option value="America/Santo_Domingo">America/Santo_Domingo</option>
        <option value="America/Sao_Paulo">America/Sao_Paulo</option>
        <option value="America/Scoresbysund">America/Scoresbysund</option>
        <option value="America/St_Johns">America/St_Johns</option>
        <option value="America/St_Lucia">America/St_Lucia</option>
        <option value="America/St_Vincent">America/St_Vincent</option>
        <option value="America/Thule">America/Thule</option>
        <option value="America/Thunder_Bay">America/Thunder_Bay</option>
        <option value="America/Yakutat">America/Yakutat</option>
        <option value="America/Yellowknife">America/Yellowknife</option>
    </optgroup>

    <optgroup label="Arctic">
        <option value="Arctic/Longyearbyen">Arctic/Longyearbyen</option>
    </optgroup>

    <optgroup label="Asia">
        <option value="Asia/Almaty">Asia/Almaty</option>
        <option value="Asia/Amman">Asia/Amman</option>
        <option value="Asia/Anadyr">Asia/Anadyr</option>
        <option value="Asia/Aqtau">Asia/Aqtau</option>
        <option value="Asia/Aqtobe">Asia/Aqtobe</option>
        <option value="Asia/Ashkhabad">Asia/Ashkhabad</option>
        <option value="Asia/Baghdad">Asia/Baghdad</option>
        <option value="Asia/Bahrain">Asia/Bahrain</option>
        <option value="Asia/Baku">Asia/Baku</option>
        <option value="Asia/Bangkok">Asia/Bangkok</option>
        <option value="Asia/Beirut">Asia/Beirut</option>
        <option value="Asia/Bishkek">Asia/Bishkek</option>
        <option value="Asia/Brunei">Asia/Brunei</option>
        <option value="Asia/Choibalsan">Asia/Choibalsan</option>
        <option value="Asia/Chongqing">Asia/Chongqing</option>
        <option value="Asia/Colombo">Asia/Colombo</option>
        <option value="Asia/Dacca">Asia/Dacca</option>
        <option value="Asia/Dili">Asia/Dili</option>
        <option value="Asia/Dubai">Asia/Dubai</option>
        <option value="Asia/Dushanbe">Asia/Dushanbe</option>
        <option value="Asia/Gaza">Asia/Gaza</option>
        <option value="Asia/Harbin">Asia/Harbin</option>
        <option value="Asia/Ho_Chi_Minh">Asia/Ho_Chi_Minh</option>
        <option value="Asia/Hong_Kong">Asia/Hong_Kong</option>
        <option value="Asia/Hovd">Asia/Hovd</option>
        <option value="Asia/Irkutsk">Asia/Irkutsk</option>
        <option value="Asia/Istanbul">Asia/Istanbul</option>
        <option value="Asia/Jakarta">Asia/Jakarta</option>
        <option value="Asia/Jayapura">Asia/Jayapura</option>
        <option value="Asia/Jerusalem">Asia/Jerusalem</option>
        <option value="Asia/Kabul">Asia/Kabul</option>
        <option value="Asia/Kamchatka">Asia/Kamchatka</option>
        <option value="Asia/Karachi">Asia/Karachi</option>
        <option value="Asia/Kashgar">Asia/Kashgar</option>
        <option value="Asia/Kathmandu">Asia/Kathmandu</option>
        <option value="Asia/Kolkata">Asia/Kolkata</option>
        <option value="Asia/Krasnoyarsk">Asia/Krasnoyarsk</option>
        <option value="Asia/Kuala_Lumpur">Asia/Kuala_Lumpur</option>
        <option value="Asia/Kuching">Asia/Kuching</option>
        <option value="Asia/Macao">Asia/Macao</option>
        <option value="Asia/Magadan">Asia/Magadan</option>
        <option value="Asia/Makassar">Asia/Makassar</option>
        <option value="Asia/Manila">Asia/Manila</option>
        <option value="Asia/Novokuznetsk">Asia/Novokuznetsk</option>
        <option value="Asia/Novosibirsk">Asia/Novosibirsk</option>
        <option value="Asia/Omsk">Asia/Omsk</option>
        <option value="Asia/Oral">Asia/Oral</option>
        <option value="Asia/Pontianak">Asia/Pontianak</option>
        <option value="Asia/Pyongyang">Asia/Pyongyang</option>
        <option value="Asia/Qyzylorda">Asia/Qyzylorda</option>
        <option value="Asia/Rangoon">Asia/Rangoon</option>
        <option value="Asia/Riyadh">Asia/Riyadh</option>
        <option value="Asia/Sakhalin">Asia/Sakhalin</option>
        <option value="Asia/Samarkand">Asia/Samarkand</option>
        <option value="Asia/Seoul">Asia/Seoul</option>
        <option value="Asia/Singapore">Asia/Singapore</option>
        <option value="Asia/Taipei">Asia/Taipei</option>
        <option value="Asia/Tashkent">Asia/Tashkent</option>
        <option value="Asia/Tbilisi">Asia/Tbilisi</option>
        <option value="Asia/Tehran">Asia/Tehran</option>
        <option value="Asia/Thimbu">Asia/Thimbu</option>
        <option value="Asia/Tokyo">Asia/Tokyo</option>
        <option value="Asia/Ulaanbaatar">Asia/Ulaanbaatar</option>
        <option value="Asia/Urumqi">Asia/Urumqi</option>
        <option value="Asia/Vladivostok">Asia/Vladivostok</option>
        <option value="Asia/Yakutsk">Asia/Yakutsk</option>
        <option value="Asia/Yekaterinburg">Asia/Yekaterinburg</option>
        <option value="Asia/Yerevan">Asia/Yerevan</option>
    </optgroup>

    <optgroup label="Atlantic">
        <option value="Atlantic/Azores">Atlantic/Azores</option>
        <option value="Atlantic/Canary">Atlantic/Canary</option>
        <option value="Atlantic/Cape_Verde">Atlantic/Cape_Verde</option>
        <option value="Atlantic/Faeroe">Atlantic/Faeroe</option>
        <option value="Atlantic/Madeira">Atlantic/Madeira</option>
        <option value="Atlantic/Reykjavik">Atlantic/Reykjavik</option>
        <option value="Atlantic/South_Georgia">Atlantic/South_Georgia</option>
        <option value="Atlantic/St_Helena">Atlantic/St_Helena</option>
        <option value="Atlantic/Stanley">Atlantic/Stanley</option>
    </optgroup>

    <optgroup label="Europe">
        <option value="Europe/Amsterdam">Europe/Amsterdam</option>
        <option value="Europe/Andorra">Europe/Andorra</option>
        <option value="Europe/Athens">Europe/Athens</option>
        <option value="Europe/Berlin">Europe/Berlin</option>
        <option value="Europe/Brussels">Europe/Brussels</option>
        <option value="Europe/Bucharest" selected="selected">Europe/Bucharest</option>
        <option value="Europe/Dublin">Europe/Dublin</option>
        <option value="Europe/Gibraltar">Europe/Gibraltar</option>
        <option value="Europe/Helsinki">Europe/Helsinki</option>
        <option value="Europe/Kaliningrad">Europe/Kaliningrad</option>
        <option value="Europe/Kiev">Europe/Kiev</option>
        <option value="Europe/Lisbon">Europe/Lisbon</option>
        <option value="Europe/London">Europe/London</option>
        <option value="Europe/Luxembourg">Europe/Luxembourg</option>
        <option value="Europe/Madrid">Europe/Madrid</option>
        <option value="Europe/Minsk">Europe/Minsk</option>
        <option value="Europe/Monaco">Europe/Monaco</option>
        <option value="Europe/Moscow">Europe/Moscow</option>
        <option value="Europe/Riga">Europe/Riga</option>
        <option value="Europe/Samara">Europe/Samara</option>
        <option value="Europe/Simferopol">Europe/Simferopol</option>
        <option value="Europe/Sofia">Europe/Sofia</option>
        <option value="Europe/Tallinn">Europe/Tallinn</option>
        <option value="Europe/Tirane">Europe/Tirane</option>
        <option value="Europe/Tiraspol">Europe/Tiraspol</option>
        <option value="Europe/Uzhgorod">Europe/Uzhgorod</option>
        <option value="Europe/Vilnius">Europe/Vilnius</option>
        <option value="Europe/Volgograd">Europe/Volgograd</option>
        <option value="Europe/Warsaw">Europe/Warsaw</option>
        <option value="Europe/Zaporozhye">Europe/Zaporozhye</option>
    </optgroup>

    <optgroup label="Indian">
        <option value="Indian/Antananarivo">Indian/Antananarivo</option>
        <option value="Indian/Chagos">Indian/Chagos</option>
        <option value="Indian/Christmas">Indian/Christmas</option>
        <option value="Indian/Cocos">Indian/Cocos</option>
        <option value="Indian/Comoro">Indian/Comoro</option>
        <option value="Indian/Kerguelen">Indian/Kerguelen</option>
        <option value="Indian/Mahe">Indian/Mahe</option>
        <option value="Indian/Maldives">Indian/Maldives</option>
        <option value="Indian/Mauritius">Indian/Mauritius</option>
        <option value="Indian/Reunion">Indian/Reunion</option>
    </optgroup>

    <optgroup label="Pacific">
        <option value="Pacific/Apia">Pacific/Apia</option>
        <option value="Pacific/Auckland">Pacific/Auckland</option>
        <option value="Pacific/Chatham">Pacific/Chatham</option>
        <option value="Pacific/Chuuk">Pacific/Chuuk</option>
        <option value="Pacific/Easter">Pacific/Easter</option>
        <option value="Pacific/Efate">Pacific/Efate</option>
        <option value="Pacific/Enderbury">Pacific/Enderbury</option>
        <option value="Pacific/Fakaofo">Pacific/Fakaofo</option>
        <option value="Pacific/Fiji">Pacific/Fiji</option>
        <option value="Pacific/Funafuti">Pacific/Funafuti</option>
        <option value="Pacific/Galapagos">Pacific/Galapagos</option>
        <option value="Pacific/Gambier">Pacific/Gambier</option>
        <option value="Pacific/Guadalcanal">Pacific/Guadalcanal</option>
        <option value="Pacific/Guam">Pacific/Guam</option>
        <option value="Pacific/Honolulu">Pacific/Honolulu</option>
        <option value="Pacific/Johnston">Pacific/Johnston</option>
        <option value="Pacific/Kiritimati">Pacific/Kiritimati</option>
        <option value="Pacific/Kosrae">Pacific/Kosrae</option>
        <option value="Pacific/Kwajalein">Pacific/Kwajalein</option>
        <option value="Pacific/Majuro">Pacific/Majuro</option>
        <option value="Pacific/Marquesas">Pacific/Marquesas</option>
        <option value="Pacific/Midway">Pacific/Midway</option>
        <option value="Pacific/Nauru">Pacific/Nauru</option>
        <option value="Pacific/Niue">Pacific/Niue</option>
        <option value="Pacific/Norfolk">Pacific/Norfolk</option>
        <option value="Pacific/Noumea">Pacific/Noumea</option>
        <option value="Pacific/Pago_Pago">Pacific/Pago_Pago</option>
        <option value="Pacific/Palau">Pacific/Palau</option>
        <option value="Pacific/Pitcairn">Pacific/Pitcairn</option>
        <option value="Pacific/Pohnpei">Pacific/Pohnpei</option>
        <option value="Pacific/Port_Moresby">Pacific/Port_Moresby</option>
        <option value="Pacific/Rarotonga">Pacific/Rarotonga</option>
        <option value="Pacific/Saipan">Pacific/Saipan</option>
        <option value="Pacific/Tahiti">Pacific/Tahiti</option>
        <option value="Pacific/Tarawa">Pacific/Tarawa</option>
        <option value="Pacific/Tongatapu">Pacific/Tongatapu</option>
        <option value="Pacific/Wake">Pacific/Wake</option>
        <option value="Pacific/Wallis">Pacific/Wallis</option>
    </optgroup>

    </select>
    </td></tr><tr><td>
    <label for="country">Country:</label></td><td><select id="country" name="country">
        <option value="AF">Afghanistan</option>
        <option value="AX">ÅLand Islands</option>
        <option value="AL">Albania</option>
        <option value="DZ">Algeria</option>
        <option value="AS">American Samoa</option>
        <option value="AD">Andorra</option>
        <option value="AO">Angola</option>
        <option value="AI">Anguilla</option>
        <option value="AQ">Antarctica</option>
        <option value="AG">Antigua And Barbuda</option>
        <option value="AR">Argentina</option>
        <option value="AM">Armenia</option>
        <option value="AW">Aruba</option>
        <option value="AU">Australia</option>
        <option value="AT">Austria</option>
        <option value="AZ">Azerbaijan</option>
        <option value="BS">Bahamas</option>
        <option value="BH">Bahrain</option>
        <option value="BD">Bangladesh</option>
        <option value="BB">Barbados</option>
        <option value="BY">Belarus</option>
        <option value="BE">Belgium</option>
        <option value="BZ">Belize</option>
        <option value="BJ">Benin</option>
        <option value="BM">Bermuda</option>
        <option value="BT">Bhutan</option>
        <option value="BO">Bolivia</option>
        <option value="BQ">Bonaire</option>
        <option value="BA">Bosnia And Herzegovina</option>
        <option value="BW">Botswana</option>
        <option value="BV">Bouvet Island</option>
        <option value="BR">Brazil</option>
        <option value="IO">British Indian Ocean Territory</option>
        <option value="BN">Brunei Darussalam</option>
        <option value="BG">Bulgaria</option>
        <option value="BF">Burkina Faso</option>
        <option value="BI">Burundi</option>
        <option value="KH">Cambodia</option>
        <option value="CM">Cameroon</option>
        <option value="CA">Canada</option>
        <option value="CV">Cape Verde</option>
        <option value="KY">Cayman Islands</option>
        <option value="CF">Central African Republic</option>
        <option value="TD">Chad</option>
        <option value="CL">Chile</option>
        <option value="CN">China</option>
        <option value="CX">Christmas Island</option>
        <option value="CC">Cocos (Keeling) Islands</option>
        <option value="CO">Colombia</option>
        <option value="KM">Comoros</option>
        <option value="CG">Congo</option>
        <option value="CD">Congo</option>
        <option value="CK">Cook Islands</option>
        <option value="CR">Costa Rica</option>
        <option value="CI">CÔTe D'Ivoire</option>
        <option value="HR">Croatia</option>
        <option value="CU">Cuba</option>
        <option value="CW">CuraÇAo</option>
        <option value="CY">Cyprus</option>
        <option value="CZ">Czech Republic</option>
        <option value="DK">Denmark</option>
        <option value="DJ">Djibouti</option>
        <option value="DM">Dominica</option>
        <option value="DO">Dominican Republic</option>
        <option value="EC">Ecuador</option>
        <option value="EG">Egypt</option>
        <option value="SV">El Salvador</option>
        <option value="GQ">Equatorial Guinea</option>
        <option value="ER">Eritrea</option>
        <option value="EE">Estonia</option>
        <option value="ET">Ethiopia</option>
        <option value="FK">Falkland Islands (Malvinas)</option>
        <option value="FO">Faroe Islands</option>
        <option value="FJ">Fiji</option>
        <option value="FI">Finland</option>
        <option value="FR">France</option>
        <option value="GF">French Guiana</option>
        <option value="PF">French Polynesia</option>
        <option value="TF">French Southern Territories</option>
        <option value="GA">Gabon</option>
        <option value="GM">Gambia</option>
        <option value="GE">Georgia</option>
        <option value="DE">Germany</option>
        <option value="GH">Ghana</option>
        <option value="GI">Gibraltar</option>
        <option value="GR">Greece</option>
        <option value="GL">Greenland</option>
        <option value="GD">Grenada</option>
        <option value="GP">Guadeloupe</option>
        <option value="GU">Guam</option>
        <option value="GT">Guatemala</option>
        <option value="GG">Guernsey</option>
        <option value="GN">Guinea</option>
        <option value="GW">Guinea-Bissau</option>
        <option value="GY">Guyana</option>
        <option value="HT">Haiti</option>
        <option value="HM">Heard Island</option>
        <option value="VA">Holy See (Vatican City State)</option>
        <option value="HN">Honduras</option>
        <option value="HK">Hong Kong</option>
        <option value="HU">Hungary</option>
        <option value="IS">Iceland</option>
        <option value="IN">India</option>
        <option value="ID">Indonesia</option>
        <option value="IR">Iran</option>
        <option value="IQ">Iraq</option>
        <option value="IE">Ireland</option>
        <option value="IM">Isle Of Man</option>
        <option value="IL">Israel</option>
        <option value="IT">Italy</option>
        <option value="JM">Jamaica</option>
        <option value="JP">Japan</option>
        <option value="JE">Jersey</option>
        <option value="JO">Jordan</option>
        <option value="KZ">Kazakhstan</option>
        <option value="KE">Kenya</option>
        <option value="KI">Kiribati</option>
        <option value="KP">Korea</option>
        <option value="KR">Korea</option>
        <option value="KW">Kuwait</option>
        <option value="KG">Kyrgyzstan</option>
        <option value="LA">Lao People'S Democratic Republic</option>
        <option value="LV">Latvia</option>
        <option value="LB">Lebanon</option>
        <option value="LS">Lesotho</option>
        <option value="LR">Liberia</option>
        <option value="LY">Libyan Arab Jamahiriya</option>
        <option value="LI">Liechtenstein</option>
        <option value="LT">Lithuania</option>
        <option value="LU">Luxembourg</option>
        <option value="MO">Macao</option>
        <option value="MK">Macedonia</option>
        <option value="MG">Madagascar</option>
        <option value="MW">Malawi</option>
        <option value="MY">Malaysia</option>
        <option value="MV">Maldives</option>
        <option value="ML">Mali</option>
        <option value="MT">Malta</option>
        <option value="MH">Marshall Islands</option>
        <option value="MQ">Martinique</option>
        <option value="MR">Mauritania</option>
        <option value="MU">Mauritius</option>
        <option value="YT">Mayotte</option>
        <option value="MX">Mexico</option>
        <option value="FM">Micronesia</option>
        <option value="MD">Moldova</option>
        <option value="MC">Monaco</option>
        <option value="MN">Mongolia</option>
        <option value="ME">Montenegro</option>
        <option value="MS">Montserrat</option>
        <option value="MA">Morocco</option>
        <option value="MZ">Mozambique</option>
        <option value="MM">Myanmar</option>
        <option value="NA">Namibia</option>
        <option value="NR">Nauru</option>
        <option value="NP">Nepal</option>
        <option value="NL">Netherlands</option>
        <option value="NC">New Caledonia</option>
        <option value="NZ">New Zealand</option>
        <option value="NI">Nicaragua</option>
        <option value="NE">Niger</option>
        <option value="NG">Nigeria</option>
        <option value="NU">Niue</option>
        <option value="NF">Norfolk Island</option>
        <option value="MP">Northern Mariana Islands</option>
        <option value="NO">Norway</option>
        <option value="OM">Oman</option>
        <option value="PK">Pakistan</option>
        <option value="PW">Palau</option>
        <option value="PS">Palestinian Territory</option>
        <option value="PA">Panama</option>
        <option value="PG">Papua New Guinea</option>
        <option value="PY">Paraguay</option>
        <option value="PE">Peru</option>
        <option value="PH">Philippines</option>
        <option value="PN">Pitcairn</option>
        <option value="PL">Poland</option>
        <option value="PT">Portugal</option>
        <option value="PR">Puerto Rico</option>
        <option value="QA">Qatar</option>
        <option value="RE">RÉUnion</option>
        <option value="RO" selected="selected">Romania</option>
        <option value="RU">Russian Federation</option>
        <option value="RW">Rwanda</option>
        <option value="BL">Saint BarthÉLemy</option>
        <option value="SH">Saint Helena</option>
        <option value="KN">Saint Kitts And Nevis</option>
        <option value="LC">Saint Lucia</option>
        <option value="MF">Saint Martin (French Part)</option>
        <option value="PM">Saint Pierre And Miquelon</option>
        <option value="VC">Saint Vincent And The Grenadines</option>
        <option value="WS">Samoa</option>
        <option value="SM">San Marino</option>
        <option value="ST">Sao Tome And Principe</option>
        <option value="SA">Saudi Arabia</option>
        <option value="SN">Senegal</option>
        <option value="RS">Serbia</option>
        <option value="SC">Seychelles</option>
        <option value="SL">Sierra Leone</option>
        <option value="SG">Singapore</option>
        <option value="SX">Sint Maarten (Dutch Part)</option>
        <option value="SK">Slovakia</option>
        <option value="SI">Slovenia</option>
        <option value="SB">Solomon Islands</option>
        <option value="SO">Somalia</option>
        <option value="ZA">South Africa</option>
        <option value="GS">South Georgia</option>
        <option value="SS">South Sudan</option>
        <option value="ES">Spain</option>
        <option value="LK">Sri Lanka</option>
        <option value="SD">Sudan</option>
        <option value="SR">Suriname</option>
        <option value="SJ">Svalbard And Jan Mayen</option>
        <option value="SZ">Swaziland</option>
        <option value="SE">Sweden</option>
        <option value="CH">Switzerland</option>
        <option value="SY">Syrian Arab Republic</option>
        <option value="TW">Taiwan</option>
        <option value="TJ">Tajikistan</option>
        <option value="TZ">Tanzania</option>
        <option value="TH">Thailand</option>
        <option value="TL">Timor-Leste</option>
        <option value="TG">Togo</option>
        <option value="TK">Tokelau</option>
        <option value="TO">Tonga</option>
        <option value="TT">Trinidad And Tobago</option>
        <option value="TN">Tunisia</option>
        <option value="TR">Turkey</option>
        <option value="TM">Turkmenistan</option>
        <option value="TC">Turks And Caicos Islands</option>
        <option value="TV">Tuvalu</option>
        <option value="UG">Uganda</option>
        <option value="UA">Ukraine</option>
        <option value="AE">United Arab Emirates</option>
        <option value="GB">United Kingdom</option>
        <option value="US">United States</option>
        <option value="UM">United States Minor Outlying Islands</option>
        <option value="UY">Uruguay</option>
        <option value="UZ">Uzbekistan</option>
        <option value="VU">Vanuatu</option>
        <option value="VE">Venezuela</option>
        <option value="VN">Viet Nam</option>
        <option value="VG">Virgin Islands</option>
        <option value="VI">Virgin Islands</option>
        <option value="WF">Wallis And Futuna</option>
        <option value="EH">Western Sahara</option>
        <option value="YE">Yemen</option>
        <option value="ZM">Zambia</option>
        <option value="ZW">Zimbabwe</option>
    </select>
    </td></tr><tr><td>
    <label for="city">City:</label></td><td><input id="city" type="text" name="city" maxlength=30 />
    </td></tr><tr><td>

    </td></tr>
    </table>
    </fieldset>

</td><td>

    <fieldset id="opt">
    <legend>Optional information</legend>
    <table border=0>
    <tr><td>

    <label for="priv">Private account:</label></td><td><input id="priv" type="checkbox" name="private" />
    </td></tr><tr><td>
    <label for="sm">Male</label><br />
    <label for="sf"> Female</label></td><td>
    <input type="radio" name="sex" value="M" id="sm" checked /><br />
    <input type="radio" name="sex" value="F" id="sf" />
    </td></tr><tr><td>
    <label for="phone">Phone:</label></td><td><input id="phone" type="text" name="phone" maxlength=20 />
    </td></tr><tr><td><label for="bday">Birthdate:</label></td><td><input type="text" id="bday" value="ZZ-LL-AAAA" name="birthday" maxlength=10 />
    </td></tr><tr><td>
    <label for="desc">Description:</label></td><td><textarea rows="3" cols="23" name="description" maxlength=100 id="desc" ></textarea>
    </td></tr><tr><td>

    </table>
    </fieldset>

</td></tr></table>

<input type="submit" name="register" value="Register" />
</form>

<!--
    <label for="">FOO:</label></td><td><input id="" type="" name="" maxlength=FOO />
    </td></tr><tr><td>
PASSWORD, SEC_Q and SEC_A on activation
-->
