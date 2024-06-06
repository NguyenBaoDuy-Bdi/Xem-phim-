<?php

/* security_check.html.twig */
class __TwigTemplate_49f5f77fca5045884eab7989547a6c170ff2b37335b0e8f84ae5dcbade7c8afd extends Twig_Template
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
        $context["menu"] = 6;
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

    <div class=\"span12\">
        <div class=\"widget\">
            <div class=\"widget-header\"> <i class=\"icon-info-sign\"></i>
                <h3> PHP Security Check</h3>
            </div>
            <div class=\"widget-content\">
                <table class=\"table table-striped table-bordered span6\">
                    <thead>
                    <tr>
                        <th>Option</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td data-toggle=\"tooltip\" title=\"Some developers rely on this feature to 'prevent' injection based attacks. This is a major vulnerable.\">magic_quotes_gpc</td>
                        <td>
                            ";
        // line 53
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "magic_quotes_gpc") == true)) {
            // line 54
            echo "                                <span class=\"label label-important\">On</span>
                            ";
        } else {
            // line 56
            echo "                                <span class=\"label label-success\">Off</span>
                            ";
        }
        // line 58
        echo "                        </td>
                    </tr>
                    <tr>
                        <td data-toggle=\"tooltip\" title=\"Some developers rely on this feature to 'prevent' injection based attacks. This is a major vulnerable.\">magic_quotes_runtime</td>
                        <td>
                            ";
        // line 63
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "magic_quotes_runtime") == true)) {
            // line 64
            echo "                                <span class=\"label label-important\">On</span>
                            ";
        } else {
            // line 66
            echo "                                <span class=\"label label-success\">Off</span>
                            ";
        }
        // line 68
        echo "                        </td>
                    </tr>
                    <tr>
                        <td data-toggle=\"tooltip\" title=\"Some developers rely on this feature to 'prevent' injection based attacks. This is a major vulnerable.\">magic_quotes_sybase</td>
                        <td>
                            ";
        // line 73
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "magic_quotes_sybase") == true)) {
            // line 74
            echo "                                <span class=\"label label-important\">On</span>
                            ";
        } else {
            // line 76
            echo "                                <span class=\"label label-success\">Off</span>
                            ";
        }
        // line 78
        echo "                        </td>
                    </tr>
                    </tbody>
                </table>

                <table class=\"table table-striped table-bordered span5\">
                    <thead>
                        <tr>
                            <th>Option</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-toggle=\"tooltip\" title=\"Adds your PHP version to the response headers. This could be used for security exploits.\">expose_php</td>
                            <td>
                                ";
        // line 94
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "expose_php") == true)) {
            // line 95
            echo "                                    <span class=\"label label-warning\">On</span>
                                ";
        } else {
            // line 97
            echo "                                    <span class=\"label label-success\">Off</span>
                                ";
        }
        // line 99
        echo "                            </td>
                        </tr>
                        <tr>
                            <td data-toggle=\"tooltip\" title=\"Shows PHP errors to the client. This could be used for security exploits.\">display_errors</td>
                            <td>
                                ";
        // line 104
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "display_errors") == true)) {
            // line 105
            echo "                                    <span class=\"label label-important\">On</span>
                                ";
        } else {
            // line 107
            echo "                                    <span class=\"label label-success\">Off</span>
                                ";
        }
        // line 109
        echo "                            </td>
                        </tr>
                        <tr>
                            <td data-toggle=\"tooltip\" title=\"Shows PHP startup  sequence errors to the client. This could be used for security exploits.\">display_startup_errors</td>
                            <td>
                                ";
        // line 114
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "display_startup_errors") == true)) {
            // line 115
            echo "                                    <span class=\"label label-important\">On</span>
                                ";
        } else {
            // line 117
            echo "                                    <span class=\"label label-success\">Off</span>
                                ";
        }
        // line 119
        echo "                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class=\"table table-striped table-bordered span6\">
                    <thead>
                        <tr>
                            <th>Option</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-toggle=\"tooltip\" title=\"Allows attackers to take over bad coded applications with ease\">register_globals</td>
                            <td>
                                ";
        // line 135
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "register_globals") == true)) {
            // line 136
            echo "                                    <span class=\"label label-important\">On</span>
                                ";
        } else {
            // line 138
            echo "                                    <span class=\"label label-success\">Off</span>
                                ";
        }
        // line 140
        echo "                            </td>
                        </tr>
                        <tr>
                            <td data-toggle=\"tooltip\" title=\"File inclusion vulnerability\">allow_url_fopen</td>
                            <td>
                                ";
        // line 145
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "allow_url_fopen") == true)) {
            // line 146
            echo "                                    <span class=\"label label-important\">On</span>
                                ";
        } else {
            // line 148
            echo "                                    <span class=\"label label-success\">Off</span>
                                ";
        }
        // line 150
        echo "                            </td>
                        </tr>
                        <tr>
                            <td data-toggle=\"tooltip\" title=\"File inclusion vulnerability\">allow_url_include</td>
                            <td>
                                ";
        // line 155
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "allow_url_include") == true)) {
            // line 156
            echo "                                    <span class=\"label label-important\">On</span>
                                ";
        } else {
            // line 158
            echo "                                    <span class=\"label label-success\">Off</span>
                                ";
        }
        // line 160
        echo "                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class=\"table table-striped table-bordered span5\">
                    <thead>
                    <tr>
                        <th>Option</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td data-toggle=\"tooltip\" title=\"Allows attackers to execute commands on your server\">exec</td>
                        <td>
                            ";
        // line 176
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "exec") == true)) {
            // line 177
            echo "                                <span class=\"label label-important\">On</span>
                            ";
        } else {
            // line 179
            echo "                                <span class=\"label label-success\">Off</span>
                            ";
        }
        // line 181
        echo "                        </td>
                    </tr>
                    <tr>
                        <td data-toggle=\"tooltip\" title=\"Allows attackers to execute commands on your server\">shell_exec</td>
                        <td>
                            ";
        // line 186
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "shell_exec") == true)) {
            // line 187
            echo "                                <span class=\"label label-important\">On</span>
                            ";
        } else {
            // line 189
            echo "                                <span class=\"label label-success\">Off</span>
                            ";
        }
        // line 191
        echo "                        </td>
                    </tr>
                    <tr>
                        <td data-toggle=\"tooltip\" title=\"Allows attackers to execute commands on your server\">proc_open</td>
                        <td>
                            ";
        // line 196
        if (($this->getAttribute((isset($context["params"]) ? $context["params"] : null), "proc_open") == true)) {
            // line 197
            echo "                                <span class=\"label label-important\">On</span>
                            ";
        } else {
            // line 199
            echo "                                <span class=\"label label-success\">Off</span>
                            ";
        }
        // line 201
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
        return "security_check.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  296 => 201,  292 => 199,  288 => 197,  286 => 196,  279 => 191,  275 => 189,  271 => 187,  269 => 186,  262 => 181,  258 => 179,  254 => 177,  252 => 176,  234 => 160,  230 => 158,  226 => 156,  224 => 155,  217 => 150,  213 => 148,  209 => 146,  207 => 145,  200 => 140,  196 => 138,  192 => 136,  190 => 135,  172 => 119,  168 => 117,  164 => 115,  162 => 114,  155 => 109,  151 => 107,  147 => 105,  145 => 104,  138 => 99,  134 => 97,  130 => 95,  128 => 94,  110 => 78,  106 => 76,  102 => 74,  100 => 73,  93 => 68,  89 => 66,  85 => 64,  83 => 63,  76 => 58,  72 => 56,  68 => 54,  66 => 53,  45 => 34,  39 => 32,  37 => 31,  33 => 29,  30 => 28,  25 => 22,);
    }
}
