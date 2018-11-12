<?php

/* /usr/share/nginx/html/themes/demo/partials/site/pagination.htm */
class __TwigTemplate_acd19a02cf538854b3c7aab9da8885c58af03d035773468c3032b6cb8203b633 extends Twig_Template
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
        $context["numberLink"] = 3;
        // line 2
        echo "
<div class=\"text-center\">
\t";
        // line 4
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "lastPage", array()) > 1)) {
            // line 5
            echo "\t<ul class=\"pager\">
\t\t";
            // line 6
            if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) > 1)) {
                // line 7
                echo "\t\t<li class=\"previous\"><a href=\"";
                echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter(twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["this"] ?? null), "page", array()), "baseFileName", array()), array(($context["pageParam"] ?? null) => (twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) - 1)));
                echo "\"><span aria-hidden=\"true\">&larr;</span> 前へ</a></li>
\t\t";
            } else {
                // line 9
                echo "\t\t<li class=\"previous\"><span aria-hidden=\"true\">&nbsp;</span></li>
\t\t";
            }
            // line 11
            echo "
\t\t<li class=\"page\"><span>";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "lastPage", array()), "html", null, true);
            echo "</span></li>

\t\t";
            // line 14
            if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) < twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "lastPage", array()))) {
                // line 15
                echo "\t\t<li class=\"next\"><a href=\"";
                echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter(twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["this"] ?? null), "page", array()), "baseFileName", array()), array(($context["pageParam"] ?? null) => (twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) + 1)));
                echo "\">次へ <span aria-hidden=\"true\">&rarr;</span></a></li>
\t\t";
            } else {
                // line 17
                echo "\t\t<li class=\"next\"><span aria-hidden=\"true\">&nbsp;</span></li>
\t\t";
            }
            // line 19
            echo "\t</ul>

\t<ul class=\"pagination\">
\t\t";
            // line 22
            if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) > 1)) {
                // line 23
                echo "\t\t<li><a href=\"";
                echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter(twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["this"] ?? null), "page", array()), "baseFileName", array()), array(($context["pageParam"] ?? null) => (twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) - 1)));
                echo "\"><span aria-hidden=\"true\">&laquo;</span></a></li>
\t\t";
            }
            // line 25
            echo "
\t\t";
            // line 26
            if (((twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) - ($context["numberLink"] ?? null)) > 2)) {
                // line 27
                echo "\t\t<li>
\t\t\t<a href=\"";
                // line 28
                echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter(twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["this"] ?? null), "page", array()), "baseFileName", array()), array(($context["pageParam"] ?? null) => 1));
                echo "\">1</a>
\t\t</li>

\t\t<li class=\"extend\"><span>...</span></li>
\t\t";
                // line 32
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range((twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) - ($context["numberLink"] ?? null)), (twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) - 1)));
                foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                    // line 33
                    echo "\t\t<li>
\t\t\t<a href=\"";
                    // line 34
                    echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter(twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["this"] ?? null), "page", array()), "baseFileName", array()), array(($context["pageParam"] ?? null) => $context["page"]));
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                    echo "</a>
\t\t</li>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 37
                echo "\t\t";
            } else {
                // line 38
                echo "\t\t";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) != 1)) {
                    // line 39
                    echo "\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(range(1, (twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) - 1)));
                    foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                        // line 40
                        echo "\t\t<li>
\t\t\t<a href=\"";
                        // line 41
                        echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter(twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["this"] ?? null), "page", array()), "baseFileName", array()), array(($context["pageParam"] ?? null) => $context["page"]));
                        echo "\">";
                        echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                        echo "</a>
\t\t</li>
\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 44
                    echo "\t\t";
                }
                // line 45
                echo "\t\t";
            }
            // line 46
            echo "
\t\t<li class=\"active\"><span>";
            // line 47
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()), "html", null, true);
            echo "</span></li>

\t\t";
            // line 49
            if (((twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) + 1) < (twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "lastPage", array()) - ($context["numberLink"] ?? null)))) {
                // line 50
                echo "\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range((twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) + 1), (twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) + ($context["numberLink"] ?? null))));
                foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                    // line 51
                    echo "\t\t<li>
\t\t\t<a href=\"";
                    // line 52
                    echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter(twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["this"] ?? null), "page", array()), "baseFileName", array()), array(($context["pageParam"] ?? null) => $context["page"]));
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                    echo "</a>
\t\t</li>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 55
                echo "\t\t<li class=\"extend\"><span>...</span></li>
\t\t<li>
\t\t\t<a href=\"";
                // line 57
                echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter(twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["this"] ?? null), "page", array()), "baseFileName", array()), array(($context["pageParam"] ?? null) => twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "lastPage", array())));
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "lastPage", array()), "html", null, true);
                echo "</a>
\t\t</li>
\t\t";
            } else {
                // line 60
                echo "\t\t";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) != twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "lastPage", array()))) {
                    // line 61
                    echo "\t\t";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(range((twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) + 1), twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "lastPage", array())));
                    foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                        // line 62
                        echo "\t\t<li>
\t\t\t<a href=\"";
                        // line 63
                        echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter(twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["this"] ?? null), "page", array()), "baseFileName", array()), array(($context["pageParam"] ?? null) => $context["page"]));
                        echo "\">";
                        echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                        echo "</a>
\t\t</li>
\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 66
                    echo "\t\t";
                }
                // line 67
                echo "\t\t";
            }
            // line 68
            echo "
