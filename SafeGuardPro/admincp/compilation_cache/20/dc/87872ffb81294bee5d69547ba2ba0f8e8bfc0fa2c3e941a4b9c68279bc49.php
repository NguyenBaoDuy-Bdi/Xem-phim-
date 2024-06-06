<?php

/* settings_accounts.html.twig */
class __TwigTemplate_20dc87872ffb81294bee5d69547ba2ba0f8e8bfc0fa2c3e941a4b9c68279bc49 extends Twig_Template
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
        echo "        <div class=\"widget\">
            <div class=\"widget-header\"> <i class=\"icon-user\"></i>
                <h3> Accounts</h3>
            </div>
            <!-- /widget-header -->
            <div class=\"widget-content\">
                <div class=\"tabbable\">
                    <form class=\"form-horizontal\" action=\"settings_accounts.php\" method=\"post\">
                        <ul class=\"nav nav-tabs\">
                            <li class=\"active\"><a href=\"#project_honeypot\" data-toggle=\"tab\">Project Honeypot</a></li>
                            <li><a href=\"#cloudflare\" data-toggle=\"tab\">Cloudflare</a></li>
                        </ul>
                        <br>
                        <div class=\"tab-content\">
                            <div class=\"tab-pane active\" id=\"project_honeypot\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">API Key</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span4\" name=\"project_honeypot_api_key\" value=\"";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "project_honeypot_api_key"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <br />
                                    <div class=\"form-actions\">
                                        <button type=\"submit\" class=\"btn btn-primary\">Save</button>
                                    </div>
                                </fieldset>
                            </div>
                            <div class=\"tab-pane\" id=\"cloudflare\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">API Key</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span4\" name=\"cloudflare_api_key\" value=\"";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "cloudflare_api_key"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">E-Mail</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span4\" name=\"cloudflare_email\" value=\"";
        // line 72
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["config"]) ? $context["config"] : null), "cloudflare_email"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <br />
                                    <div class=\"form-actions\">
                                        <button type=\"submit\" class=\"btn btn-primary\">Save</button>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <input type=\"hidden\" name=\"update\">
                    </form>
                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "settings_accounts.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 72,  82 => 66,  65 => 52,  44 => 33,  38 => 31,  36 => 30,  33 => 29,  30 => 28,  25 => 21,);
    }
}
