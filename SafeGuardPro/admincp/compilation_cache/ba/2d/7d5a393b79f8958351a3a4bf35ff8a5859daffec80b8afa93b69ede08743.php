<?php

/* ban.html.twig */
class __TwigTemplate_ba2d7d5a393b79f8958351a3a4bf35ff8a5859daffec80b8afa93b69ede08743 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base_admin.html.twig");

        $this->blocks = array(
            'javascript' => array($this, 'block_javascript'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base_admin.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 21
        $context["menu"] = 4;
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 27
    public function block_javascript($context, array $blocks = array())
    {
        // line 28
        echo "    <script>
        \$(function() {
            \$( \"#banned_until\" ).datepicker({
                altField: \"#banned_until\",
                altFormat: \"d MM yy\",
                minDate: \"+1\"
            });
        });
    </script>
";
    }

    // line 40
    public function block_content($context, array $blocks = array())
    {
        // line 41
        echo "    <div class=\"span12\">
        ";
        // line 42
        if ((isset($context["msg"]) ? $context["msg"] : null)) {
            // line 43
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["msg"]) ? $context["msg"] : null), "display"), "html", null, true);
            echo "
        ";
        }
        // line 45
        echo "
        <div class=\"widget\">
            <div class=\"widget-header\"> <i class=\"icon-lock\"></i>
                <h3> Bans</h3>
            </div>
            <!-- /widget-header -->
            <div class=\"widget-content page-tables\">
                <div class=\"tabbable\">
                    <ul class=\"nav nav-tabs\">
                        <li class=\"active\"><a href=\"#ban_active\" data-toggle=\"tab\">Active IP Bans</a></li>
                        <li><a href=\"#ban_active_country\" data-toggle=\"tab\">Active Country Bans</a></li>
                        <li><a href=\"#ban_active_isp\" data-toggle=\"tab\">Active ISP Bans</a></li>
                        <li><a href=\"#ban_add_ip\" data-toggle=\"tab\">Add an IP Ban</a></li>
                        <li><a href=\"#ban_add_country\" data-toggle=\"tab\">Add an Country Ban</a></li>
                        <li><a href=\"#ban_add_isp\" data-toggle=\"tab\">Add an ISP Ban</a></li>
                    </ul>
                    <br>
                    <div class=\"tab-content\">

                        ";
        // line 65
        echo "                        <div class=\"tab-pane active\" id=\"ban_active\">
                            ";
        // line 66
        if (((isset($context["bans"]) ? $context["bans"] : null) != false)) {
            // line 67
            echo "                                <table class=\"table table-striped table-bordered data-table\">
                                    <thead>
                                    <tr>
                                        <th> IP </th>
                                        <th> Banned on</th>
                                        <th> Banned until</th>
                                        <th> Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    ";
            // line 77
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["bans"]) ? $context["bans"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ban"]) {
                // line 78
                echo "                                        <tr>
                                            <td> ";
                // line 79
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ban"]) ? $context["ban"] : null), "ip"), "html", null, true);
                echo " </td>
                                            <td> ";
                // line 80
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ban"]) ? $context["ban"] : null), "created_on"), "html", null, true);
                echo " </td>
                                            <td> ";
                // line 81
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ban"]) ? $context["ban"] : null), "banned_until"), "html", null, true);
                echo " </td>
                                            <td>
                                                <a href=\"ban.php?action=unban&type=ip&id=";
                // line 83
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ban"]) ? $context["ban"] : null), "id"), "html", null, true);
                echo "\" data-toggle=\"tooltip\" title=\"Unban this ip\"><span class=\"icon icon-color icon-remove\"></span></a>
                                            </td>
                                        </tr>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ban'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 87
            echo "                                    </tbody>
                                </table>
                            ";
        } else {
            // line 90
            echo "                                <div class=\"alert alert-success\">
                                    <strong>Look's good!</strong> There is no one banned so far.
                                </div>
                            ";
        }
        // line 94
        echo "                        </div>

                        ";
        // line 97
        echo "                        <div class=\"tab-pane\" id=\"ban_active_country\">
                            ";
        // line 98
        if (((isset($context["bans_country"]) ? $context["bans_country"] : null) != false)) {
            // line 99
            echo "                                <table class=\"table table-striped table-bordered data-table\">
                                    <thead>
                                    <tr>
                                        <th> Country</th>
                                        <th> Banned on</th>
                                        <th> Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    ";
            // line 108
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["bans_country"]) ? $context["bans_country"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ban"]) {
                // line 109
                echo "                                        ";
                $context["country_code"] = $this->getAttribute((isset($context["ban"]) ? $context["ban"] : null), "country_code");
                // line 110
                echo "                                        <tr>
                                            <td> ";
                // line 111
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["countries"]) ? $context["countries"] : null), (isset($context["country_code"]) ? $context["country_code"] : null), array(), "array"), "html", null, true);
                echo " </td>
                                            <td> ";
                // line 112
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ban"]) ? $context["ban"] : null), "created_on"), "html", null, true);
                echo " </td>
                                            <td>
                                                <a href=\"ban.php?action=unban&type=country&id=";
                // line 114
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ban"]) ? $context["ban"] : null), "id"), "html", null, true);
                echo "\" data-toggle=\"tooltip\" title=\"Unban this ip\"><span class=\"icon icon-color icon-remove\"></span></a>
                                            </td>
                                        </tr>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ban'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 118
            echo "                                    </tbody>
                                </table>
                            ";
        } else {
            // line 121
            echo "                                <div class=\"alert alert-success\">
                                    <strong>Look's good!</strong> There is no one banned so far.
                                </div>
                            ";
        }
        // line 125
        echo "                        </div>

                        ";
        // line 128
        echo "                        <div class=\"tab-pane\" id=\"ban_active_isp\">
                            ";
        // line 129
        if (((isset($context["bans_isp"]) ? $context["bans_isp"] : null) != false)) {
            // line 130
            echo "                                <table class=\"table table-striped table-bordered data-table\">
                                    <thead>
                                    <tr>
                                        <th> ISP </th>
                                        <th> Banned on</th>
                                        <th> Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    ";
            // line 139
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["bans_isp"]) ? $context["bans_isp"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["ban"]) {
                // line 140
                echo "                                        <tr>
                                            <td> ";
                // line 141
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ban"]) ? $context["ban"] : null), "isp"), "html", null, true);
                echo " </td>
                                            <td> ";
                // line 142
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ban"]) ? $context["ban"] : null), "created_on"), "html", null, true);
                echo " </td>
                                            <td>
                                                <a href=\"ban.php?action=unban&type=isp&id=";
                // line 144
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["ban"]) ? $context["ban"] : null), "id"), "html", null, true);
                echo "\" data-toggle=\"tooltip\" title=\"Unban this ISP\"><span class=\"icon icon-color icon-remove\"></span></a>
                                            </td>
                                        </tr>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ban'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 148
            echo "                                    </tbody>
                                </table>
                            ";
        } else {
            // line 151
            echo "                                <div class=\"alert alert-success\">
                                    <strong>Look's good!</strong> There is no one banned so far.
                                </div>
                            ";
        }
        // line 155
        echo "                        </div>

                        ";
        // line 158
        echo "                        <div class=\"tab-pane\" id=\"ban_add_ip\">
                            <form class=\"form-horizontal\" action=\"ban.php\" method=\"post\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">IP</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span6\" name=\"ip\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Ban until</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span6\" name=\"banned_until\" id=\"banned_until\">
                                        </div>
                                    </div>
                                    <br />
                                    <div class=\"form-actions\">
                                        <input type=\"hidden\" name=\"action\" value=\"ban_ip\">
                                        <button type=\"submit\" class=\"btn btn-primary\">Add ban</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>

                        ";
        // line 183
        echo "                        <div class=\"tab-pane\" id=\"ban_add_country\">
                            <form class=\"form-horizontal\" action=\"ban.php\" method=\"post\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Country</label>
                                        <div class=\"controls\">
                                            <select name=\"country\">
                                                <option value=\"\">Country...</option>
                                                <option value=\"AF\">Afghanistan</option>
                                                <option value=\"AL\">Albania</option>
                                                <option value=\"DZ\">Algeria</option>
                                                <option value=\"AS\">American Samoa</option>
                                                <option value=\"AD\">Andorra</option>
                                                <option value=\"AG\">Angola</option>
                                                <option value=\"AI\">Anguilla</option>
                                                <option value=\"AG\">Antigua and Barbuda</option>
                                                <option value=\"AR\">Argentina</option>
                                                <option value=\"AA\">Armenia</option>
                                                <option value=\"AW\">Aruba</option>
                                                <option value=\"AU\">Australia</option>
                                                <option value=\"AT\">Austria</option>
                                                <option value=\"AZ\">Azerbaijan</option>
                                                <option value=\"BS\">Bahamas</option>
                                                <option value=\"BH\">Bahrain</option>
                                                <option value=\"BD\">Bangladesh</option>
                                                <option value=\"BB\">Barbados</option>
                                                <option value=\"BY\">Belarus</option>
                                                <option value=\"BE\">Belgium</option>
                                                <option value=\"BZ\">Belize</option>
                                                <option value=\"BJ\">Benin</option>
                                                <option value=\"BM\">Bermuda</option>
                                                <option value=\"BT\">Bhutan</option>
                                                <option value=\"BO\">Bolivia</option>
                                                <option value=\"BL\">Bonaire</option>
                                                <option value=\"BA\">Bosnia and Herzegovina</option>
                                                <option value=\"BW\">Botswana</option>
                                                <option value=\"BR\">Brazil</option>
                                                <option value=\"BC\">British Indian Ocean Ter</option>
                                                <option value=\"BN\">Brunei</option>
                                                <option value=\"BG\">Bulgaria</option>
                                                <option value=\"BF\">Burkina Faso</option>
                                                <option value=\"BI\">Burundi</option>
                                                <option value=\"KH\">Cambodia</option>
                                                <option value=\"CM\">Cameroon</option>
                                                <option value=\"CA\">Canada</option>
                                                <option value=\"IC\">Canary Islands</option>
                                                <option value=\"CV\">Cape Verde</option>
                                                <option value=\"KY\">Cayman Islands</option>
                                                <option value=\"CF\">Central African Republic</option>
                                                <option value=\"TD\">Chad</option>
                                                <option value=\"CD\">Channel Islands</option>
                                                <option value=\"CL\">Chile</option>
                                                <option value=\"CN\">China</option>
                                                <option value=\"CI\">Christmas Island</option>
                                                <option value=\"CS\">Cocos Island</option>
                                                <option value=\"CO\">Colombia</option>
                                                <option value=\"CC\">Comoros</option>
                                                <option value=\"CG\">Congo</option>
                                                <option value=\"CK\">Cook Islands</option>
                                                <option value=\"CR\">Costa Rica</option>
                                                <option value=\"CT\">Cote D'Ivoire</option>
                                                <option value=\"HR\">Croatia</option>
                                                <option value=\"CU\">Cuba</option>
                                                <option value=\"CB\">Curacao</option>
                                                <option value=\"CY\">Cyprus</option>
                                                <option value=\"CZ\">Czech Republic</option>
                                                <option value=\"DK\">Denmark</option>
                                                <option value=\"DJ\">Djibouti</option>
                                                <option value=\"DM\">Dominica</option>
                                                <option value=\"DO\">Dominican Republic</option>
                                                <option value=\"TM\">East Timor</option>
                                                <option value=\"EC\">Ecuador</option>
                                                <option value=\"EG\">Egypt</option>
                                                <option value=\"SV\">El Salvador</option>
                                                <option value=\"GQ\">Equatorial Guinea</option>
                                                <option value=\"ER\">Eritrea</option>
                                                <option value=\"EE\">Estonia</option>
                                                <option value=\"ET\">Ethiopia</option>
                                                <option value=\"FA\">Falkland Islands</option>
                                                <option value=\"FO\">Faroe Islands</option>
                                                <option value=\"FJ\">Fiji</option>
                                                <option value=\"FI\">Finland</option>
                                                <option value=\"FR\">France</option>
                                                <option value=\"GF\">French Guiana</option>
                                                <option value=\"PF\">French Polynesia</option>
                                                <option value=\"FS\">French Southern Ter</option>
                                                <option value=\"GA\">Gabon</option>
                                                <option value=\"GM\">Gambia</option>
                                                <option value=\"GE\">Georgia</option>
                                                <option value=\"DE\">Germany</option>
                                                <option value=\"GH\">Ghana</option>
                                                <option value=\"GI\">Gibraltar</option>
                                                <option value=\"GB\">Great Britain</option>
                                                <option value=\"GR\">Greece</option>
                                                <option value=\"GL\">Greenland</option>
                                                <option value=\"GD\">Grenada</option>
                                                <option value=\"GP\">Guadeloupe</option>
                                                <option value=\"GU\">Guam</option>
                                                <option value=\"GT\">Guatemala</option>
                                                <option value=\"GN\">Guinea</option>
                                                <option value=\"GY\">Guyana</option>
                                                <option value=\"HT\">Haiti</option>
                                                <option value=\"HW\">Hawaii</option>
                                                <option value=\"HN\">Honduras</option>
                                                <option value=\"HK\">Hong Kong</option>
                                                <option value=\"HU\">Hungary</option>
                                                <option value=\"IS\">Iceland</option>
                                                <option value=\"IN\">India</option>
                                                <option value=\"ID\">Indonesia</option>
                                                <option value=\"IA\">Iran</option>
                                                <option value=\"IQ\">Iraq</option>
                                                <option value=\"IR\">Ireland</option>
                                                <option value=\"IM\">Isle of Man</option>
                                                <option value=\"IL\">Israel</option>
                                                <option value=\"IT\">Italy</option>
                                                <option value=\"JM\">Jamaica</option>
                                                <option value=\"JP\">Japan</option>
                                                <option value=\"JO\">Jordan</option>
                                                <option value=\"KZ\">Kazakhstan</option>
                                                <option value=\"KE\">Kenya</option>
                                                <option value=\"KI\">Kiribati</option>
                                                <option value=\"NK\">Korea North</option>
                                                <option value=\"KS\">Korea South</option>
                                                <option value=\"KW\">Kuwait</option>
                                                <option value=\"KG\">Kyrgyzstan</option>
                                                <option value=\"LA\">Laos</option>
                                                <option value=\"LV\">Latvia</option>
                                                <option value=\"LB\">Lebanon</option>
                                                <option value=\"LS\">Lesotho</option>
                                                <option value=\"LR\">Liberia</option>
                                                <option value=\"LY\">Libya</option>
                                                <option value=\"LI\">Liechtenstein</option>
                                                <option value=\"LT\">Lithuania</option>
                                                <option value=\"LU\">Luxembourg</option>
                                                <option value=\"MO\">Macau</option>
                                                <option value=\"MK\">Macedonia</option>
                                                <option value=\"MG\">Madagascar</option>
                                                <option value=\"MY\">Malaysia</option>
                                                <option value=\"MW\">Malawi</option>
                                                <option value=\"MV\">Maldives</option>
                                                <option value=\"ML\">Mali</option>
                                                <option value=\"MT\">Malta</option>
                                                <option value=\"MH\">Marshall Islands</option>
                                                <option value=\"MQ\">Martinique</option>
                                                <option value=\"MR\">Mauritania</option>
                                                <option value=\"MU\">Mauritius</option>
                                                <option value=\"ME\">Mayotte</option>
                                                <option value=\"MX\">Mexico</option>
                                                <option value=\"MI\">Midway Islands</option>
                                                <option value=\"MD\">Moldova</option>
                                                <option value=\"MC\">Monaco</option>
                                                <option value=\"MN\">Mongolia</option>
                                                <option value=\"MS\">Montserrat</option>
                                                <option value=\"MA\">Morocco</option>
                                                <option value=\"MZ\">Mozambique</option>
                                                <option value=\"MM\">Myanmar</option>
                                                <option value=\"NA\">Nambia</option>
                                                <option value=\"NU\">Nauru</option>
                                                <option value=\"NP\">Nepal</option>
                                                <option value=\"AN\">Netherland Antilles</option>
                                                <option value=\"NL\">Netherlands (Holland, Europe)</option>
                                                <option value=\"NV\">Nevis</option>
                                                <option value=\"NC\">New Caledonia</option>
                                                <option value=\"NZ\">New Zealand</option>
                                                <option value=\"NI\">Nicaragua</option>
                                                <option value=\"NE\">Niger</option>
                                                <option value=\"NG\">Nigeria</option>
                                                <option value=\"NW\">Niue</option>
                                                <option value=\"NF\">Norfolk Island</option>
                                                <option value=\"NO\">Norway</option>
                                                <option value=\"OM\">Oman</option>
                                                <option value=\"PK\">Pakistan</option>
                                                <option value=\"PW\">Palau Island</option>
                                                <option value=\"PS\">Palestine</option>
                                                <option value=\"PA\">Panama</option>
                                                <option value=\"PG\">Papua New Guinea</option>
                                                <option value=\"PY\">Paraguay</option>
                                                <option value=\"PE\">Peru</option>
                                                <option value=\"PH\">Philippines</option>
                                                <option value=\"PO\">Pitcairn Island</option>
                                                <option value=\"PL\">Poland</option>
                                                <option value=\"PT\">Portugal</option>
                                                <option value=\"PR\">Puerto Rico</option>
                                                <option value=\"QA\">Qatar</option>
                                                <option value=\"ME\">Republic of Montenegro</option>
                                                <option value=\"RS\">Republic of Serbia</option>
                                                <option value=\"RE\">Reunion</option>
                                                <option value=\"RO\">Romania</option>
                                                <option value=\"RU\">Russia</option>
                                                <option value=\"RW\">Rwanda</option>
                                                <option value=\"NT\">St Barthelemy</option>
                                                <option value=\"EU\">St Eustatius</option>
                                                <option value=\"HE\">St Helena</option>
                                                <option value=\"KN\">St Kitts-Nevis</option>
                                                <option value=\"LC\">St Lucia</option>
                                                <option value=\"MB\">St Maarten</option>
                                                <option value=\"PM\">Saint Pierre and Miquelon</option>
                                                <option value=\"VC\">Saint Vincent and the Grenadiness</option>
                                                <option value=\"SP\">Saipan</option>
                                                <option value=\"SO\">Samoa</option>
                                                <option value=\"AS\">Samoa American</option>
                                                <option value=\"SM\">San Marino</option>
                                                <option value=\"ST\">Sao Tome and Principe</option>
                                                <option value=\"SA\">Saudi Arabia</option>
                                                <option value=\"SN\">Senegal</option>
                                                <option value=\"RS\">Serbia</option>
                                                <option value=\"SC\">Seychelles</option>
                                                <option value=\"SL\">Sierra Leone</option>
                                                <option value=\"SG\">Singapore</option>
                                                <option value=\"SK\">Slovakia</option>
                                                <option value=\"SI\">Slovenia</option>
                                                <option value=\"SB\">Solomon Islands</option>
                                                <option value=\"OI\">Somalia</option>
                                                <option value=\"ZA\">South Africa</option>
                                                <option value=\"ES\">Spain</option>
                                                <option value=\"LK\">Sri Lanka</option>
                                                <option value=\"SD\">Sudan</option>
                                                <option value=\"SR\">Suriname</option>
                                                <option value=\"SZ\">Swaziland</option>
                                                <option value=\"SE\">Sweden</option>
                                                <option value=\"CH\">Switzerland</option>
                                                <option value=\"SY\">Syria</option>
                                                <option value=\"TA\">Tahiti</option>
                                                <option value=\"TW\">Taiwan</option>
                                                <option value=\"TJ\">Tajikistan</option>
                                                <option value=\"TZ\">Tanzania</option>
                                                <option value=\"TH\">Thailand</option>
                                                <option value=\"TG\">Togo</option>
                                                <option value=\"TK\">Tokelau</option>
                                                <option value=\"TO\">Tonga</option>
                                                <option value=\"TT\">Trinidad and Tobago</option>
                                                <option value=\"TN\">Tunisia</option>
                                                <option value=\"TR\">Turkey</option>
                                                <option value=\"TU\">Turkmenistan</option>
                                                <option value=\"TC\">Turks and Caicos Islands</option>
                                                <option value=\"TV\">Tuvalu</option>
                                                <option value=\"UG\">Uganda</option>
                                                <option value=\"UA\">Ukraine</option>
                                                <option value=\"AE\">United Arab Emirates</option>
                                                <option value=\"GB\">United Kingdom</option>
                                                <option value=\"US\">United States of America</option>
                                                <option value=\"UY\">Uruguay</option>
                                                <option value=\"UZ\">Uzbekistan</option>
                                                <option value=\"VU\">Vanuatu</option>
                                                <option value=\"VS\">Vatican City State</option>
                                                <option value=\"VE\">Venezuela</option>
                                                <option value=\"VN\">Vietnam</option>
                                                <option value=\"VB\">Virgin Islands, British</option>
                                                <option value=\"VA\">Virgin Islands, U.S.</option>
                                                <option value=\"WK\">Wake Island</option>
                                                <option value=\"WF\">Wallis and Futuna</option>
                                                <option value=\"YE\">Yemen</option>
                                                <option value=\"ZR\">Zaire</option>
                                                <option value=\"ZM\">Zambia</option>
                                                <option value=\"ZW\">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div>
                                    <br />
                                    <div class=\"form-actions\">
                                        <input type=\"hidden\" name=\"action\" value=\"ban_country\">
                                        <button type=\"submit\" class=\"btn btn-primary\">Add ban</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>

                        ";
        // line 451
        echo "                        <div class=\"tab-pane\" id=\"ban_add_isp\">
                            <form class=\"form-horizontal\" action=\"ban.php\" method=\"post\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">ISP IP</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span6\" name=\"isp\">
                                            <p class=\"help-block\">Enter an IP which belongs to the ISP you want to ban</p>
                                        </div>
                                    </div>
                                    <br />
                                    <div class=\"form-actions\">
                                        <input type=\"hidden\" name=\"action\" value=\"ban_isp\">
                                        <button type=\"submit\" class=\"btn btn-primary\">Add ban</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "ban.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  556 => 451,  287 => 183,  261 => 158,  257 => 155,  251 => 151,  246 => 148,  236 => 144,  231 => 142,  227 => 141,  224 => 140,  220 => 139,  209 => 130,  207 => 129,  204 => 128,  200 => 125,  194 => 121,  189 => 118,  179 => 114,  174 => 112,  170 => 111,  167 => 110,  164 => 109,  160 => 108,  149 => 99,  147 => 98,  144 => 97,  140 => 94,  134 => 90,  129 => 87,  119 => 83,  114 => 81,  110 => 80,  106 => 79,  103 => 78,  99 => 77,  87 => 67,  85 => 66,  82 => 65,  61 => 45,  55 => 43,  53 => 42,  50 => 41,  47 => 40,  34 => 28,  31 => 27,  26 => 21,);
    }
}
