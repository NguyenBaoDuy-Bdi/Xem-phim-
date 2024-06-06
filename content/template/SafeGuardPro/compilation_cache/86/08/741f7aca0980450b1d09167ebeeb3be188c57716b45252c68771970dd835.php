<?php

/* login.html.twig */
class __TwigTemplate_8608741f7aca0980450b1d09167ebeeb3be188c57716b45252c68771970dd835 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base_login.html.twig");

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'content' => array($this, 'block_content'),
            'foot' => array($this, 'block_foot'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base_login.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 24
    public function block_head($context, array $blocks = array())
    {
        // line 25
        echo "    <link href=\"./templates/";
        echo twig_escape_filter($this->env, (isset($context["template_name"]) ? $context["template_name"] : null), "html", null, true);
        echo "/includes/data/css/pages/signin.css\" rel=\"stylesheet\">
";
    }

    // line 29
    public function block_content($context, array $blocks = array())
    {
        // line 30
        echo "    <div class=\"account-container\">
        <div class=\"content clearfix\">
            <form action=\"login.php\" method=\"post\">
                <h1>Member Login</h1>
                <div class=\"login-fields\">
                    ";
        // line 35
        if ((isset($context["msg"]) ? $context["msg"] : null)) {
            // line 36
            echo "                        ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["msg"]) ? $context["msg"] : null), "display"), "html", null, true);
            echo "
                    ";
        }
        // line 38
        echo "                    <p>Please provide your details</p>

                    <div class=\"field\">
                        <label for=\"username\">Username</label>
                        <input type=\"text\" id=\"username\" name=\"username\" placeholder=\"Username\" class=\"login username-field\" required/>
                    </div>

                    <div class=\"field\">
                        <label for=\"password\">Password:</label>
                        <input type=\"password\" id=\"password\" name=\"password\" placeholder=\"Password\" class=\"login password-field\" required/>
                    </div>
                </div>

                <div class=\"login-actions\">
                    <input type=\"hidden\" name=\"login\">
                    <button class=\"button btn btn-success btn-large\">Sign In</button>
                </div>
            </form>

        </div> <!-- /content -->

    </div> <!-- /account-container -->
";
    }

    // line 62
    public function block_foot($context, array $blocks = array())
    {
        // line 63
        echo "    <script src=\"./templates/";
        echo twig_escape_filter($this->env, (isset($context["template_name"]) ? $context["template_name"] : null), "html", null, true);
        echo "/includes/data/js/jquery-1.7.2.min.js\"></script>
    <script src=\"./templates/";
        // line 64
        echo twig_escape_filter($this->env, (isset($context["template_name"]) ? $context["template_name"] : null), "html", null, true);
        echo "/includes/data/js/bootstrap.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 64,  87 => 63,  84 => 62,  58 => 38,  52 => 36,  50 => 35,  43 => 30,  40 => 29,  33 => 25,  30 => 24,);
    }
}
