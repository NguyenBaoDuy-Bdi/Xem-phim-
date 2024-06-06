<?php

/* settings_protection.html.twig */
class __TwigTemplate_05c240160f054639dc2d1f03c16eae503a8bf43a5cc60f1dc06204e406d3d2ea extends Twig_Template
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
        // line 21
        $context["menu"] = 3;
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 28
    public function block_content($context, array $blocks = array())
    {
        // line 29
        echo "    <div class=\"span12\">
        ";
        // line 30
        if ((isset($context["msg"]) ? $context["msg"] : null)) {
            // line 31
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["msg"]) ? $context["msg"] : null), "display"), "html", null, true);
            echo "
        ";
        }
        // line 33
        echo "    </div>

    <form class=\"form-horizontal\" action=\"settings_protection.php\" method=\"post\">
        <div class=\"span7\">
            <div class=\"widget\">
                <div class=\"widget-header\"> <i class=\"icon-list-alt\"></i>
                    <h3> Protection</h3>
                </div>
                <!-- /widget-header -->
                <div class=\"widget-content\">
                    <div class=\"tabbable\">
                        <ul class=\"nav nav-tabs\">
                            <li class=\"active\"><a href=\"#proxy\" data-toggle=\"tab\">Proxy VPN</a></li>
                            <li><a href=\"#spammer\" data-toggle=\"tab\">Spammer & Search Engines</a></li>
                            <li><a href=\"#mass_request\" data-toggle=\"tab\">Mass requests</a></li>
                            <li><a href=\"#sql_injection\" data-toggle=\"tab\">SQL injection</a></li>
                            <li><a href=\"#xss_attack\" data-toggle=\"tab\">XSS attack</a></li>
                            <li><a href=\"#banned\" data-toggle=\"tab\">Banned access</a></li>
                        </ul>
                        <br>
                        <div class=\"tab-content\">
                            <div class=\"tab-pane active\" id=\"proxy\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Redirection URL</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span5\" name=\"redirect_proxies\" value=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "redirect_proxies"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Auto Ban for</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span1\" name=\"auto_ban_ip_proxies\" value=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "auto_ban_ip_proxies"), "html", null, true);
        echo "\">
                                            <span>&nbsp;Minutes</span>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\"> Enable protection</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"protection_proxies\" value=\"0\">
                                                <input type=\"checkbox\" name=\"protection_proxies\" value=\"1\" ";
        // line 74
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "protection_proxies") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\"> Enable logging</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"log_proxies\" value=\"0\">
                                                <input type=\"checkbox\" name=\"log_proxies\" value=\"1\" ";
        // line 83
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "log_proxies") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class=\"tab-pane\" id=\"spammer\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Redirection URL</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span5\" name=\"redirect_spammers\" value=\"";
        // line 94
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "redirect_spammers"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Auto Ban for</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span1\" name=\"auto_ban_ip_spammers\" value=\"";
        // line 100
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "auto_ban_ip_spammers"), "html", null, true);
        echo "\">
                                            <span>&nbsp;Minutes</span>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Block search engines</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"block_search_engines\" value=\"0\">
                                                <input type=\"checkbox\" name=\"block_search_engines\" value=\"1\" ";
        // line 109
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "block_search_engines") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Enable protection</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"protection_spammers\" value=\"0\">
                                                <input type=\"checkbox\" name=\"protection_spammers\" value=\"1\" ";
        // line 118
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "protection_spammers") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Enable logging</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"log_spammers\" value=\"0\">
                                                <input type=\"checkbox\" name=\"log_spammers\" value=\"1\" ";
        // line 127
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "log_spammers") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class=\"tab-pane\" id=\"mass_request\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Maximum requests per second</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span2\" name=\"mass_requests_limit\" value=\"";
        // line 138
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "mass_requests_limit"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Redirection URL</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span5\" name=\"redirect_mass_requests\" value=\"";
        // line 144
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "redirect_mass_requests"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Auto Ban for</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span1\" name=\"auto_ban_ip_mass_requests\" value=\"";
        // line 150
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "auto_ban_ip_mass_requests"), "html", null, true);
        echo "\">
                                            <span>&nbsp;Minutes</span>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Enable protection</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"protection_mass_requests\" value=\"0\">
                                                <input type=\"checkbox\" name=\"protection_mass_requests\" value=\"1\" ";
        // line 159
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "protection_mass_requests") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Enable logging</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"log_mass_requests\" value=\"0\">
                                                <input type=\"checkbox\" name=\"log_mass_requests\" value=\"1\" ";
        // line 168
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "log_mass_requests") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class=\"tab-pane\" id=\"sql_injection\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Redirection URL</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span5\" name=\"redirect_sql_injections\" value=\"";
        // line 179
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "redirect_sql_injections"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Auto Ban for</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span1\" name=\"auto_ban_ip_sql_injections\" value=\"";
        // line 185
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "auto_ban_ip_sql_injections"), "html", null, true);
        echo "\">
                                            <span>&nbsp;Minutes</span>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Enable protection</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"protection_sql_injections\" value=\"0\">
                                                <input type=\"checkbox\" name=\"protection_sql_injections\" value=\"1\" ";
        // line 194
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "protection_sql_injections") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Enable logging</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"log_sql_injections\" value=\"0\">
                                                <input type=\"checkbox\" name=\"log_sql_injections\" value=\"1\" ";
        // line 203
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "log_sql_injections") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class=\"tab-pane\" id=\"xss_attack\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Redirection URL</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span5\" name=\"redirect_xss_attacks\" value=\"";
        // line 214
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "redirect_xss_attacks"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Auto Ban for</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span1\" name=\"auto_ban_ip_xss_attacks\" value=\"";
        // line 220
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "auto_ban_ip_xss_attacks"), "html", null, true);
        echo "\">
                                            <span>&nbsp;Minutes</span>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Enable protection</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"protection_xss_attacks\" value=\"0\">
                                                <input type=\"checkbox\" name=\"protection_xss_attacks\" value=\"1\" ";
        // line 229
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "protection_xss_attacks") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Enable logging</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"log_xss_attacks\" value=\"0\">
                                                <input type=\"checkbox\" name=\"log_xss_attacks\" value=\"1\" ";
        // line 238
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "log_xss_attacks") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class=\"tab-pane\" id=\"banned\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Redirection URL</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span5\" name=\"redirect_banned\" value=\"";
        // line 249
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "redirect_banned"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"span5\">
            <div class=\"widget\">
                <div class=\"widget-header\"> <i class=\"icon-list-alt\"></i>
                    <h3> Additional Features</h3>
                </div>
                <!-- /widget-header -->
                <div class=\"widget-content\">
                    <div class=\"tabbable\">
                        <ul class=\"nav nav-tabs\">
                            <li class=\"active\"><a href=\"#cloudflare\" data-toggle=\"tab\">Cloudflare</a></li>
                        </ul>
                        <br>
                        <div class=\"tab-content\">
                            <div class=\"tab-pane active\" id=\"cloudflare\">
                                ";
        // line 274
        if ((($this->getAttribute((isset($context["application_config"]) ? $context["application_config"] : null), "cloudflare_api_key") == "") || ($this->getAttribute((isset($context["application_config"]) ? $context["application_config"] : null), "cloudflare_email") == ""))) {
            // line 275
            echo "                                    <div class=\" alert alert-warning\">
                                        <i class=\"icon-warning-sign\"></i>
                                        <strong>Warning!</strong> You have not configured your CloudFlare account at the <a href=\"settings_accounts.php\"><strong>accounts settings.</strong></a> You have to do this before you can edit the settings below.
                                    </div>
                                ";
        }
        // line 280
        echo "                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Sync Auto-Bans</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"auto_ban_sync_with_cloudflare\" value=\"0\">
                                                <input type=\"checkbox\" name=\"auto_ban_sync_with_cloudflare\" value=\"1\" ";
        // line 286
        if ((($this->getAttribute((isset($context["application_config"]) ? $context["application_config"] : null), "cloudflare_api_key") == "") || ($this->getAttribute((isset($context["application_config"]) ? $context["application_config"] : null), "cloudflare_email") == ""))) {
            echo "disabled ";
        }
        echo " ";
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "auto_ban_sync_with_cloudflare") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Sync Bans</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"ban_ip_sync_with_cloudflare\" value=\"0\">
                                                <input type=\"checkbox\" name=\"ban_ip_sync_with_cloudflare\" value=\"1\" ";
        // line 295
        if ((($this->getAttribute((isset($context["application_config"]) ? $context["application_config"] : null), "cloudflare_api_key") == "") || ($this->getAttribute((isset($context["application_config"]) ? $context["application_config"] : null), "cloudflare_email") == ""))) {
            echo "disabled ";
        }
        echo " ";
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "ban_ip_sync_with_cloudflare") == 1)) {
            echo "checked";
        }
        echo ">
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"span12\">
            <div class=\"form-actions well-large\">
                <input type=\"hidden\" name=\"update\">
                <button type=\"submit\" class=\"btn btn-primary\">Save settings</button>
            </div>
        </div>
    </form>
";
    }

    public function getTemplateName()
    {
        return "settings_protection.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  413 => 295,  395 => 286,  387 => 280,  380 => 275,  378 => 274,  350 => 249,  334 => 238,  320 => 229,  308 => 220,  299 => 214,  283 => 203,  269 => 194,  257 => 185,  248 => 179,  232 => 168,  218 => 159,  206 => 150,  197 => 144,  188 => 138,  172 => 127,  158 => 118,  144 => 109,  132 => 100,  123 => 94,  107 => 83,  93 => 74,  81 => 65,  72 => 59,  44 => 33,  38 => 31,  36 => 30,  33 => 29,  30 => 28,  25 => 21,);
    }
}
