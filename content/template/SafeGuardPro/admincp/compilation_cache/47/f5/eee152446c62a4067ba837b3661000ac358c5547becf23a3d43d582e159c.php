<?php

/* edit_profile.html.twig */
class __TwigTemplate_47f5eee152446c62a4067ba837b3661000ac358c5547becf23a3d43d582e159c extends Twig_Template
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
                <h3> Account Settings</h3>
            </div>
            <!-- /widget-header -->
            <div class=\"widget-content\">
                <div class=\"tabbable\">
                    <form class=\"form-horizontal\" action=\"edit_profile.php\" method=\"post\">
                        <ul class=\"nav nav-tabs\">
                            <li class=\"active\"><a href=\"#general\" data-toggle=\"tab\">General</a></li>
                        </ul>
                        <br>
                        <div class=\"tab-content\">
                            <div class=\"tab-pane active\" id=\"general\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Username</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span6\" name=\"username\" value=\"";
        // line 51
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["session"]) ? $context["session"] : null), "gewora_safe_guard"), "username"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Password</label>
                                        <div class=\"controls\">
                                            <input type=\"password\" class=\"span6\" name=\"password1\" placeholder=\"Password\">
                                        </div>
                                    </div>
                                    <br />
                                    <div class=\"form-actions\">
                                        <input type=\"hidden\" name=\"update\">
                                        <button type=\"submit\" class=\"btn btn-primary\">Save</button>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "edit_profile.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 51,  44 => 33,  38 => 31,  36 => 30,  33 => 29,  30 => 28,  25 => 21,);
    }
}
