<?php

/* settings_protection.html.twig */
class __TwigTemplate_31b0eeea328415d3886e31948598bf7311a9a8a9478b939b0ec0067dc9809b49 extends Twig_Template
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
                        </ul>
                        <br>
                        <div class=\"tab-content\">
                            <div class=\"tab-pane active\" id=\"proxy\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Redirection URL</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span5\" name=\"redirect_proxies\" value=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "redirect_proxies"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Auto Ban for</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span1\" name=\"auto_ban_ip_proxies\" value=\"";
        // line 64
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
        // line 73
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
        // line 82
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
        // line 93
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "redirect_spammers"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Auto Ban for</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span1\" name=\"auto_ban_ip_spammers\" value=\"";
        // line 99
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
        // line 108
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
        // line 117
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
        // line 126
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
        // line 137
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "mass_requests_limit"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Redirection URL</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span5\" name=\"redirect_mass_requests\" value=\"";
        // line 143
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "redirect_mass_requests"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Auto Ban for</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span1\" name=\"auto_ban_ip_mass_requests\" value=\"";
        // line 149
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
        // line 158
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
        // line 167
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
        // line 178
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "redirect_sql_injections"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Auto Ban for</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span1\" name=\"auto_ban_ip_sql_injections\" value=\"";
        // line 184
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
        // line 193
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
        // line 202
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
        // line 213
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "redirect_xss_attacks"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Auto Ban for</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span1\" name=\"auto_ban_ip_xss_attacks\" value=\"";
        // line 219
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
        // line 228
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
        // line 237
        if (($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "log_xss_attacks") == 1)) {
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
        // line 263
        if ((($this->getAttribute((isset($context["application_config"]) ? $context["application_config"] : null), "cloudflare_api_key") == "") || ($this->getAttribute((isset($context["application_config"]) ? $context["application_config"] : null), "cloudflare_email") == ""))) {
            // line 264
            echo "                                    <div class=\" alert alert-warning\">
                                        <i class=\"icon-warning-sign\"></i>
                                        <strong>Warning!</strong> You have not configured your CloudFlare account at the <a href=\"settings_accounts.php\"><strong>accounts settings.</strong></a> You have to do this before you can edit the settings below.
                                    </div>
                                ";
        }
        // line 269
        echo "                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Sync Auto-Bans</label>
                                        <div class=\"controls\">
                                            <label class=\"checkbox inline\">
                                                <input type=\"hidden\" name=\"auto_ban_sync_with_cloudflare\" value=\"0\">
                                                <input type=\"checkbox\" name=\"auto_ban_sync_with_cloudflare\" value=\"1\" ";
        // line 275
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
        // line 284
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
        return array (  399 => 284,  381 => 275,  373 => 269,  366 => 264,  364 => 263,  333 => 237,  319 => 228,  307 => 219,  298 => 213,  282 => 202,  268 => 193,  256 => 184,  247 => 178,  231 => 167,  217 => 158,  205 => 149,  196 => 143,  187 => 137,  171 => 126,  157 => 117,  143 => 108,  131 => 99,  122 => 93,  106 => 82,  92 => 73,  80 => 64,  71 => 58,  44 => 33,  38 => 31,  36 => 30,  33 => 29,  30 => 28,  25 => 21,);
    }
}
