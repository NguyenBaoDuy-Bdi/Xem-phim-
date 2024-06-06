<?php

/* dashboard.html.twig */
class __TwigTemplate_c45b9f08a8ab3146d254fc75f8c5a35d5c1b97370e8d71243c01082c9a15edc4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base_admin.html.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base_admin.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 22
        $context["menu"] = 1;
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 28
    public function block_content($context, array $blocks = array())
    {
        // line 29
        echo "
    <div class=\"span12\">
        ";
        // line 31
        if ((isset($context["msg"]) ? $context["msg"] : null)) {
            // line 32
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["msg"]) ? $context["msg"] : null), "display"), "html", null, true);
            echo "
        ";
        }
        // line 34
        echo "    </div>

    <div class=\"span6\">
        <div class=\"widget\">
            <div class=\"widget-header\"> <i class=\"icon-info-sign\"></i>
                <h3> System Information</h3>
            </div>
            <div class=\"widget-content\">
                <table class=\"table table-striped table-bordered\">
                    <thead>
                    <tr>
                        <th>Option</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>PHP Version</td>
                        <td>
                            <span class=\"label\">";
        // line 53
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["system"]) ? $context["system"] : null), "php_version"), "html", null, true);
        echo "</span>
                        </td>
                    </tr>
                    <tr>
                        <td>mySQL Version</td>
                        <td>
                            <span class=\"label\">";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["system"]) ? $context["system"] : null), "mysql_version"), "html", null, true);
        echo "</span>
                        </td>
                    </tr>
                    <tr>
                        <td>System Time</td>
                        <td>
                            <span class=\"label\">";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["system"]) ? $context["system"] : null), "system_time"), "html", null, true);
        echo "</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class=\"span6\">
        <div class=\"widget\">
            <div class=\"widget-header\"> <i class=\"icon-calendar\"></i>
                <h3> Logging Statistic</h3>
            </div>
            <div class=\"widget-content\">
                <table class=\"table table-striped table-bordered\">
                    <thead>
                    <tr>
                        <th>Time Frame</th>
                        <th>Attacks</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1 Day</td>
                            <td>
                                <span class=\"label\">";
        // line 91
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["stats"]) ? $context["stats"] : null), "day"), "html", null, true);
        echo "</span>
                            </td>
                        </tr>
                        <tr>
                            <td>1 Week</td>
                            <td>
                                <span class=\"label\">";
        // line 97
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["stats"]) ? $context["stats"] : null), "week"), "html", null, true);
        echo "</span>
                            </td>
                        </tr>
                        <tr>
                            <td>1 Month</td>
                            <td>
                                <span class=\"label\">";
        // line 103
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["stats"]) ? $context["stats"] : null), "month"), "html", null, true);
        echo "</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class=\"span4\">
        <div class=\"widget\">
            <div class=\"widget-header\"> <i class=\"icon-eye-open\"></i>
                <h3> Protection Settings</h3>
            </div>
            <div class=\"widget-content\">
                <table class=\"table table-striped table-bordered\">
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Mass requests (DDos)</td>
                        <td>
                            ";
        // line 129
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "protection_mass_requests") == true)) {
            // line 130
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 132
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 134
        echo "                        </td>
                    </tr>
                    <tr>
                        <td>Proxies & VPN</td>
                        <td>
                            ";
        // line 139
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "protection_proxies") == true)) {
            // line 140
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 142
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 144
        echo "                        </td>
                    </tr>
                    <tr>
                        <td>SQL Injections</td>
                        <td>
                            ";
        // line 149
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "protection_sql_injections") == true)) {
            // line 150
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 152
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 154
        echo "                        </td>
                    </tr>
                    <tr>
                        <td>XSS Attacks</td>
                        <td>
                            ";
        // line 159
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "protection_xss_attacks") == true)) {
            // line 160
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 162
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 164
        echo "                        </td>
                    </tr>
                    <tr>
                        <td>Spammers</td>
                        <td>
                            ";
        // line 169
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "protection_spammers") == true)) {
            // line 170
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 172
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 174
        echo "                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class=\"span4\">
        <div class=\"widget\">
            <div class=\"widget-header\"> <i class=\"icon-list-alt\"></i>
                <h3> Logging settings</h3>
            </div>
            <div class=\"widget-content\">
                <table class=\"table table-striped table-bordered\">
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Mass requests (DDos)</td>
                        <td>
                            ";
        // line 199
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "log_mass_requests") == true)) {
            // line 200
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 202
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 204
        echo "                        </td>
                    </tr>
                    <tr>
                        <td>Proxies & VPN</td>
                        <td>
                            ";
        // line 209
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "log_proxies") == true)) {
            // line 210
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 212
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 214
        echo "                        </td>
                    </tr>
                    <tr>
                        <td>SQL Injections</td>
                        <td>
                            ";
        // line 219
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "log_sql_injections") == true)) {
            // line 220
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 222
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 224
        echo "                        </td>
                    </tr>
                    <tr>
                        <td>XSS Attacks</td>
                        <td>
                            ";
        // line 229
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "log_xss_attacks") == true)) {
            // line 230
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 232
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 234
        echo "                        </td>
                    </tr>
                    <tr>
                        <td>Spammers</td>
                        <td>
                            ";
        // line 239
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "log_spammers") == true)) {
            // line 240
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 242
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 244
        echo "                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class=\"span4\">
        <div class=\"widget\">
            <div class=\"widget-header\"> <i class=\"icon-lock\"></i>
                <h3> Auto-Ban Settings</h3>
            </div>
            <div class=\"widget-content\">
                <table class=\"table table-striped table-bordered\">
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Mass requests (DDos)</td>
                        <td>
                            ";
        // line 269
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "auto_ban_ip_mass_requests") == true)) {
            // line 270
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 272
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 274
        echo "                        </td>
                    </tr>
                    <tr>
                        <td>Proxies & VPN</td>
                        <td>
                            ";
        // line 279
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "auto_ban_ip_proxies") == true)) {
            // line 280
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 282
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 284
        echo "                        </td>
                    </tr>
                    <tr>
                        <td>SQL Injections</td>
                        <td>
                            ";
        // line 289
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "auto_ban_ip_sql_injections") == true)) {
            // line 290
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 292
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 294
        echo "                        </td>
                    </tr>
                    <tr>
                        <td>XSS Attacks</td>
                        <td>
                            ";
        // line 299
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "auto_ban_ip_xss_attacks") == true)) {
            // line 300
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 302
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 304
        echo "                        </td>
                    </tr>
                    <tr>
                        <td>Spammers</td>
                        <td>
                            ";
        // line 309
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "auto_ban_ip_spammers") == true)) {
            // line 310
            echo "                                <span class=\"label label-success\">Active</span>
                            ";
        } else {
            // line 312
            echo "                                <span class=\"label label-important\">Inactive</span>
                            ";
        }
        // line 314
        echo "                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  448 => 314,  444 => 312,  440 => 310,  438 => 309,  431 => 304,  427 => 302,  423 => 300,  421 => 299,  414 => 294,  410 => 292,  406 => 290,  404 => 289,  397 => 284,  393 => 282,  389 => 280,  387 => 279,  380 => 274,  376 => 272,  372 => 270,  370 => 269,  343 => 244,  339 => 242,  335 => 240,  333 => 239,  326 => 234,  322 => 232,  318 => 230,  316 => 229,  309 => 224,  305 => 222,  301 => 220,  299 => 219,  292 => 214,  288 => 212,  284 => 210,  282 => 209,  275 => 204,  271 => 202,  267 => 200,  265 => 199,  238 => 174,  234 => 172,  230 => 170,  228 => 169,  221 => 164,  217 => 162,  213 => 160,  211 => 159,  204 => 154,  200 => 152,  196 => 150,  194 => 149,  187 => 144,  183 => 142,  179 => 140,  177 => 139,  170 => 134,  166 => 132,  162 => 130,  160 => 129,  131 => 103,  122 => 97,  113 => 91,  84 => 65,  75 => 59,  66 => 53,  45 => 34,  39 => 32,  37 => 31,  33 => 29,  30 => 28,  25 => 22,);
    }
}
