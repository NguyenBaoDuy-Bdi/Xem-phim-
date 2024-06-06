<?php

/* topbar_admin.html.twig */
class __TwigTemplate_63b9b9ff4b43a3705b6307ceddea0de8b188e41d58b88a654226417e7e10e348 extends Twig_Template
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
        return array (  88 => 59,  81 => 57,  74 => 55,  67 => 53,  52 => 43,  46 => 42,  28 => 27,  19 => 20,);
    }
}
