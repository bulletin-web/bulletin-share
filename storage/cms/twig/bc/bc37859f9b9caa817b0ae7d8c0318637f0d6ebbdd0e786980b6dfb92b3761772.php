<?php

/* /usr/share/nginx/html/themes/demo/pages/post-preview-public.htm */
class __TwigTemplate_62443839456ef53b551dc023cb21274d43b34f52da0da4dc4a3ee9bb653a2000 extends Twig_Template
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
            <div class=\"col-sm-8 parent-post-main\">
                <div class=\"post-main\">
                    <h3 class=\"title\">";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["preview"] ?? null), "title", array()), "html", null, true);
        echo "</h3>
                    <div class=\"post-extra\">
                        ";
        // line 8
        $context["parentTag"] = twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getParentTag", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), ($context["preview"] ?? null), "id", array())), "method");
        // line 9
        echo "                        ";
        $context["childrenTag"] = twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getChildrenTag", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), ($context["preview"] ?? null), "id", array())), "method");
        // line 10
        echo "                        <div class=\"tag-list col-md-8\">
                            ";
        // line 11
        if (($context["parentTag"] ?? null)) {
            // line 12
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["parentTag"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 13
                echo "                            ";
                if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuLink", array(0 => "tag", 1 => $context["tag"]), "method")) {
                    // line 14
                    echo "                            <a data-color=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuColor", array(0 => "tag", 1 => $context["tag"]), "method"), "html", null, true);
                    echo "\" href=\"javascript:;\" class=\"tag btn btn-default btn_tag\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuName", array(0 => "tag", 1 => $context["tag"]), "method"), "html", null, true);
                    echo "</a>
                            ";
                }
                // line 16
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 17
            echo "                            ";
        }
        // line 18
        echo "                            ";
        if (($context["childrenTag"] ?? null)) {
            // line 19
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["childrenTag"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 20
                echo "                            ";
                if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuLink", array(0 => "tag", 1 => $context["tag"]), "method")) {
                    // line 21
                    echo "                            <a href=\"javascript:;\" class=\"tag btn btn-default\"
                               style=\"background-color: ";
                    // line 22
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuColor", array(0 => "tag", 1 => $context["tag"]), "method"), "html", null, true);
                    echo ";\">
                                ";
                    // line 23
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogMenu"] ?? null), "getMenuName", array(0 => "tag", 1 => $context["tag"]), "method"), "html", null, true);
                    echo "</a>
                            ";
                }
                // line 25
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 26
            echo "                            ";
        }
        // line 27
        echo "                        </div>
                        <div class=\"col-md-4 timestamp\">
                            <span class=\"date\"><i class=\"ico-calendar-full\"></i> ";
        // line 29
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y.m.d"), "html", null, true);
        echo "</span>
                            <span class=\"time\"><i class=\"ico-clock2\"></i> ";
        // line 30
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "H.i"), "html", null, true);
        echo "</span>
                        </div>
                    </div>
                    <img src=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["preview"] ?? null), "featured_image", array()), "path", array()), "html", null, true);
        echo "\"
                         alt=\"\">

                    ";
        // line 36
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['post'] = ($context["preview"] ?? null)        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/social"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 37
        echo "
                    <div class=\"clearfix\"></div>

                    <div class=\"post-content fr-view\"><p>
                        ";
        // line 41
        echo twig_get_attribute($this->env, $this->getSourceContext(), ($context["preview"] ?? null), "content_html", array());
        echo "
                    </div>

                    <div class=\"pull-left\">
                        <a class=\"back-btn\">バック</a>
                    </div>
                    ";
        // line 47
        $context['__cms_partial_params'] = [];
        $context['__cms_partial_params']['post'] = ($context["preview"] ?? null)        ;
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/social"        , $context['__cms_partial_params']        );
        unset($context['__cms_partial_params']);
        // line 48
        echo "
                </div>
                <div class=\"row\">
                    <div class=\"col-sm-12\">
                        <fieldset>
                            <div class=\"form-group\">
                                <input readonly class=\"form-control\" placeholder=\"名前\" type=\"text\" maxlength=\"64\">
                            </div>
                            <div class=\"form-group\">
                                <input readonly class=\"form-control\" placeholder=\"電子メール\" type=\"text\" maxlength=\"64\">
                            </div>
                            <div class=\"form-group\">
                                <textarea readonly class=\"form-control\" placeholder=\"内容\" rows=\"5\"></textarea>
                            </div>
                        </fieldset>
                        <button disabled class=\"btn btn-primary\"><i class=\"fa fa-save\"></i>&nbsp;&nbsp;&nbsp;&nbsp;保存&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        <button disabled type=\"reset\" class=\"btn btn-default\">リセット</button>
                    </div>
                </div>
                <div style=\"padding: 25px;\"></div>
            </div>
            <div class=\"col-sm-4\">
                <div class=\"sidebar side_2\" style=\"padding-top: 40px\">

                    ";
        // line 72
        if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["siteBar"] ?? null), "count", array())) {
            // line 73
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["siteBar"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["bar"]) {
                // line 74
                echo "                    <div class=\"sidebar-block post-popular\" ";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "type", array()) == 3)) {
                    echo " style=\"padding: 0px !important; box-shadow: 0px 0px 0px 0px #bbb !important;\" ";
                }
                echo ">
                        ";
                // line 75
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "type", array()) != 3)) {
                    // line 76
                    echo "                        <h3 class=\"sidebar-title\" style=\"color:#ffffff;\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "name", array()), "html", null, true);
                    echo "</h3>
                        ";
                }
                // line 78
                echo "                        <!--if bar is banner-->
                        ";
                // line 79
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "type", array()) == 3)) {
                    // line 80
                    echo "                        <a href=\"javascript:;\">
                            <img class=\"img-responsive\" src=\"";
                    // line 81
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "banner_image", array()), "path", array()), "html", null, true);
                    echo "\" alt=\"\">
                        </a>
                        <!--if bar is banner-->
                        ";
                } else {
                    // line 85
                    echo "                        ";
                    $context["posts"] = twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogPosts"] ?? null), "getSiteBar", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "content_type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "type", array())), "method");
                    // line 86
                    echo "                        ";
                    if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "count", array())) {
                        // line 87
                        echo "                        <ul class=\"popular-list\">
                            ";
                        // line 88
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(($context["posts"] ?? null));
                        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                            // line 89
                            echo "                            <li>
                                <a href=\"javascript:;\">
                                    <img src=\"";
                            // line 91
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "featured_image", array()), "path", array()), "html", null, true);
                            echo "\" alt=\"\">
                                    <div class=\"desc\">
                                        <p style=\"word-break: normal\">";
                            // line 93
                            echo call_user_func_array($this->env->getFunction('str_limit')->getCallable(), array("limit", twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "title", array()), 40));
                            echo "</p>
                                        <small>
                                            <span class=\"date\"><i class=\"ico-calendar-31\"></i>";
                            // line 95
                            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "published_at", array()), "Y.m.d"), "html", null, true);
                            echo "</span>
                                            ";
                            // line 96
                            if (twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "count_view", array())) {
                                // line 97
                                echo "                                            <span class=\"\"><i class=\"ico-graph\"></i>";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "count_view", array()), "html", null, true);
                                echo "</span>
                                            ";
                            }
                            // line 99
                            echo "                                        </small>
                                    </div>
                                </a>
                            </li>
                            ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 104
                        echo "                        </ul>
                        ";
                    }
                    // line 106
                    echo "                        ";
                }
                // line 107
                echo "                    </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bar'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 109
            echo "                    ";
        }
        // line 110
        echo "                </div>
            </div>
        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "/usr/share/nginx/html/themes/demo/pages/post-preview-public.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  272 => 110,  269 => 109,  262 => 107,  259 => 106,  255 => 104,  245 => 99,  239 => 97,  237 => 96,  233 => 95,  228 => 93,  223 => 91,  219 => 89,  215 => 88,  212 => 87,  209 => 86,  206 => 85,  199 => 81,  196 => 80,  194 => 79,  191 => 78,  185 => 76,  183 => 75,  176 => 74,  171 => 73,  169 => 72,  143 => 48,  138 => 47,  129 => 41,  123 => 37,  118 => 36,  112 => 33,  106 => 30,  102 => 29,  98 => 27,  95 => 26,  89 => 25,  84 => 23,  80 => 22,  77 => 21,  74 => 20,  69 => 19,  66 => 18,  63 => 17,  57 => 16,  49 => 14,  46 => 13,  41 => 12,  39 => 11,  36 => 10,  33 => 9,  31 => 8,  26 => 6,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div style=\"min-height: 69%\" id=\"main\">
    <div class=\"container\"  style=\"padding-top: 0px\">
        <div class=\"main-content row\"  style=\"margin-top: 0px\">
            <div class=\"col-sm-8 parent-post-main\">
                <div class=\"post-main\">
                    <h3 class=\"title\">{{ preview.title }}</h3>
                    <div class=\"post-extra\">
                        {% set parentTag = blogMenu.getParentTag(preview.id) %}
                        {% set childrenTag = blogMenu.getChildrenTag(preview.id) %}
                        <div class=\"tag-list col-md-8\">
                            {% if parentTag %}
                            {% for tag in parentTag %}
                            {% if blogMenu.getMenuLink('tag', tag) %}
                            <a data-color=\"{{ blogMenu.getMenuColor('tag', tag) }}\" href=\"javascript:;\" class=\"tag btn btn-default btn_tag\">{{ blogMenu.getMenuName('tag', tag) }}</a>
                            {% endif %}
                            {% endfor %}
                            {% endif %}
                            {% if childrenTag %}
                            {% for tag in childrenTag %}
                            {% if blogMenu.getMenuLink('tag', tag) %}
                            <a href=\"javascript:;\" class=\"tag btn btn-default\"
                               style=\"background-color: {{ blogMenu.getMenuColor('tag', tag) }};\">
                                {{ blogMenu.getMenuName('tag', tag) }}</a>
                            {% endif %}
                            {% endfor %}
                            {% endif %}
                        </div>
                        <div class=\"col-md-4 timestamp\">
                            <span class=\"date\"><i class=\"ico-calendar-full\"></i> {{ \"now\"|date(\"Y.m.d\") }}</span>
                            <span class=\"time\"><i class=\"ico-clock2\"></i> {{ \"now\"|date(\"H.i\") }}</span>
                        </div>
                    </div>
                    <img src=\"{{ preview.featured_image.path }}\"
                         alt=\"\">

                    {% partial 'site/social' post=preview %}

                    <div class=\"clearfix\"></div>

                    <div class=\"post-content fr-view\"><p>
                        {{ preview.content_html|raw }}
                    </div>

                    <div class=\"pull-left\">
                        <a class=\"back-btn\">バック</a>
                    </div>
                    {% partial 'site/social' post=preview %}

                </div>
                <div class=\"row\">
                    <div class=\"col-sm-12\">
                        <fieldset>
                            <div class=\"form-group\">
                                <input readonly class=\"form-control\" placeholder=\"名前\" type=\"text\" maxlength=\"64\">
                            </div>
                            <div class=\"form-group\">
                                <input readonly class=\"form-control\" placeholder=\"電子メール\" type=\"text\" maxlength=\"64\">
                            </div>
                            <div class=\"form-group\">
                                <textarea readonly class=\"form-control\" placeholder=\"内容\" rows=\"5\"></textarea>
                            </div>
                        </fieldset>
                        <button disabled class=\"btn btn-primary\"><i class=\"fa fa-save\"></i>&nbsp;&nbsp;&nbsp;&nbsp;保存&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        <button disabled type=\"reset\" class=\"btn btn-default\">リセット</button>
                    </div>
                </div>
                <div style=\"padding: 25px;\"></div>
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
    </div>", "/usr/share/nginx/html/themes/demo/pages/post-preview-public.htm", "");
    }
}
