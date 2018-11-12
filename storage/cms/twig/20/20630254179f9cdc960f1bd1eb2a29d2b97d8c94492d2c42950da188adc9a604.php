<?php

/* /usr/share/nginx/html/themes/demo/pages/home.htm */
class __TwigTemplate_3db8b7810b2b44ca037f3898e1cef5e93d3536e7da5a41fcbc9cec9072775eb7 extends Twig_Template
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
    <div class=\"container\">
        <div class=\"main-content row\">
            <div class=\"col-md-8\">
                ";
        // line 5
        if (twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["demoSettings"] ?? null), "displaySetting", array()), "slide_enable", array())) {
            // line 6
            echo "                <section class=\"top-slider\">
                    <ul class=\"slider\">
                        ";
            // line 8
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogPosts"] ?? null), "getPostForSlider", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                // line 9
                echo "                        <li>
                            <a href=\"/blog/post/";
                // line 10
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "slug", array()), "html", null, true);
                echo "\" style=\"background-image: url('";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "featured_image", array()), "path", array()), "html", null, true);
                echo "')\">
                                <div class=\"text\">";
                // line 11
                echo call_user_func_array($this->env->getFunction('str_limit')->getCallable(), array("limit", twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "title", array()), 100));
                echo "</div>
                            </a>
                        </li>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            echo "                    </ul>
                </section>
                ";
        }
        // line 18
        echo "                <section class=\"category-list\">
                    ";
        // line 19
        if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "count", array())) {
            // line 20
            echo "                    <div class=\"row\">
                        <ul class=\"list-item\">
                            ";
            // line 22
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["posts"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                // line 23
                echo "                            <li class=\"col-md-4 col-sm-4 col-xs-6\">
                                <div class=\"card\">
                                    <a href=\"/blog/post/";
                // line 25
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "slug", array()), "html", null, true);
                echo "\" class=\"card-main\">
                                        <div class=\"card-image\" style=\"background-image:url('";
                // line 26
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "featured_image", array()), "path", array()), "html", null, true);
                echo "')\"></div>
                                            <div class=\"card-cate clearfix\">
                                                ";
                // line 28
                if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogPosts"] ?? null), "getNameCategory", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "id", array())), "method") != "")) {
                    // line 29
                    echo "                                                <div style=\"background-color: ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogPosts"] ?? null), "getColorCategory", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "id", array())), "method"), "html", null, true);
                    echo ";\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogPosts"] ?? null), "getNameCategory", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "id", array())), "method"), "html", null, true);
                    echo "</div>
                                                ";
                } else {
                    // line 31
                    echo "                                                <div style=\"background-color: #dddddd; text-indent: 100%; overflow: hidden\">No data.</div>
                                                ";
                }
                // line 33
                echo "                                                ";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogPosts"] ?? null), "getNameFirstTag", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "id", array())), "method") != "")) {
                    // line 34
                    echo "                                                <div style=\"background-color: #ddd;color: #666;\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogPosts"] ?? null), "getNameFirstTag", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "id", array())), "method"), "html", null, true);
                    echo "</div>
                                                ";
                } else {
                    // line 36
                    echo "                                                <div style=\"background-color: #ddd; text-indent: 100%; overflow: hidden\">No data.</div>
                                                ";
                }
                // line 38
                echo "\t\t\t\t\t\t\t\t\t\t    </div>
                                        <div class=\"card-body\">
                                            <p class=\"card-description\">";
                // line 40
                echo call_user_func_array($this->env->getFunction('str_limit')->getCallable(), array("limit", twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "title", array()), 50));
                echo "</p>
                                            <span class=\"card-date\"><i class=\"ico-calendar-full\" style=\"margin-right: 5px\"></i>";
                // line 41
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "published_at", array()), "Y.m.d"), "html", null, true);
                echo "</span>
                                            <span class=\"card-time\"><i class=\"ico-clock2\" style=\"margin-right: 5px\"></i>";
                // line 42
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "published_at", array()), "H:i"), "html", null, true);
                echo "</span>
                                        </div>
                                    </a>
                                    <div class=\"line\" style=\"background-color: ";
                // line 45
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogPosts"] ?? null), "getColorOfPost", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "id", array())), "method"), "html", null, true);
                echo ";\"></div>
                                </div>
                            </li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "                        </ul>
                    </div>
                    ";
            // line 51
            $context['__cms_partial_params'] = [];
            $context['__cms_partial_params']['posts'] = ($context["posts"] ?? null)            ;
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/pagination"            , $context['__cms_partial_params']            );
            unset($context['__cms_partial_params']);
            // line 52
            echo "                    ";
        } else {
            // line 53
            echo "                    ";
            $context['__cms_content_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->contentFunction("no-data.htm"            , $context['__cms_content_params']            );
            unset($context['__cms_content_params']);
            // line 54
            echo "                    ";
        }
        // line 55
        echo "                </section>
            </div>

            <div class=\"col-md-4\">
                <div class=\"sidebar side_2\">

                    ";
        // line 61
        if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["siteBar"] ?? null), "count", array())) {
            // line 62
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["siteBar"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["bar"]) {
                // line 63
                echo "                    <div class=\"sidebar-block post-popular\" ";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "type", array()) == 3)) {
                    echo " style=\"padding: 0px !important; box-shadow: 0px 0px 0px 0px #bbb !important;\" ";
                }
                echo ">
                        ";
                // line 64
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "type", array()) != 3)) {
                    // line 65
                    echo "                        <h3 class=\"sidebar-title\" style=\"color:#ffffff;\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "name", array()), "html", null, true);
                    echo "</h3>
                        ";
                }
                // line 67
                echo "                        <!--if bar is banner-->
                        ";
                // line 68
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "type", array()) == 3)) {
                    // line 69
                    echo "                        <a href=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogPosts"] ?? null), "getLinkBanner", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "content_type", array())), "method"), "html", null, true);
                    echo "\">
                            <img class=\"img-responsive\" src=\"";
                    // line 70
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "banner_image", array()), "path", array()), "html", null, true);
                    echo "\" alt=\"\">
                        </a>
                        <!--if bar is banner-->
                        ";
                } else {
                    // line 74
                    echo "                            ";
                    $context["posts"] = twig_get_attribute($this->env, $this->getSourceContext(), ($context["blogPosts"] ?? null), "getSiteBar", array(0 => twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "content_type", array()), 1 => twig_get_attribute($this->env, $this->getSourceContext(), $context["bar"], "type", array())), "method");
                    // line 75
                    echo "                            ";
                    if (twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "count", array())) {
                        // line 76
                        echo "                            <ul class=\"popular-list\">
                                ";
                        // line 77
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(($context["posts"] ?? null));
                        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
                            // line 78
                            echo "                                <li>
                                    <a href=\"/blog/post/";
                            // line 79
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "slug", array()), "html", null, true);
                            echo "\">
                                        <img src=\"";
                            // line 80
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "featured_image", array()), "path", array()), "html", null, true);
                            echo "\" alt=\"\">
                                        <div class=\"desc\">
                                            <p style=\"word-break: normal\">";
                            // line 82
                            echo call_user_func_array($this->env->getFunction('str_limit')->getCallable(), array("limit", twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "title", array()), 40));
                            echo "</p>
                                            <small>
                                                <span class=\"date\"><i class=\"ico-calendar-31\"></i>";
                            // line 84
                            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "published_at", array()), "Y.m.d"), "html", null, true);
                            echo "</span>
                                                ";
                            // line 85
                            if (twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "count_view", array())) {
                                // line 86
                                echo "                                                <span class=\"\"><i class=\"ico-graph\"></i>";
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["post"], "count_view", array()), "html", null, true);
                                echo "</span>
                                                ";
                            }
                            // line 88
                            echo "                                            </small>
                                        </div>
                                    </a>
                                </li>
                                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 93
                        echo "                            </ul>
                            ";
                    }
                    // line 95
                    echo "                        ";
                }
                // line 96
                echo "                    </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bar'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 98
            echo "                    ";
        }
        // line 99
        echo "                </div>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/usr/share/nginx/html/themes/demo/pages/home.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  276 => 99,  273 => 98,  266 => 96,  263 => 95,  259 => 93,  249 => 88,  243 => 86,  241 => 85,  237 => 84,  232 => 82,  227 => 80,  223 => 79,  220 => 78,  216 => 77,  213 => 76,  210 => 75,  207 => 74,  200 => 70,  195 => 69,  193 => 68,  190 => 67,  184 => 65,  182 => 64,  175 => 63,  170 => 62,  168 => 61,  160 => 55,  157 => 54,  152 => 53,  149 => 52,  144 => 51,  140 => 49,  130 => 45,  124 => 42,  120 => 41,  116 => 40,  112 => 38,  108 => 36,  102 => 34,  99 => 33,  95 => 31,  87 => 29,  85 => 28,  80 => 26,  76 => 25,  72 => 23,  68 => 22,  64 => 20,  62 => 19,  59 => 18,  54 => 15,  44 => 11,  38 => 10,  35 => 9,  31 => 8,  27 => 6,  25 => 5,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div style=\"min-height: 69%\" id=\"main\">
    <div class=\"container\">
        <div class=\"main-content row\">
            <div class=\"col-md-8\">
                {% if demoSettings.displaySetting.slide_enable %}
                <section class=\"top-slider\">
                    <ul class=\"slider\">
                        {% for post in blogPosts.getPostForSlider %}
                        <li>
                            <a href=\"/blog/post/{{ post.slug }}\" style=\"background-image: url('{{ post.featured_image.path }}')\">
                                <div class=\"text\">{{ str_limit(post.title, 100) }}</div>
                            </a>
                        </li>
                        {% endfor %}
                    </ul>
                </section>
                {% endif %}
                <section class=\"category-list\">
                    {% if posts.count %}
                    <div class=\"row\">
                        <ul class=\"list-item\">
                            {% for post in posts %}
                            <li class=\"col-md-4 col-sm-4 col-xs-6\">
                                <div class=\"card\">
                                    <a href=\"/blog/post/{{ post.slug }}\" class=\"card-main\">
                                        <div class=\"card-image\" style=\"background-image:url('{{ post.featured_image.path }}')\"></div>
                                            <div class=\"card-cate clearfix\">
                                                {% if blogPosts.getNameCategory(post.id) != '' %}
                                                <div style=\"background-color: {{ blogPosts.getColorCategory(post.id) }};\">{{ blogPosts.getNameCategory(post.id) }}</div>
                                                {% else %}
                                                <div style=\"background-color: #dddddd; text-indent: 100%; overflow: hidden\">No data.</div>
                                                {% endif %}
                                                {% if blogPosts.getNameFirstTag(post.id) != '' %}
                                                <div style=\"background-color: #ddd;color: #666;\">{{ blogPosts.getNameFirstTag(post.id) }}</div>
                                                {% else %}
                                                <div style=\"background-color: #ddd; text-indent: 100%; overflow: hidden\">No data.</div>
                                                {% endif %}
