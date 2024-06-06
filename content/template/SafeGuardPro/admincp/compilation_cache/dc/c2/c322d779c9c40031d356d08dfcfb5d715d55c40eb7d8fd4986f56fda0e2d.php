<?php

/* topbar_admin.html.twig */
class __TwigTemplate_dcc2c322d779c9c40031d356d08dfcfb5d715d55c40eb7d8fd4986f56fda0e2d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 20
        echo "<div id=\"header\">
    <div class=\"navbar navbar-fixed-top\">
        <div class=\"navbar-inner\">
            <div class=\"container\"> <a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\"><span
                            class=\"icon-bar\"></span><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span> </a><a class=\"brand\" href=\"dashboard.php\">Gewora - SafeGuard Pro</a>
                <div class=\"nav-collapse\">
                    <ul class=\"nav pull-right\">
                        <li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"icon-user\"></i> ";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["session"]) ? $context["session"] : null), "gewora_safe_guard"), "username"), "html", null, true);
        echo " <b class=\"caret\"></b></a>
                            <ul class=\"dropdown-menu\">
                                <li><a href=\"edit_profile.php\">Profile</a></li>
                                <li><a href=\"../logout.php\">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class=\"subnavbar\">
        <div class=\"subnavbar-inner\">
            <div class=\"container\">
                <ul class=\"mainnav\">
                    <li ";
        // line 42
        if (((isset($context["menu"]) ? $context["menu"] : null) == 1)) {
            echo "class=\"active\"";
        }
        echo "><a href=\"dashboard.php\"><i class=\"icon-dashboard\"></i><span>Dashboard</span> </a> </li>
                    <li class=\"dropdown ";
        // line 43
        if (((isset($context["menu"]) ? $context["menu"] : null) == 2)) {
            echo "active";
        }
        echo "\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"> <i class=\"icon-long-arrow-down\"></i><span>Logs</span> <b class=\"caret\"></b></a>
                        <ul class=\"dropdown-menu\">
                            <li><a href=\"log.php?type=proxy\">Proxy/VPN</a></li>
                            <li><a href=\"log.php?type=spammer\">Spammer</a></li>
                            <li><a href=\"log.php?type=mass_requests\">Mass requests</a></li>
                            <li><a href=\"log.php?type=sql_injection\">SQL Injections</a></li>
                            <li><a href=\"log.php?type=xss_attack\">XSS Attacks</a></li>
                        </ul>
                    </li>

                    <li ";
        // line 53
        if (((isset($context["menu"]) ? $context["menu"] : null) == 4)) {
            echo "class=\"active\"";
        }
        echo "><a href=\"ban.php\"> <i class=\"icon-lock\"></i><span>Bans</span> <b class=\"caret\"></b></a></li>

                    <li ";
        // line 55
        if (((isset($context["menu"]) ? $context["menu"] : null) == 6)) {
            echo "class=\"active\"";
        }
        echo "><a href=\"security_check.php\"><i class=\"icon-eye-open\"></i><span>Security Check</span> </a> </li>

                    <li ";
        // line 57
        if (((isset($context["menu"]) ? $context["menu"] : null) == 5)) {
            echo "class=\"active\"";
        }
        echo "><a href=\"tools.php\"><i class=\"icon-tasks\"></i><span>Tools</span> </a> </li>

                    <li class=\"dropdown ";
        // line 59
        if (((isset($context["menu"]) ? $context["menu"] : null) == 3)) {
            echo "active";
        }
        echo "\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"> <i class=\"icon-cog\"></i><span>Settings</span> <b class=\"caret\"></b></a>
                        <ul class=\"dropdown-menu\">
                            <li><a href=\"settings_protection.php\">Protection</a></li>
                            <li><a href=\"settings_accounts.php\">Accounts</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "topbar_admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 59,  81 => 57,  74 => 55,  46 => 42,  28 => 27,  56 => 34,  48 => 32,  44 => 31,  35 => 28,  31 => 27,  27 => 26,  19 => 20,  96 => 64,  91 => 54,  86 => 65,  83 => 64,  80 => 62,  77 => 61,  70 => 55,  67 => 53,  61 => 49,  58 => 48,  52 => 43,  50 => 42,  40 => 30,  24 => 21,  21 => 20,  448 => 314,  444 => 312,  440 => 310,  438 => 309,  431 => 304,  427 => 302,  423 => 300,  421 => 299,  414 => 294,  410 => 292,  406 => 290,  404 => 289,  397 => 284,  393 => 282,  389 => 280,  387 => 279,  380 => 274,  376 => 272,  372 => 270,  370 => 269,  343 => 244,  339 => 242,  335 => 240,  333 => 239,  326 => 234,  322 => 232,  318 => 230,  316 => 229,  309 => 224,  305 => 222,  301 => 220,  299 => 219,  292 => 214,  288 => 212,  284 => 210,  282 => 209,  275 => 204,  271 => 202,  267 => 200,  265 => 199,  238 => 174,  234 => 172,  230 => 170,  228 => 169,  221 => 164,  217 => 162,  213 => 160,  211 => 159,  204 => 154,  200 => 152,  196 => 150,  194 => 149,  187 => 144,  183 => 142,  179 => 140,  177 => 139,  170 => 134,  166 => 132,  162 => 130,  160 => 129,  131 => 103,  122 => 97,  113 => 91,  84 => 65,  75 => 59,  66 => 53,  45 => 40,  39 => 32,  37 => 31,  33 => 29,  30 => 28,  25 => 22,);
    }
}
