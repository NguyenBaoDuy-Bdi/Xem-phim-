<?php

/* base_login.html.twig */
class __TwigTemplate_e90a18b7f0e8490bafc5a23cc780cb072d456e5daa48cf33c4f83db05b7a5ab9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'content' => array($this, 'block_content'),
            'foot' => array($this, 'block_foot'),
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
        echo "
<!DOCTYPE html>
<html lang=\"en\">

";
        // line 41
        echo (isset($context["copyright"]) ? $context["copyright"] : null);
        echo "
<head>
    ";
        // line 43
        $this->env->loadTemplate("head.html.twig")->display($context);
        // line 44
        echo "
    ";
        // line 46
        echo "    ";
        $this->displayBlock('head', $context, $blocks);
        // line 47
        echo "</head>

<body>

";
        // line 52
        $this->displayBlock('content', $context, $blocks);
        // line 53
        echo "
";
        // line 55
        $this->displayBlock('foot', $context, $blocks);
        // line 56
        echo "

</body>
</html>";
    }

    // line 46
    public function block_head($context, array $blocks = array())
    {
    }

    // line 52
    public function block_content($context, array $blocks = array())
    {
    }

    // line 55
    public function block_foot($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "base_login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 55,  85 => 52,  80 => 46,  73 => 56,  71 => 55,  68 => 53,  66 => 52,  60 => 47,  57 => 46,  54 => 44,  47 => 41,  41 => 36,  25 => 21,  22 => 20,  92 => 64,  87 => 63,  84 => 62,  58 => 38,  52 => 43,  50 => 35,  43 => 30,  40 => 29,  33 => 25,  30 => 24,);
    }
}