\t\t\t\t\t\t\t\t\t\t    </div>
                                        <div class=\"card-body\">
                                            <p class=\"card-description\">{{ str_limit(post.title, 50) }}</p>
                                            <span class=\"card-date\"><i class=\"ico-calendar-full\" style=\"margin-right: 5px\"></i>{{ post.published_at|date('Y.m.d') }}</span>
                                            <span class=\"card-time\"><i class=\"ico-clock2\" style=\"margin-right: 5px\"></i>{{ post.published_at|date('H:i') }}</span>
                                        </div>
                                    </a>
                                    <div class=\"line\" style=\"background-color: {{ blogPosts.getColorOfPost(post.id) }};\"></div>
                                </div>
                            </li>
                            {% endfor %}
                        </ul>
                    </div>
                    {% partial 'site/pagination' posts=posts %}
                    {% else %}
                    {% content 'no-data.htm' %}
                    {% endif %}
                </section>
            </div>

            <div class=\"col-md-4\">
                <div class=\"sidebar side_2\">

                    {% if siteBar.count %}
                    {% for bar in siteBar %}
                    <div class=\"sidebar-block post-popular\" {% if bar.type == 3 %} style=\"padding: 0px !important; box-shadow: 0px 0px 0px 0px #bbb !important;\" {% endif %}>
                        {% if bar.type != 3 %}
                        <h3 class=\"sidebar-title\" style=\"color:#ffffff;\">{{ bar.name }}</h3>
                        {% endif %}
                        <!--if bar is banner-->
                        {% if bar.type == 3 %}
                        <a href=\"{{ blogPosts.getLinkBanner(bar.content_type) }}\">
                            <img class=\"img-responsive\" src=\"{{ bar.banner_image.path }}\" alt=\"\">
                        </a>
                        <!--if bar is banner-->
                        {% else %}
                            {% set posts = blogPosts.getSiteBar(bar.content_type, bar.type) %}
                            {% if posts.count %}
                            <ul class=\"popular-list\">
                                {% for post in posts %}
                                <li>
                                    <a href=\"/blog/post/{{ post.slug }}\">
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
    </div>
</div>", "/usr/share/nginx/html/themes/demo/pages/home.htm", "");
    }
}
