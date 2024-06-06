<?php

/* base_admin.html.twig */
class __TwigTemplate_3af20761c84cd7409fafb6cd5a883729ae4462dd57fe8abff2baac9d883855b0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'javascript' => array($this, 'block_javascript'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 20
        echo "
";
        // line 21
        $context["copyright"] = "
<!--
    Gewora - SafeGuard Pro

    Copyright 2014 Gewora - All rights reserved
    http://gewora.net

    See the license certificate for licensing information.

    You are NOT allowed to remove, edit or change
    this copyright information or it's position.

    Any infringement of this copyright will
    result in legal action by the holder.
-->";
        // line 36
        echo "<!DOCTYPE html>
<html lang=\"en\">

";
        // line 40
        echo (isset($context["copyright"]) ? $context["copyright"] : null);
        echo "
<head>
    ";
        // line 42
        $this->env->loadTemplate("head_admin.html.twig")->display($context);
        // line 43
        echo "</head>

<body>
    <div id=\"wrap\">
        ";
        // line 48
        echo "        ";
        $this->env->loadTemplate("topbar_admin.html.twig")->display($context);
        // line 49
        echo "
        <div class=\"main\" id=\"main\">
            <div class=\"container\">
                <div class=\"row\">
                    ";
        // line 54
        echo "                    ";
        $this->displayBlock('content', $context, $blocks);
        // line 55
        echo "                </div>
            </div>
        </div>
    </div>

    ";
        // line 61
        echo "    ";
        $this->env->loadTemplate("foot_admin.html.twig")->display($context);
        // line 62
        echo "
    ";
        // line 64
        echo "    ";
        $this->displayBlock('javascript', $context, $blocks);
        // line 65
        echo "</body>
</html>";
    }

    // line 54
    public function block_content($context, array $blocks = array())
    {
    }

    // line 64
    public function block_javascript($context, array $blocks = array())
    {
        echo " ";
    }

    public function getTemplateName()
    {
        return "base_admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 64,  91 => 54,  86 => 65,  83 => 64,  80 => 62,  77 => 61,  70 => 55,  67 => 54,  61 => 49,  58 => 48,  52 => 43,  50 => 42,  40 => 36,  24 => 21,  21 => 20,  448 => 314,  444 => 312,  440 => 310,  438 => 309,  431 => 304,  427 => 302,  423 => 300,  421 => 299,  414 => 294,  410 => 292,  406 => 290,  404 => 289,  397 => 284,  393 => 282,  389 => 280,  387 => 279,  380 => 274,  376 => 272,  372 => 270,  370 => 269,  343 => 244,  339 => 242,  335 => 240,  333 => 239,  326 => 234,  322 => 232,  318 => 230,  316 => 229,  309 => 224,  305 => 222,  301 => 220,  299 => 219,  292 => 214,  288 => 212,  284 => 210,  282 => 209,  275 => 204,  271 => 202,  267 => 200,  265 => 199,  238 => 174,  234 => 172,  230 => 170,  228 => 169,  221 => 164,  217 => 162,  213 => 160,  211 => 159,  204 => 154,  200 => 152,  196 => 150,  194 => 149,  187 => 144,  183 => 142,  179 => 140,  177 => 139,  170 => 134,  166 => 132,  162 => 130,  160 => 129,  131 => 103,  122 => 97,  113 => 91,  84 => 65,  75 => 59,  66 => 53,  45 => 40,  39 => 32,  37 => 31,  33 => 29,  30 => 28,  25 => 22,);
    }
}