\t\t";
            // line 69
            if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "lastPage", array()) > twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()))) {
                // line 70
                echo "\t\t<li><a href=\"";
                echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter(twig_get_attribute($this->env, $this->getSourceContext(), twig_get_attribute($this->env, $this->getSourceContext(), ($context["this"] ?? null), "page", array()), "baseFileName", array()), array(($context["pageParam"] ?? null) => (twig_get_attribute($this->env, $this->getSourceContext(), ($context["posts"] ?? null), "currentPage", array()) + 1)));
                echo "\"><span aria-hidden=\"true\">&raquo;</span></a></li>
\t\t";
            }
            // line 72
            echo "\t</ul>
\t";
        }
        // line 74
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "/usr/share/nginx/html/themes/demo/partials/site/pagination.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  225 => 74,  221 => 72,  215 => 70,  213 => 69,  210 => 68,  207 => 67,  204 => 66,  193 => 63,  190 => 62,  185 => 61,  182 => 60,  174 => 57,  170 => 55,  159 => 52,  156 => 51,  151 => 50,  149 => 49,  144 => 47,  141 => 46,  138 => 45,  135 => 44,  124 => 41,  121 => 40,  116 => 39,  113 => 38,  110 => 37,  99 => 34,  96 => 33,  92 => 32,  85 => 28,  82 => 27,  80 => 26,  77 => 25,  71 => 23,  69 => 22,  64 => 19,  60 => 17,  54 => 15,  52 => 14,  45 => 12,  42 => 11,  38 => 9,  32 => 7,  30 => 6,  27 => 5,  25 => 4,  21 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% set numberLink = 3 %}

<div class=\"text-center\">
\t{% if posts.lastPage > 1 %}
\t<ul class=\"pager\">
\t\t{% if posts.currentPage > 1 %}
\t\t<li class=\"previous\"><a href=\"{{ this.page.baseFileName|page({ (pageParam): (posts.currentPage - 1) }) }}\"><span aria-hidden=\"true\">&larr;</span> 前へ</a></li>
\t\t{% else %}
\t\t<li class=\"previous\"><span aria-hidden=\"true\">&nbsp;</span></li>
\t\t{% endif %}

\t\t<li class=\"page\"><span>{{ posts.currentPage }}/{{ posts.lastPage }}</span></li>

\t\t{% if posts.currentPage < posts.lastPage %}
\t\t<li class=\"next\"><a href=\"{{ this.page.baseFileName|page({ (pageParam): (posts.currentPage + 1) }) }}\">次へ <span aria-hidden=\"true\">&rarr;</span></a></li>
\t\t{% else %}
\t\t<li class=\"next\"><span aria-hidden=\"true\">&nbsp;</span></li>
\t\t{% endif %}
\t</ul>

\t<ul class=\"pagination\">
\t\t{% if posts.currentPage > 1 %}
\t\t<li><a href=\"{{ this.page.baseFileName|page({ (pageParam): (posts.currentPage-1) }) }}\"><span aria-hidden=\"true\">&laquo;</span></a></li>
\t\t{% endif %}

\t\t{% if posts.currentPage - numberLink > 2 %}
\t\t<li>
\t\t\t<a href=\"{{ this.page.baseFileName|page({ (pageParam): 1 }) }}\">1</a>
\t\t</li>

\t\t<li class=\"extend\"><span>...</span></li>
\t\t{% for page in (posts.currentPage - numberLink)..(posts.currentPage - 1) %}
\t\t<li>
\t\t\t<a href=\"{{ this.page.baseFileName|page({ (pageParam): page }) }}\">{{ page }}</a>
\t\t</li>
\t\t{% endfor %}
\t\t{% else %}
\t\t{% if posts.currentPage != 1 %}
\t\t{% for page in 1..(posts.currentPage - 1) %}
\t\t<li>
\t\t\t<a href=\"{{ this.page.baseFileName|page({ (pageParam): page }) }}\">{{ page }}</a>
\t\t</li>
\t\t{% endfor %}
\t\t{% endif %}
\t\t{% endif %}

\t\t<li class=\"active\"><span>{{ posts.currentPage }}</span></li>

\t\t{% if (posts.currentPage + 1) < (posts.lastPage - numberLink) %}
\t\t{% for page in (posts.currentPage + 1)..(posts.currentPage + numberLink) %}
\t\t<li>
\t\t\t<a href=\"{{ this.page.baseFileName|page({ (pageParam): page }) }}\">{{ page }}</a>
\t\t</li>
\t\t{% endfor %}
\t\t<li class=\"extend\"><span>...</span></li>
\t\t<li>
\t\t\t<a href=\"{{ this.page.baseFileName|page({ (pageParam): posts.lastPage }) }}\">{{ posts.lastPage }}</a>
\t\t</li>
\t\t{% else  %}
\t\t{% if posts.currentPage != posts.lastPage %}
\t\t{% for page in (posts.currentPage + 1)..posts.lastPage %}
\t\t<li>
\t\t\t<a href=\"{{ this.page.baseFileName|page({ (pageParam): page }) }}\">{{ page }}</a>
\t\t</li>
\t\t{% endfor %}
\t\t{% endif %}
\t\t{% endif %}

\t\t{% if posts.lastPage > posts.currentPage %}
\t\t<li><a href=\"{{ this.page.baseFileName|page({ (pageParam): (posts.currentPage + 1) }) }}\"><span aria-hidden=\"true\">&raquo;</span></a></li>
\t\t{% endif %}
\t</ul>
\t{% endif %}
</div>", "/usr/share/nginx/html/themes/demo/partials/site/pagination.htm", "");
    }
}
