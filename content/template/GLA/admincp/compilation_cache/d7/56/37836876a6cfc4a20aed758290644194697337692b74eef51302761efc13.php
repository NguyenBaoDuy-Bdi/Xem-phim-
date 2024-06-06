<?php

/* tools.html.twig */
class __TwigTemplate_d75637836876a6cfc4a20aed758290644194697337692b74eef51302761efc13 extends Twig_Template
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
        $context["menu"] = 5;
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
            <div class=\"widget-header\"> <i class=\"icon-tasks\"></i>
                <h3> Tools</h3>
            </div>
            <!-- /widget-header -->
            <div class=\"widget-content\">
                <div class=\"tabbable\">
                    <form class=\"form-horizontal\" action=\"tools.php\" method=\"post\">
                        <ul class=\"nav nav-tabs\">
                            <li class=\"active\"><a href=\"#hashing\" data-toggle=\"tab\">Hashing</a></li>
                            <li><a href=\"#password_generator\" data-toggle=\"tab\">Password Generator</a></li>
                        </ul>
                        <br>
                        <div class=\"tab-content\">
                            <div class=\"tab-pane active\" id=\"hashing\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">String</label>
                                        <div class=\"controls\">
                                            <input type=\"text\" class=\"span4\" name=\"hash_string\" value=\"";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "hashed"), "html", null, true);
        echo "\">
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Algorithm</label>
                                        <div class=\"controls\">
                                            <select name=\"hash_algorithm\">
                                                <option value=\"whirlpool\">Whirlpool</option>
                                                <option value=\"sha512\">SHA 512</option>
                                                <option value=\"sha256\">SHA 256</option>
                                                <option value=\"md5\">MD5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Iterations</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span1\" name=\"hash_iterations\" value=\"1\">
                                        </div>
                                    </div>
                                    <br />
                                    <div class=\"form-actions\">
                                        <button type=\"submit\" name=\"hash\" class=\"btn btn-primary\">Hash</button>
                                    </div>
                                </fieldset>
                            </div>
                            <div class=\"tab-pane\" id=\"password_generator\">
                                <fieldset>
                                    <div class=\"control-group\">
                                        <label class=\"control-label\">Length</label>
                                        <div class=\"controls\">
                                            <input type=\"number\" class=\"span1\" name=\"password_length\" value=\"8\">
                                        </div>
                                    </div>

                                    ";
        // line 87
        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "password")) {
            // line 88
            echo "                                        <div class=\"control-group\">
                                            <label class=\"control-label\">Password</label>
                                            <div class=\"controls\">
                                                <input type=\"text\" class=\"span4\" value=\"";
            // line 91
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "password"), "html", null, true);
            echo "\">
                                            </div>
                                        </div>
                                    ";
        }
        // line 95
        echo "

                                    <br />
                                    <div class=\"form-actions\">
                                        <button type=\"submit\" name=\"generate_password\" class=\"btn btn-primary\">Generate Password</button>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <input type=\"hidden\" name=\"submit\">
                    </form>
                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "tools.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 95,  110 => 91,  105 => 88,  103 => 87,  65 => 52,  44 => 33,  38 => 31,  36 => 30,  33 => 29,  30 => 28,  25 => 21,);
    }
}
