<?php

/* /usr/share/nginx/html/themes/demo/pages/post-preview.htm */
class __TwigTemplate_857ae07d0e513401be5b27aa81cac980346dd495ce1dd5b23e35bc5a01892662 extends Twig_Template
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
        // line 1
        echo "<div style=\"min-height: 69%\" id=\"main\">
    <div class=\"container\"  style=\"padding-top: 0px\">
        <div class=\"main-content row\"  style=\"margin-top: 0px\">
            <div class=\"col-sm-8 parent-post-main\"\">
            <div class=\"post-main\">
                <h3 class=\"title\"></h3>

                <div class=\"post-extra\">

                    <div class=\"tag-list col-md-8\">

                    </div>
                    <div class=\"col-md-4 timestamp\">
                        <span class=\"date\"><i class=\"ico-calendar-full\"></i> ";
        // line 14
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y.m.d"), "html", null, true);
        echo "</span>
                        <span class=\"time\"><i class=\"ico-clock2\"></i> ";
        // line 15
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "H.i"), "html", null, true);
        echo "</span>
                    </div>

                </div>

                <img src=\"\" alt=\"\">

                ";
        // line 22
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['post'] = ($context["post"] ?? null)        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/social"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 23
        echo "
                <div class=\"clearfix\"></div>

                <div class=\"post-content fr-view\"></div>

                <div class=\"pull-left\">
                    <a class=\"back-btn\">バック</a>
                </div>

                ";
        // line 32
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['post'] = ($context["post"] ?? null)        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/social"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 33
        echo "
            </div>
            <div class=\"row\">
                <div class=\"col-sm-12\">
                    <fieldset>
                        <div class=\"form-group\">
                            <input class=\"form-control\" placeholder=\"名前\" type=\"text\" maxlength=\"64\">
                        </div>
                        <div class=\"form-group\">
                            <input class=\"form-control\" placeholder=\"電子メール\" type=\"text\" maxlength=\"64\">
                        </div>
                        <div class=\"form-group\">
                            <textarea class=\"form-control\" placeholder=\"内容\" rows=\"5\"></textarea>
                        </div>
                    </fieldset>
                    <button disabled class=\"btn btn-primary\"><i class=\"fa fa-save\"></i>&nbsp;&nbsp;&nbsp;&nbsp;保存&nbsp;&nbsp;&nbsp;&nbsp;</button>
                    <button disabled type=\"reset\" class=\"btn btn-default\">リセット</button>
                </div>
            </div>
            <div style=\"padding: 5px;\"></div>
        </div>
        <div class=\"col-sm-4\">
            <div class=\"sidebar side_2\" style=\"padding-top: 40px\">

                ";
        // line 57
        if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["siteBar"] ?? null), "count", array())) {
            // line 58
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["siteBar"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["bar"]) {
                // line 59
                echo "                <div class=\"sidebar-block post-popular\" ";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "type", array()) == 3)) {
                    echo " style=\"padding: 0px !important; box-shadow: 0px 0px 0px 0px #bbb !important;\" ";
                }
                echo ">
                    ";
                // line 60
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "type", array()) != 3)) {
                    // line 61
                    echo "                    <h3 class=\"sidebar-title\" style=\"color:#ffffff;\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "name", array()), "html", null, true);
                    echo "</h3>
                    ";
                }
                // line 63
                echo "                    <!--if bar is banner-->
                    ";
                // line 64
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "type", array()) == 3)) {
                    // line 65
                    echo "                    <a href=\"javascript:;\">
                        <img class=\"img-responsive\" src=\"";
                    // line 66
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "banner_image", array()), "path", array()), "html", null, true);
                    echo "\" alt=\"\">
                    </a>
                    <!--if bar is banner-->
                    ";
                } else {
                    // line 70
                    echo "                    ";
                    $context["posts"] = twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogPosts"] ?? null), "getSiteBar", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "content_type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "type", array())), "method");
                    // line 71
                    echo "                    ";
                    if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "count", array())) {
                        // line 72
                        echo "                    <ul class=\"popular-list\">
                        ";
                        // line 73
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(($context["posts"] ?? null));
                        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                            // line 74
                            echo "                        <li>
                            <a href=\"javascript:;\">
                                <img src=\"";
                            // line 76
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "featured_image", array()), "path", array()), "html", null, true);
                            echo "\" alt=\"\">
                                <div class=\"desc\">
                                    <p style=\"word-break: normal\">";
                            // line 78
                            echo call_user_func_array($this->env->getFunction('str_limit')->getCallable(), array("limit", twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "title", array()), 40));
                            echo "</p>
                                    <small>
                                        <span class=\"date\"><i class=\"ico-calendar-31\"></i>";
                            // line 80
                            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "published_at", array()), "Y.m.d"), "html", null, true);
                            echo "</span>
                                        ";
                            // line 81
                            if (twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "count_view", array())) {
                                // line 82
                                echo "                                        <span class=\"\"><i class=\"ico-graph\"></i>";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "count_view", array()), "html", null, true);
                                echo "</span>
                                        ";
                            }
                            // line 84
                            echo "                                    </small>
                                </div>
                            </a>
                        </li>
                        ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 89
                        echo "                    </ul>
                    ";
                    }
                    // line 91
                    echo "                    ";
                }
                // line 92
                echo "                </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bar'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 94
            echo "                ";
        }
        // line 95
        echo "            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/usr/share/nginx/html/themes/demo/pages/post-preview.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  198 => 95,  195 => 94,  188 => 92,  185 => 91,  181 => 89,  171 => 84,  165 => 82,  163 => 81,  159 => 80,  154 => 78,  149 => 76,  145 => 74,  141 => 73,  138 => 72,  135 => 71,  132 => 70,  125 => 66,  122 => 65,  120 => 64,  117 => 63,  111 => 61,  109 => 60,  102 => 59,  97 => 58,  95 => 57,  69 => 33,  64 => 32,  53 => 23,  48 => 22,  38 => 15,  34 => 14,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div style=\"min-height: 69%\" id=\"main\">
    <div class=\"container\"  style=\"padding-top: 0px\">
        <div class=\"main-content row\"  style=\"margin-top: 0px\">
            <div class=\"col-sm-8 parent-post-main\"\">
            <div class=\"post-main\">
                <h3 class=\"title\"></h3>

                <div class=\"post-extra\">

                    <div class=\"tag-list col-md-8\">

                    </div>
                    <div class=\"col-md-4 timestamp\">
                        <span class=\"date\"><i class=\"ico-calendar-full\"></i> {{ \"now\"|date(\"Y.m.d\") }}</span>
                        <span class=\"time\"><i class=\"ico-clock2\"></i> {{ \"now\"|date(\"H.i\") }}</span>
                    </div>

                </div>

                <img src=\"\" alt=\"\">

                {% partial 'site/social' post=post %}

                <div class=\"clearfix\"></div>

                <div class=\"post-content fr-view\"></div>

                <div class=\"pull-left\">
                    <a class=\"back-btn\">バック</a>
                </div>

                {% partial 'site/social' post=post %}

            </div>
            <div class=\"row\">
                <div class=\"col-sm-12\">
                    <fieldset>
                        <div class=\"form-group\">
                            <input class=\"form-control\" placeholder=\"名前\" type=\"text\" maxlength=\"64\">
                        </div>
                        <div class=\"form-group\">
                            <input class=\"form-control\" placeholder=\"電子メール\" type=\"text\" maxlength=\"64\">
                        </div>
                        <div class=\"form-group\">
                            <textarea class=\"form-control\" placeholder=\"内容\" rows=\"5\"></textarea>
                        </div>
                    </fieldset>
                    <button disabled class=\"btn btn-primary\"><i class=\"fa fa-save\"></i>&nbsp;&nbsp;&nbsp;&nbsp;保存&nbsp;&nbsp;&nbsp;&nbsp;</button>
                    <button disabled type=\"reset\" class=\"btn btn-default\">リセット</button>
                </div>
            </div>
            <div style=\"padding: 5px;\"></div>
        </div>
        <div class=\"col-sm-4\">
            <div class=\"sidebar side_2\" style=\"padding-top: 40px\">

                {% if siteBar.count %}
                {% for bar in siteBar %}
                <div class=\"sidebar-block post-popular\" {% if bar.type == 3 %} style=\"padding: 0px !important; box-shadow: 0px 0px 0px 0px #bbb !important;\" {% endif %}>
                    {% if bar.type != 3 %}
                    <h3 class=\"sidebar-title\" style=\"color:#ffffff;\">{{ bar.name }}</h3>
                    {% endif %}
                    <!--if bar is banner-->
                    {% if bar.type == 3 %}
                    <a href=\"javascript:;\">
                        <img class=\"img-responsive\" src=\"{{ bar.banner_image.path }}\" alt=\"\">
                    </a>
                    <!--if bar is banner-->
                    {% else %}
                    {% set posts = blogPosts.getSiteBar(bar.content_type, bar.type) %}
                    {% if posts.count %}
                    <ul class=\"popular-list\">
                        {% for post in posts %}
                        <li>
                            <a href=\"javascript:;\">
                                <img src=\"{{ post.featured_image.path }}\" alt=\"\">
                                <div class=\"desc\">
                                    <p style=\"word-break: normal\">{{ str_limit(post.title, 40) }}</p>
                                    <small>
                                        <span class=\"date\"><i class=\"ico-calendar-31\"></i>{{ post.published_at|date('Y.m.d') }}</span>
                                        {% if post.count_view %}
                                        <span class=\"\"><i class=\"ico-graph\"></i>{{ post.count_view }}</span>
                                        {% endif %}
                                    </small>
                                </div>
                            </a>
                        </li>
                        {% endfor %}
                    </ul>
                    {% endif %}
                    {% endif %}
                </div>
                {% endfor %}
                {% endif %}
            </div>
        </div>
    </div>
</div>", "/usr/share/nginx/html/themes/demo/pages/post-preview.htm", "");
    }
}
