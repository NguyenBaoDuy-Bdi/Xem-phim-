<?php

/* log.html.twig */
class __TwigTemplate_830ad3994eb4d57d1f9927f104ddc41899bbffdaf1bf8b230e9f153f09021011 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("base_admin.html.twig");

        $this->blocks = array(
            'javascript' => array($this, 'block_javascript'),
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
        $context["menu"] = 2;
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 26
    public function block_javascript($context, array $blocks = array())
    {
        // line 27
        echo "    <script>
        \$(document).ready(function() {
            // Support for AJAX loaded modal window.
            // Focuses on first input text box after it loads the window
            \$('[data-type=\"modal\"]').click(function(e) {
                e.preventDefault();
                var url = \$(this).attr('href');
                if (url.indexOf('#') == 0) {
                    \$(url).modal('open');
                } else {
                    \$.get(url, function(data) {
                        \$('<div class=\"modal hide fade\">' + data + '</div>').modal();
                    }).success(function() {
//                                \$('input:text:visible:first').focus();
                            }
                    );
                }
            });
        });
    </script>
";
    }

    // line 52
    public function block_content($context, array $blocks = array())
    {
        // line 53
        echo "    <div class=\"span12\">
        ";
        // line 54
        if ((isset($context["msg"]) ? $context["msg"] : null)) {
            // line 55
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["msg"]) ? $context["msg"] : null), "display"), "html", null, true);
            echo "
        ";
        }
        // line 57
        echo "        <div class=\"widget\">
            <div class=\"widget-header\"> <i class=\"icon-list-alt\"></i>
                ";
        // line 59
        if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "type") == "proxy")) {
            // line 60
            echo "                    <h3> Proxy/VPN Log</h3>
                ";
        } elseif (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "type") == "spammer")) {
            // line 62
            echo "                    <h3> Spammer Log</h3>
                ";
        } elseif (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "type") == "mass_requests")) {
            // line 64
            echo "                    <h3> Mass requests/DDos Log</h3>
                ";
        } elseif (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "type") == "sql_injection")) {
            // line 66
            echo "                    <h3> SQL Injections Log</h3>
                ";
        } elseif (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "type") == "xss_attack")) {
            // line 68
            echo "                    <h3> XSS Attacks Log</h3>
                ";
        }
        // line 70
        echo "            </div>
            <!-- /widget-header -->
            <div class=\"widget-content page-tables\">
                ";
        // line 73
        if (((isset($context["logs"]) ? $context["logs"] : null) != false)) {
            // line 74
            echo "                    <table class=\"table table-striped table-bordered data-table\">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>IP</th>
                            ";
            // line 81
            echo "                            <th>Operating System</th>
                            <th>Browser</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        ";
            // line 88
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["logs"]) ? $context["logs"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
                // line 89
                echo "                            ";
                $context["custom_data"] = call_user_func_array($this->env->getFilter('unserialize')->getCallable(), array($this->getAttribute((isset($context["log"]) ? $context["log"] : null), "custom_data")));
                // line 90
                echo "                            <tr>
                                <td> ";
                // line 91
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["log"]) ? $context["log"] : null), "created_on"), "html", null, true);
                echo " </td>
                                <td> ";
                // line 92
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["log"]) ? $context["log"] : null), "type"), "html", null, true);
                echo " </td>
                                <td> ";
                // line 93
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["log"]) ? $context["log"] : null), "ip"), "html", null, true);
                echo " </td>
                                ";
                // line 95
                echo "                                <td> <img src=\"../templates/";
                echo twig_escape_filter($this->env, (isset($context["template_name"]) ? $context["template_name"] : null), "html", null, true);
                echo "/includes/data/img/os/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["custom_data"]) ? $context["custom_data"] : null), "personal"), "OS"), "code"), "html", null, true);
                echo ".png\"> ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["custom_data"]) ? $context["custom_data"] : null), "personal"), "OS"), "name"), "html", null, true);
                echo " </td>
                                <td> <img src=\"../templates/";
                // line 96
                echo twig_escape_filter($this->env, (isset($context["template_name"]) ? $context["template_name"] : null), "html", null, true);
                echo "/includes/data/img/browsers/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["custom_data"]) ? $context["custom_data"] : null), "personal"), "browser"), "code"), "html", null, true);
                echo ".png\"> ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["custom_data"]) ? $context["custom_data"] : null), "personal"), "browser"), "name"), "html", null, true);
                echo " </td>
                                <td> <img src=\"../templates/";
                // line 97
                echo twig_escape_filter($this->env, (isset($context["template_name"]) ? $context["template_name"] : null), "html", null, true);
                echo "/includes/data/img/flags/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["custom_data"]) ? $context["custom_data"] : null), "personal"), "location"), "code"), "html", null, true);
                echo ".png\"> ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["custom_data"]) ? $context["custom_data"] : null), "personal"), "location"), "name"), "html", null, true);
                echo " </td>
                                <td>
                                    ";
                // line 99
                if ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "type") == "mass_requests") && ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "fetch_log"), "detail") != "full"))) {
                    // line 100
                    echo "                                        <a href=\"log.php?type=";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "type"), "html", null, true);
                    echo "&details=";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["log"]) ? $context["log"] : null), "id"), "html", null, true);
                    echo "\" data-type=\"modal\" data-toggle=\"tooltip\" title=\"Show details\"><span class=\"icon icon-color icon-list-alt\"></span></a>
                                        <a href=\"log.php?type=";
                    // line 101
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "type"), "html", null, true);
                    echo "&detail=full&ip=";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["log"]) ? $context["log"] : null), "ip"), "html", null, true);
                    echo "\" data-toggle=\"tooltip\" title=\"Show full log for this ip\"><span class=\"icon icon-color icon-tasks\"></span></a>
                                    ";
                } elseif ((($this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "type") == "mass_requests") && ($this->getAttribute($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "fetch_log"), "detail") == "full"))) {
                    // line 103
                    echo "                                        <a href=\"log.php?type=";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "type"), "html", null, true);
                    echo "&details=";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["log"]) ? $context["log"] : null), "id"), "html", null, true);
                    echo "&detail=full&ip=";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["log"]) ? $context["log"] : null), "ip"), "html", null, true);
                    echo "\" data-type=\"modal\" data-toggle=\"tooltip\" title=\"Show details\"><span class=\"icon icon-color icon-list-alt\"></span></a>
                                    ";
                } else {
                    // line 105
                    echo "                                        <a href=\"log.php?type=";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "type"), "html", null, true);
                    echo "&details=";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["log"]) ? $context["log"] : null), "id"), "html", null, true);
                    echo "\" data-type=\"modal\" data-toggle=\"tooltip\" title=\"Show details\"><span class=\"icon icon-color icon-list-alt\"></span></a>
                                    ";
                }
                // line 107
                echo "                                    <a href=\"log.php?type=";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : null), "type"), "html", null, true);
                echo "&delete=";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["log"]) ? $context["log"] : null), "id"), "html", null, true);
                echo "\" data-toggle=\"tooltip\" title=\"Delete this entry from the log\"><span class=\"icon icon-color icon-remove\"></span></a>
                                </td>
                            </tr>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['log'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 111
            echo "                        </tbody>
                    </table>





































                    ";
            // line 151
            echo "                        ";
            // line 152
            echo "                            ";
            // line 153
            echo "                            ";
            // line 154
            echo "                                ";
            // line 155
            echo "                                ";
            // line 156
            echo "                                ";
            // line 157
            echo "                                ";
            // line 158
            echo "                            ";
            // line 159
            echo "                            ";
            // line 160
            echo "                            ";
            // line 161
            echo "                            ";
            // line 162
            echo "                                ";
            // line 163
            echo "                                    ";
            // line 164
            echo "                                    ";
            // line 165
            echo "                                    ";
            // line 166
            echo "                                    ";
            // line 167
            echo "                                        ";
            // line 168
            echo "                                    ";
            // line 169
            echo "                                ";
            // line 170
            echo "                            ";
            // line 171
            echo "                            ";
            // line 172
            echo "                        ";
            // line 173
            echo "                    ";
            // line 174
            echo "                        ";
            // line 175
            echo "                            ";
            // line 176
            echo "                            ";
            // line 177
            echo "                                ";
            // line 178
            echo "                                ";
            // line 179
            echo "                                ";
            // line 180
            echo "                                ";
            // line 181
            echo "                            ";
            // line 182
            echo "                            ";
            // line 183
            echo "                            ";
            // line 184
            echo "                            ";
            // line 185
            echo "                                ";
            // line 186
            echo "                                    ";
            // line 187
            echo "                                    ";
            // line 188
            echo "                                    ";
            // line 189
            echo "                                    ";
            // line 190
            echo "                                        ";
            // line 191
            echo "                                    ";
            // line 192
            echo "                                ";
            // line 193
            echo "                            ";
            // line 194
            echo "                            ";
            // line 195
            echo "                        ";
            // line 196
            echo "                    ";
            // line 197
            echo "                        ";
            // line 198
            echo "                        ";
            // line 199
            echo "                            ";
            // line 200
            echo "                                ";
            // line 201
            echo "                                ";
            // line 202
            echo "                                    ";
            // line 203
            echo "                                    ";
            // line 204
            echo "                                    ";
            // line 205
            echo "                                    ";
            // line 206
            echo "                                    ";
            // line 207
            echo "                                ";
            // line 208
            echo "                                ";
            // line 209
            echo "                                ";
            // line 210
            echo "                                ";
            // line 211
            echo "                                    ";
            // line 212
            echo "                                        ";
            // line 213
            echo "                                        ";
            // line 214
            echo "                                        ";
            // line 215
            echo "                                        ";
            // line 216
            echo "                                        ";
            // line 217
            echo "                                            ";
            // line 218
            echo "                                    ";
            // line 219
            echo "                                ";
            // line 220
            echo "                                ";
            // line 221
            echo "                            ";
            // line 222
            echo "                        ";
            // line 223
            echo "                        ";
            // line 224
            echo "                            ";
            // line 225
            echo "                                ";
            // line 226
            echo "                                ";
            // line 227
            echo "                                    ";
            // line 228
            echo "                                    ";
            // line 229
            echo "                                    ";
            // line 230
            echo "                                    ";
            // line 231
            echo "                                    ";
            // line 232
            echo "                                ";
            // line 233
            echo "                                ";
            // line 234
            echo "                                ";
            // line 235
            echo "                                    ";
            // line 236
            echo "                                        ";
            // line 237
            echo "                                            ";
            // line 238
            echo "                                            ";
            // line 239
            echo "                                            ";
            // line 240
            echo "                                            ";
            // line 241
            echo "                                            ";
            // line 242
            echo "                                                ";
            // line 243
            echo "                                                ";
            // line 244
            echo "                                            ";
            // line 245
            echo "                                        ";
            // line 246
            echo "                                    ";
            // line 247
            echo "                                ";
            // line 248
            echo "                            ";
            // line 249
            echo "                        ";
            // line 250
            echo "                    ";
            // line 251
            echo "                        ";
            // line 252
            echo "                            ";
            // line 253
            echo "                            ";
            // line 254
            echo "                                ";
            // line 255
            echo "                                ";
            // line 256
            echo "                                ";
            // line 257
            echo "                                ";
            // line 258
            echo "                                ";
            // line 259
            echo "                                ";
            // line 260
            echo "                                ";
            // line 261
            echo "                                ";
            // line 262
            echo "                            ";
            // line 263
            echo "                            ";
            // line 264
            echo "                            ";
            // line 265
            echo "                            ";
            // line 266
            echo "                                ";
            // line 267
            echo "                                ";
            // line 268
            echo "                                    ";
            // line 269
            echo "                                    ";
            // line 270
            echo "                                    ";
            // line 271
            echo "                                    ";
            // line 272
            echo "                                    ";
            // line 273
            echo "                                    ";
            // line 274
            echo "                                    ";
            // line 275
            echo "                                    ";
            // line 276
            echo "                                        ";
            // line 277
            echo "                                        ";
            // line 278
            echo "
                                    ";
            // line 280
            echo "                                ";
            // line 281
            echo "                            ";
            // line 282
            echo "                            ";
            // line 283
            echo "                        ";
            // line 284
            echo "                    ";
            // line 285
            echo "                        ";
            // line 286
            echo "                            ";
            // line 287
            echo "                            ";
            // line 288
            echo "                                ";
            // line 289
            echo "                                ";
            // line 290
            echo "                                ";
            // line 291
            echo "                                ";
            // line 292
            echo "                            ";
            // line 293
            echo "                            ";
            // line 294
            echo "                            ";
            // line 295
            echo "                            ";
            // line 296
            echo "                                ";
            // line 297
            echo "                                    ";
            // line 298
            echo "                                    ";
            // line 299
            echo "                                    ";
            // line 300
            echo "                                    ";
            // line 301
            echo "                                        ";
            // line 302
            echo "                                    ";
            // line 303
            echo "                                ";
            // line 304
            echo "                            ";
            // line 305
            echo "                            ";
            // line 306
            echo "                        ";
            // line 307
            echo "                    ";
            // line 308
            echo "                ";
        } else {
            // line 309
            echo "                    <div class=\"alert alert-success\">
                        <button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                        <strong>Look's good!</strong> There is nothing to worry about. The logs for the selected type are empty.
                    </div>
                ";
        }
        // line 314
        echo "            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "log.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  581 => 314,  574 => 309,  571 => 308,  569 => 307,  567 => 306,  565 => 305,  563 => 304,  561 => 303,  559 => 302,  557 => 301,  555 => 300,  553 => 299,  551 => 298,  549 => 297,  547 => 296,  545 => 295,  543 => 294,  541 => 293,  539 => 292,  537 => 291,  535 => 290,  533 => 289,  531 => 288,  529 => 287,  527 => 286,  525 => 285,  523 => 284,  521 => 283,  519 => 282,  517 => 281,  515 => 280,  512 => 278,  510 => 277,  508 => 276,  506 => 275,  504 => 274,  502 => 273,  500 => 272,  498 => 271,  496 => 270,  494 => 269,  492 => 268,  490 => 267,  488 => 266,  486 => 265,  484 => 264,  482 => 263,  480 => 262,  478 => 261,  476 => 260,  474 => 259,  472 => 258,  470 => 257,  468 => 256,  466 => 255,  464 => 254,  462 => 253,  460 => 252,  458 => 251,  456 => 250,  454 => 249,  452 => 248,  450 => 247,  448 => 246,  446 => 245,  444 => 244,  442 => 243,  440 => 242,  438 => 241,  436 => 240,  434 => 239,  432 => 238,  430 => 237,  428 => 236,  426 => 235,  424 => 234,  422 => 233,  420 => 232,  418 => 231,  416 => 230,  414 => 229,  412 => 228,  410 => 227,  408 => 226,  406 => 225,  404 => 224,  402 => 223,  400 => 222,  398 => 221,  396 => 220,  394 => 219,  392 => 218,  390 => 217,  388 => 216,  386 => 215,  384 => 214,  382 => 213,  380 => 212,  378 => 211,  376 => 210,  374 => 209,  372 => 208,  370 => 207,  368 => 206,  366 => 205,  364 => 204,  362 => 203,  360 => 202,  358 => 201,  356 => 200,  354 => 199,  352 => 198,  350 => 197,  348 => 196,  346 => 195,  344 => 194,  342 => 193,  340 => 192,  338 => 191,  336 => 190,  334 => 189,  332 => 188,  330 => 187,  328 => 186,  326 => 185,  324 => 184,  322 => 183,  320 => 182,  318 => 181,  316 => 180,  314 => 179,  312 => 178,  310 => 177,  308 => 176,  306 => 175,  304 => 174,  302 => 173,  300 => 172,  298 => 171,  296 => 170,  294 => 169,  292 => 168,  290 => 167,  288 => 166,  286 => 165,  284 => 164,  282 => 163,  280 => 162,  278 => 161,  276 => 160,  274 => 159,  272 => 158,  270 => 157,  268 => 156,  266 => 155,  264 => 154,  262 => 153,  260 => 152,  258 => 151,  217 => 111,  204 => 107,  196 => 105,  186 => 103,  179 => 101,  172 => 100,  170 => 99,  161 => 97,  153 => 96,  144 => 95,  140 => 93,  136 => 92,  132 => 91,  129 => 90,  126 => 89,  122 => 88,  113 => 81,  105 => 74,  103 => 73,  98 => 70,  94 => 68,  90 => 66,  86 => 64,  82 => 62,  78 => 60,  76 => 59,  72 => 57,  66 => 55,  64 => 54,  61 => 53,  58 => 52,  34 => 27,  31 => 26,  26 => 21,);
    }
}
